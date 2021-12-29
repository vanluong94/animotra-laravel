<?php

namespace App\Models;

use App\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaCollection extends Model
{
    use HasFactory;
    use Slug;

    protected $fillable = [ 'type', 'name', 'slug' ];

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
        $slug = $this->slugify( $this->name );

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
