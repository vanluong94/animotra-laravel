<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    public function view( $manga_slug, $chapter_slug ) {

        $chapter = Chapter::findBySlug( $manga_slug, $chapter_slug );

        if( ! $chapter ){
            abort(404);
        }

        return view('app.chapter', compact(['chapter']));

    }
}
