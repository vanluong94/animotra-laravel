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

}
