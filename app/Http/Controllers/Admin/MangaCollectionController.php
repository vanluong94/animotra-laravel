<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Str;
use App\Http\Controllers\Controller;
use App\Models\MangaCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;

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

        return redirect( route('admin.collection.edit', [
            'type' => $type,
            'id' => $collection->id
        ] ) )->with(  'successMsg', $collection->getTypeLabelSingular() . " saved successfully!" );

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

        return redirect( 
            route('admin.collection.all', $type ) 
        )->with( 'successMsg', sprintf( 
            'Deleted %s "%s" successfully!', 
            $collection->getTypeLabelSingular(), 
            $collection->name 
        ) );

    }

    /**
     * Return list of collections via AJAX
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxList(Request $request, $type) {

        $collections = MangaCollection::whereType( $type );

        return Datatables::of( $collections )
        ->addColumn('manga_count', function( MangaCollection $collection ){
            return 0;
        })
        ->addColumn('actions', function( MangaCollection $collection ) {

            $output = sprintf( 
                '<a class="btn btn-success btn-sm mr-1 btn-icon-split" href="%s">
                    <span class="icon text-white-50">
                        <i class="fas fa-eye"></i>
                    </span>
                    <span class="text text-center flex-grow-1">View</span>
                </a>',
                $collection->getViewURL()
            );

            $output .= sprintf(
                '<a class="btn btn-primary btn-sm mr-1 btn-icon-split" href="%s">
                    <span class="icon text-white-50">
                        <i class="fas fa-pen"></i>
                    </span>
                    <span class="text text-center flex-grow-1">Edit</span>
                </a>',
                $collection->getAdminEditURL()
            );

            $output .= sprintf(
                '<a 
                    class="btn btn-danger btn-sm btn-icon-split"
                    onclick="aCommon.deleteModal( \'%s\', \'%s\', \'%s\' )"
                >
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text text-center flex-grow-1">Delete</span>
                </a>',
                $collection->getTypeLabelSingular(), 
                $collection->name, 
                $collection->getAdminDeleteURL()
            );

            return $output;
        })
        ->editColumn('created_at', function( $collection ){
            return Str::humanReadString( $collection->created_at );
        })
        ->editColumn('updated_at', function( $collection ){
            return Str::humanReadString( $collection->updated_at );
        })
        ->rawColumns(['actions'])
        ->make();
    }

    /**
     * Search manga collections via AJAX
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSearch(Request $request, $type) {

        $query = MangaCollection::whereType( $type )
        ->where('name', 'like', '%' . $request->input('search') . '%');

        if( $request->has('selected') && ( $selected = $request->input('selected') ) ) {
            if( is_array( $selected ) ){
                $query = $query->whereNotIn('name', $selected);
            } else {
                $query = $query->where('name', 'not like', $selected);
            }
        }

        $results = $query->paginate(10);

        return response()->json([
            'results' => array_map(function($collection){
                return [
                    'id'   => $collection->name,
                    'text' => $collection->name
                ];
            }, $results->items()),
            'pagination' => [
                'more' => $results->hasMorePages()
            ],
        ]);

    }
    
}
