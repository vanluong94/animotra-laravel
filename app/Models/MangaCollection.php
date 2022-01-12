<?php

namespace App\Models;

use App\Helper\Str;
use App\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaCollection extends Model
{
    use HasFactory;

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
    public function getAdminDeleteUrl() {
        return route('admin.collection.delete', [
            'id'   => $this->id,
            'type' => $this->type
        ]);
    }

    /**
     * @return string $url
     */
    public function getViewURL() {
        return route('collection.view',[ 'type' => $this->type, 'slug' => $this->slug ]);
    }

    /**
     * @override parent save() method to generate slug before saving
     */
    public function save(array $options = []) {
        $this->genUniqueSlug();
        parent::save($options);
    }

    public function mangas() {
        return $this->belongsToMany( 
            Manga::class, 
            'manga_collection_relationships',
            'collection_id',
            'manga_id'
        );
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
            ])->where('id', '!=', $this->id)->first() ? false : true;

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
        $plural = $plural ? 'plural' : 'singular';
        return config( "other.manga.collections.{$type}.label.{$plural}" );
    }

}
