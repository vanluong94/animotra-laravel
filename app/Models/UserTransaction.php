<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'order_id', 'price', 'coins' ];
    
    public function user() {
        return $this->belongsTo( User::class );
    }
}
