<?php

namespace App\Models;

use App\Helper\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'extend_name', 'coin', 'released_at', 'user_id', 'content', 'slug' ];


    /**
     * @param array $data 
     *      $data = [
     *          'manga_id'      => (integer) 
     *          'name'          => (string) chapter name
     *          'extend_name'   => (string) chapter extend name
     *          'user_id'       => (integer) (optional) user id for account who created this chapter
     *          'files'         => (lluminate\Http\UploadedFile) (optinal) manga thumbnail file,
     *          'released_at'   => (string) datetime
     *      ]
     */
    public function savePostedData( array $data ) {

        if( ! empty( $data['name'] ) ){
            if( $data['name'] !== $this->title ){ 
                $data['slug'] = $this->findUniqueSlug( $data['name'] );
            }
        }
        
        foreach( [ 'manga_id', 'name', 'extend_name', 'coin', 'user_id' ] as $param ){
            if( isset( $data[ $param ] ) ){
                $this->$param = $data[ $param ];
            }
        }

        $this->save(); // save to get chapter id first

        $images = [];
        $old_images = $this->getImages();
        if( isset( $data['files'] ) ){
            $files = [];
            foreach ($data['files'] as $file) {
                if( $file instanceof UploadedFile ){
                    $uploaded_file = $file->storePublicly("/mangas/{$this->manga_id}/{$this->id}", [ 'disk' => 'public' ]);
                    if( $uploaded_file ){
                        $files[] = $uploaded_file;
                    }
                }
            }
        }

        foreach( $data['images'] as $index => $image ){
            if( $image == 'file' ){ // if this is place holder for uploaded file
                $images[ $index ] = array_shift( $files );
            } else if( in_array( $image, $old_images ) ) {
                $images[ $index ] = $image;
            }
        }   
        $this->content = json_encode( $images );

        if( isset( $data['released_at'] ) ){
            $this->released_at = new Carbon( $data['released_at'] );
        }

        $this->save();


    }

    public function saveContent( array $data ) {

    }

    public function manga() {
        return $this->belongsTo( Manga::class );
    }

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function getImages() {
        return json_decode( $this->content, true );
    }
    public function getImageUrls() {
        return array_map( function( $img ){
            return Storage::url( $img );
        }, $this->getImages() );
    }

    public function getReleasedAtInputValue() {
        $at = new Carbon( $this->released_at );
        return $at->format('Y-m-d\TH:i');
    }

    /**
     * Find unique slug base on chapter name
     */
    public function findUniqueSlug( $name ) {

        $is_valid = false;
        $suffix = 0;
        $slug = Str::slugify( $name );

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

}
