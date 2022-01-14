<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'manga_id', 'chapter_id', 'content' ];

    public function manga() {
        return $this->belongsTo( Manga::class );
    }

    public function chapter() {
        return $this->belongsTo( Chapter::class );
    }

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function getPageName() {
        if( $this->chapter ) {
            return $this->manga->title . ' - ' . $this->chapter->getFullName();
        } else {
            return $this->manga->title;
        }
    }

    public function getPageUrl() {
        if( $this->chapter ) {
            $url = route('chapter.view', [
                'slug'    => $this->manga->slug,
                'chapter' => $this->chapter->slug
            ]);
        } else {
            $url = route('manga.view', [
                'slug'    => $this->manga->slug,
            ]);
        }
        return $url;
    }

    public function getViewUrl() {
        return $this->getPageUrl() . '#comment-' . $this->id;
    }

    public function getAdminDeleteUrl() {
        return route('admin.comment.delete', $this->id);
    }
}
