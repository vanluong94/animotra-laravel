<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'manga_id', 'rate' ];

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function manga() {
        return $this->belongsTo( Manga::class );
    }
}
