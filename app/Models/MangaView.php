<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaView extends Model
{
    use HasFactory;

    protected $fillable = [ 'manga_id', 'views' ];
}
