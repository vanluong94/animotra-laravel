<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserPurchase extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'coin', 'chapter_id', 'manga_id' ];

    public function delete()
    {
        DB::table('user_purchases')->where([
            [ 'user_id', $this->user_id ],
            [ 'chapter_id', $this->chapter_id ],
            [ 'manga_id', $this->manga_id ],
        ])->delete();
    }

}
