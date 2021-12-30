<?php

namespace App\Models;

use App\Helper\Str;
use App\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaCollection extends Model
{
    use HasFactory;

    const TYPES = [
        'category' => [
            'label' => [
                'singular' => 'Category',
                'plural'   => 'Categories'
            ],
        ],
        'tag' => [
            'label' => [
                'singular' => 'Tag',
                'plural'   => 'Tags'
            ],
        ],
        'author' => [
            'label' => [
                'singular' => 'Author',
                'plural'   => 'Authors'
            ],
        ],
    ];

    protected $fillable = [ 'type', 'name', 'slug' ];

    /**
     * Retrieve the editting URL
     * @return string $url
     */
    public function getAdminEditURL() {
        return route('admin.collection.edit', [
            'id'   => $this->id,
            'type' => $this->type
        ]);
    }

    /**
     * Retrieve the delete URL 
     * @return string $url
     */
    public function getAdminDeleteURL() {
        return route('admin.collection.delete', [
            'id'   => $this->id,
            'type' => $this->type
        ]);
    }

    /**
     * @return string $url
     */
    public function getViewURL() {
        return '#';
    }

    /**
     * @override parent save() method to generate slug before saving
     */
    public function save(array $options = []) {
        $this->genUniqueSlug();
        parent::save($options);
    }

    /**
     * Auto generate slug base on collection's name
     * @return void
     */
    public function genUniqueSlug() {
        $is_valid = false;
        $suffix = 0;
        $slug = Str::slugify( $this->name );

        while( ! $is_valid ) {
            $is_valid = MangaCollection::where([
                'type' => $this->type,
                'slug' => $slug,
            ])->first() ? false : true;

            if( ! $is_valid ) {
                $slug .= '-' . ++$suffix;
            }
        }

        $this->slug = $slug;
    }

    /**
     * @return string $plural_label
     */
    public function getTypeLabelPlural() {
        return self::getTypeLabel( $this->type, true );
    }

    /**
     * @return string $singular_label
     */
    public function getTypeLabelSingular() {
        return self::getTypeLabel( $this->type, false );
    }

    /**
     * @param string $type
     * @param boolean $plural 
     */
    public static function getTypeLabel( $type, $plural = false ){
        if( self::isValidType( $type ) ){
            if( $plural ){
                return self::TYPES[ $type ]['label']['plural'];
            }else{
                return self::TYPES[ $type ]['label']['singular'];
            }
        }
    }

    public static function isValidType( $type ){
        return isset( self::TYPES[ $type ] );
    }
}
