<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\UserCoinLog;
use App\Models\UserPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChapterController extends Controller
{
    public function view( $manga_slug, $chapter_slug ) {

        $chapter = Chapter::findBySlug( $manga_slug, $chapter_slug );

        if( ! $chapter ){
            abort(404);
        }

        return view('app.chapter', compact(['chapter']));

    }
    
    public function purchase( Request $request, $manga_slug, $chapter_slug ){

        $chapter = Chapter::findBySlug( $manga_slug, $chapter_slug );

        if( ! $chapter ){
            abort(404);
        }

        $user = $request->user();

        $response = redirect()->route('chapter.view', [
            'chapter' => $chapter->slug,
            'slug'    => $chapter->manga->slug
        ]);

        if( 
            ! UserPurchase::where([
                [ 'user_id', $user->id ],
                [ 'chapter_id', $chapter->id ],
                [ 'manga_id', $chapter->manga->id ],
            ])->first() 
        ) {

            if( $chapter->coin > $user->balance ){
                return $response->withErrors([
                    'msg' => 'Your balance doesn\'t have enough tokens to purchase this chapter'
                ]);
            }

            DB::beginTransaction();

            UserPurchase::create([
                'user_id'    => $user->id,
                'chapter_id' => $chapter->id,
                'manga_id'   => $chapter->manga->id,
                'coin'       => $chapter->coin
            ]);

            UserCoinLog::create([
                'user_id' => $user->id,
                'type' => 'purchase', 
                'coin' => $chapter->coin * -1,
                'entry' => sprintf( 
                    'Purchase <a href="%s">%s</a> - <a href="%s">%s</a>',
                    route('manga.view', $chapter->manga->slug, false), $chapter->manga->name,
                    route('chapter.view', [
                        'chapter' => $chapter->slug,
                        'slug' => $chapter->manga->slug,
                    ], false), $chapter->getFullName()
                )
            ]);

            $user->subBalance( $chapter->coin );

            DB::commit();
        }

        return $response;

    }
}
