<?php

namespace App\Http\Controllers;

use App\Models\MangaCollection;
use Illuminate\Http\Request;

class MangaCollectionController extends Controller
{
    public function view( $type, $slug ) {
        $collection = MangaCollection::where([
            [ 'type', $type ],
            [ 'slug', $slug ]
        ])->first();

        if( ! $collection ){
            abort(404);
        }

        $mangas = $collection->mangas()->paginate(12);

        return view('app.page-collection', compact(['collection', 'mangas']));
    }
}
