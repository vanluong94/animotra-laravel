<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
        'avatar',
        'balance'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatar() {
        return $this->avatar ? $this->avatar : asset( 'img/avatar-person.svg' );
    }

    public function isAdmin() {
        return $this->role == 'admin';
    }

    public function getRoleLabel() {
        if( $this->role == 'admin' ){
            return 'administrator';
        } else {
            return 'member';
        }
    }

    public function comments() {
        return $this->hasMany( Comment::class );
    }

    public function notifications() {
        return $this->hasMany( UserNotifications::class )->orderByDesc('created_at');
    }

    public function unreadNotifications()
    {
        return $this->notifications()->where('read', 0);
    }

    public function favoriteMangas() {
        return $this->belongsToMany( 
            Manga::class, 
            'user_collections',
            'user_id', 
            'manga_id'
        )->where('type', 'favorite');
    }

    public function readLaterMangas() {
        return $this->belongsToMany( 
            Manga::class, 
            'user_collections',
            'user_id', 
            'manga_id'
        )->where('type', 'read_later');
    }

    public function subscribedMangas() {
        return $this->belongsToMany( 
            Manga::class, 
            'user_collections',
            'user_id', 
            'manga_id'
        )->where('type', 'subscribe');
    }

    public function addBalance( int $amount ) {
        $this->balance = intval( $this->balance ) + $amount;
        $this->save();
    }

    public function subBalance( int $amount ){
        $this->balance = intval( $this->balance ) - $amount;
        $this->save();
    }

    public function purchasedChapters() {
        return $this->belongsToMany( 
            Chapter::class, 
            'user_purchases',
            'user_id', 
            'chapter_id'
        );
    }

    public function hasPurchased( Chapter $chapter ) {
        return $this->purchasedChapters()->where('chapter_id', $chapter->id)->first();
    }

}
