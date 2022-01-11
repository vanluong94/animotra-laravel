<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\UserRating;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function rate( Request $request, $id ) {

        $manga = Manga::find( $id );

        if( ! $manga ) {
            abort(404);
        }

        UserRating::updateOrCreate(
            [
                'rate'     => floatval( $request->rate ),
                'manga_id' => $manga->id,
                'user_id'  => $request->user()->id
            ],
            [
                'manga_id' => $manga->id,
                'user_id'  => $request->user()->id
            ]
        );

        $manga->rating = UserRating::whereMangaId( $manga->id )->get()->avg('rate');
        $manga->save();

        return response()->json([
            'success' => true
        ]);

    }
}
