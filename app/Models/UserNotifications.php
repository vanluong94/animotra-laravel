<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotifications extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'content', 'read', 'link' ];

    public static function sendNewChapterNotifications(Manga $manga, Chapter $chapter) {

        $content = "<strong>{$manga->title}</strong> has released <strong>{$chapter->getFullName()}</strong>, read it now!";
        $link    = route('chapter.view', [
            'slug'    => $manga->slug,
            'chapter' => $chapter->slug
        ], false);

        foreach( $manga->subscribedUsers as $user ){
            self::create([
                'content' => $content,
                'link'    => $link,
                'user_id' => $user->id,
            ]);
        }

    }

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function getReadUrl() {
        return route('notification.read', $this->id);
    }

    public function getTargetUrl() {
        return url( $this->link );
    }

    public function isRead() {
        return $this->read ? true : false;
    }

}
