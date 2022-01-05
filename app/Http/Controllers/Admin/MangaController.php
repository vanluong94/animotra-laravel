<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Str;
use App\Http\Controllers\Controller;
use App\Models\Manga;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class MangaController extends Controller
{   

    public function all() {
        return view('admin.manga.all');
    }

    public function add(){
        return view('admin.manga.add');
    }

    public function edit($id) {
        
        $manga = Manga::find( $id );
        if( ! $manga ){
            return redirect()->route('admin.manga.all')->withErrors([
                'msg' => 'Manga not found'
            ]);
        }

        return view('admin.manga.edit', compact(['manga']));

    }

    public function save(Request $request) {

        // validate post request
        $data = $request->validate([
            'title'          => 'required|min:1|max:150',
            'publish_status' => [
                'required', 
                Rule:: in([ 'published', 'draft' ])
            ],
            'release_status' => [
                'required', 
                Rule:: in([ 'ongoing', 'end', 'completed'])
            ],
            'year' => [
                'integer', 'min:1', 'max:2100'
            ],
            'thumbnail_file' => 'required_without:thumbnail|image',
            'thumbnail'      => 'required_without:thumbnail_file',
            'published_at'   => 'required_with:id|date',
            'summary'        => 'min:5',
            'categories'     => 'array',
            'authors'        => 'array',
            'tags'           => 'array',
        ]);

        if( $request->get('id') ){

            $manga = Manga::find( $request->get('id') );

            if( ! $manga instanceof Manga ){
                return redirect()->route('admin.manga.all')->withErrors([
                    'msg' => 'Manga not found'
                ]);
            }

            // for delete purpose
            foreach( ['categories', 'authors', 'tags'] as $param ){
                if( empty( $data[ $param ] ) ){
                    $data[ $param ] = array();
                }
            }

            if( empty( $data['year'] ) ){
                $data['year'] = null;
            }

        } else {
            $data['user_id'] = $request->user()->id;
            $data['published_at'] = Carbon::now();
            $manga = new Manga();
        }

        $manga->savePostedData( $data );

        return redirect( route('admin.manga.edit', $manga->id ) )->with( 'successMsg', 'Saved successfully!' );

    }

    public function delete( $id ) {

        $manga = Manga::find( $id );

        if( ! $manga instanceof Manga ){
            return redirect()->route('admin.manga.all')->withErrors([
                'msg' => 'Manga not found'
            ]);
        }

        $manga->categories()->detach();
        $manga->tags()->detach();
        $manga->authors()->detach();
        $manga->releaseYear()->detach();
        $manga->delete();

        return redirect( 
            route('admin.manga.all' ) 
        )->with( 'successMsg', sprintf( 
            'Deleted Manga "%s" successfully!', 
            $manga->title 
        ) );

    }

    public function ajaxList() {

        $mangas = Manga::all();

        return Datatables::of( $mangas )
        ->addColumn('actions', function( Manga $manga ) {

            $output = '';

            $output .= sprintf( 
                '<a class="btn btn-success btn-sm mr-1 btn-icon-split" href="%s">
                    <span class="icon text-white-50">
                        <i class="fas fa-eye"></i>
                    </span>
                    <span class="text text-center flex-grow-1">View</span>
                </a>',
                $manga->getViewURL()
            );

            $output .= sprintf(
                '<a class="btn btn-primary btn-sm mr-1 btn-icon-split" href="%s">
                    <span class="icon text-white-50">
                        <i class="fas fa-pen"></i>
                    </span>
                    <span class="text text-center flex-grow-1">Edit</span>
                </a>',
                $manga->getAdminEditURL()
            );

            $output .= sprintf(
                '<a 
                    class="btn btn-danger btn-sm btn-icon-split"
                    onclick="aCommon.deleteModal( \'Manga\', \'%s\', \'%s\' )"
                >
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text text-center flex-grow-1">Delete</span>
                </a>',
                $manga->title, 
                $manga->getAdminDeleteURL()
            );

            return $output;
        })
        ->editColumn('created_at', function( $manga ){
            return Str::humanReadString( $manga->created_at );
        })
        ->editColumn('updated_at', function( $manga ){
            return Str::humanReadString( $manga->updated_at );
        })
        ->editColumn('published_at', function( $manga ){
            return Str::humanReadString( $manga->updated_at );
        })
        ->editColumn('publish_status', function( $manga ){
            return '<div class="text-center">' . $manga->getPublishStatusBadge() . '</div>';
        })
        ->editColumn('thumbnail', function( Manga $manga ){
            return sprintf( '<img src="%s" class="img-thumbnail"/>', $manga->getThumbnailURL() );
        })
        ->editColumn('title', function( Manga $manga ){
            return $manga->title;
        })
        ->rawColumns(['actions', 'thumbnail', 'title', 'publish_status'])
        ->make();

    }
}
