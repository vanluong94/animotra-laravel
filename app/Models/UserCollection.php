<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCollection extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'manga_id', 'type' ];

}
