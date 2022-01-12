<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPurchase extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'coin', 'chapter_id', 'manga_id' ];

}
