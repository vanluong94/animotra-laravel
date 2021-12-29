<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manga;
use Illuminate\Http\Request;

class MangaAjaxController extends Controller
{
    public function save(Request $request) {

        $args = array(
            // 'title' => 
        );
        
        if( $request->get('manga_id') ){
            $args['id'] = $request->get('manga_id');
        } 

        $manga = Manga::updateOrCreate([
            
        ]);


        return response()->json([
            'error' => 0,
            'data' => [
                'chapter_id' => 0
            ]
        ]);
    }
}
