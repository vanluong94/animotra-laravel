<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MangaCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Str;

class MangaCollectionController extends Controller
{
    /**
     * Display view for listing all collection items
     * @return \Illuminate\View\View
     */
    public function all(Request $request, $type) {
        return view('admin.collection.all', compact(['type']));
    }

    /**
     * Display view for adding a collection item
     * @return \Illuminate\View\View
     */
    public function add(Request $request, $type) {
        return view('admin.collection.add', compact(['type']));
    }

    public function save(Request $request, $type) {

        $data = $request->validate([
            'name' => 'required|min:3',
        ]);

        $id = $request->input('id');
        if( $id ){
            $collection = MangaCollection::find( $id );
            if( $collection ){
                $collection->update([
                    'name' => $data['name']
                ]);
            }
        } else {
            $collection = MangaCollection::create([
                'type' => $type,
                'name' => $data['name']
            ]);
        }

        $label = MangaCollection::getTypeLabel( $type );

        return redirect( route('admin.collection.edit', [
            'type' => $type,
            'id' => $collection->id
        ] ) )->with( 'successMsg', "{$label} saved successfully!" );

    }

    public function edit(Request $request, $type, $id) {

        $collection = MangaCollection::find( $id );

        if( ! $collection || $collection->type !== $type ){
            return redirect( route('admin.collection.all', $type ) )->withErrors([
                'msg' => 'Invalid collection'
            ]);
        }

        return view('admin.collection.edit', compact([ 'type', 'collection' ]));

    }

    public function delete(Request $request, $type, $id) {
        
        $collection = MangaCollection::find( $id );

        if( ! $collection || $collection->type !== $type ){
            return redirect( route('admin.collection.all', $type ) )->withErrors([
                'msg' => 'Invalid collection'
            ]);
        }

        $collection->delete();

        $label = MangaCollection::getTypeLabel( $type );

        return redirect( route('admin.collection.all', $type ) )->with('successMsg', "Deleted {$label} \"{$collection->name}\" successfully!");

    }
    
}
