<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChapterAjaxController extends Controller
{
    public function save(Request $request) {
        return response()->json([
            'error' => 0,
            'data' => [
                'chapter_id' => 0
            ]
        ]);
    }
    
    public function upload(Request $request) {
        return response()->json([
            'error' => 0,
            'data' => [
                'chapter_id' => 0
            ]
        ]);
    }
}
