<?php

namespace App\Models;

use App\Helper\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'summary', 'publish_status', 'release_status', 'thumbnail', 'user_id', 'published_at'
    ];

    /**
     * @param array $data 
     *      $data = [
     *          'title'             => (string) manga title
     *          'summary'           => (string) manga summary
     *          'publish_status'    => (string) manga publish status
     *          'release_status'    => (string) manga release status
     *          'categories'        => (array) manga collection category names
     *          'tags'              => (array) manga collection tag names
     *          'authors'           => (array) manga collection author names
     *          'user_id'           => (integer) (optinal) user id for account who created this manga
     *          'thumbnail'         => (lluminate\Http\UploadedFile) (optinal) manga thumbnail file,
     *          'published_at'      => (string)
     *          'release_year'      => (integer)
     *      ]
     */
    public function savePostedData( array $data ) {

        if( ! empty( $data['title'] ) ){
            if( $data['title'] !== $this->title ){ 
                $data['slug'] = $this->findUniqueSlug( $data['title'] );
            }
        }
        
        foreach( [ 'title', 'slug', 'summary', 'publish_status', 'release_status', 'user_id' ] as $param ){
            if( isset( $data[ $param ] ) ){
                $this->$param = $data[ $param ];
            }
        }

        if( isset( $data['thumbnail_file'] ) ){
            $file = $data['thumbnail_file'];
            if( $file instanceof UploadedFile ){
                $thumb = $file->storePublicly('/thumbnails', [ 'disk' => 'public' ]);
                if( $thumb ){
                    $this->thumbnail = $thumb;
                }
            }
        }

        if( isset( $data['published_at'] ) ){
            $this->published_at = new Carbon( $data['published_at'] );
        }

        $this->save();

        $this->categories()->detach(); // this will detach all collections, not just categories

        foreach( [
            [
                'name' => 'year', 
                'type' => 'year'
            ],
            [
                'name' => 'categories', 
                'type' => 'category'
            ],
            [
                'name' => 'tags', 
                'type' => 'tag'
            ],
            [
                'name' => 'authors', 
                'type' => 'author'
            ],
        ] as $type ){

            $name = $type['name'];
            $type = $type['type'];
            
            if( isset( $data[ $name ] ) ){

                if( is_array( $data[ $name ] ) ){

                    $models = [];

                    foreach( $data[ $name ] as $collection_name ){
                        $collection = MangaCollection::firstOrCreate([
                            'name' => $collection_name,
                            'type' => $type
                        ]);
        
                        $models[] = $collection;
                    }

                    if( $models ){
                        $this->$name()->saveMany( $models );
                    }

                } else {
                    $collection = MangaCollection::firstOrCreate([
                        'name' => $data[ $name ],
                        'type' => $type
                    ]);

                    $this->$name()->save( $collection );
                }

            }
        }

    }

    public function categories() {
        return $this->belongsToMany( 
            MangaCollection::class, 
            'manga_collection_relationships',
            'manga_id', 
            'collection_id'
        )->where('type', 'category');
    }

    public function tags() {
        return $this->belongsToMany( 
            MangaCollection::class, 
            'manga_collection_relationships',
            'manga_id', 
            'collection_id'
        )->where('type', 'tag');
    }

    public function authors() {
        return $this->belongsToMany( 
            MangaCollection::class, 
            'manga_collection_relationships',
            'manga_id', 
            'collection_id'
        )->where('type', 'author');
    }

    public function year() {
        return $this->belongsToMany( 
            MangaCollection::class, 
            'manga_collection_relationships',
            'manga_id', 
            'collection_id'
        )->where('type', 'year');
    }

    public function user() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function getViewURL() {
        return route('manga.view', $this->slug);
    }

    public function getAdminEditURL() {
        return route('admin.manga.edit', $this->id);
    }

    public function getAdminDeleteURL() {
        return route('admin.manga.delete', $this->id);
    }

    public function getPublishedAtInputValue() {
        $at = new Carbon( $this->published_at );
        return $at->format('Y-m-d\TH:i');
    }

    /**
     * Find unique slug base on manga title
     */
    public function findUniqueSlug( $title ) {

        $is_valid = false;
        $suffix = 0;
        $slug = Str::slugify( $title );

        while( ! $is_valid ) {
            $is_valid = self::where([
                'slug' => $slug,
            ])->first() ? false : true;

            if( ! $is_valid ) {
                $slug .= '-' . ++$suffix;
            }
        }

        $this->slug = $slug;
        
    }

    public function getPublishStatusBadge() {
        switch( $this->publish_status ){
            case 'published':
                return '<span class="badge badge-success">Published</span>';
                break;
            case 'draft':
                return '<span class="badge badge-secondary">Draft</span>';
                break;
        }
    }

    public function getThumbnailURL() {
        return asset(Storage::url( $this->thumbnail ));
    }

}
