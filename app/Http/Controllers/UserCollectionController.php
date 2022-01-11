<?php

namespace App\Http\Controllers;

use App\Models\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserCollectionController extends Controller
{
    public function toggle(Request $request) {

        $data = $request->validate([
            'manga_id' => 'required|integer',
            'type'     => [
                'required', 
                Rule:: in( config('other.user.collections') )
            ]
        ]);
        
        $bookmark = UserCollection::firstOrNew([
            'manga_id' => $data['manga_id'],
            'type'     => $data['type'],
            'user_id'  => $request->user()->id
        ]);

        if( $bookmark->id ) {
            $bookmark->delete();
        } else {
            $bookmark->save();
        }

        return response()->json([
            'success' => true
        ]);

    }
}
