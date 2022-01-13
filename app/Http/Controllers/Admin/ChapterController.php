<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Str;
use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Manga;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class ChapterController extends Controller
{
    public function all( $manga_id ) {

        $manga = Manga::find( $manga_id );
        if( ! $manga ){
            return redirect()->route('admin.manga.all')->withErrors([
                'msg' => 'Manga not found'
            ]);
        }

        return view('admin.chapter.all', compact(['manga']));

    }

    public function add( $manga_id ){
        
        $manga = Manga::find( $manga_id );
        if( ! $manga ){
            return redirect()->route('admin.manga.all')->withErrors([
                'msg' => 'Manga not found'
            ]);
        }

        return view('admin.chapter.add', compact(['manga']));

    }

    public function save( Request $request, $manga_id ) {

        // validate post request
        $data = $request->merge([
            'manga_id'    => $manga_id,
            'user_id'     => $request->user()->id,
        ])->validate([
            'name'        => 'required|min:1|max:150',
            'manga_id'    => 'required|integer',
            'user_id'     => 'required|integer',
            'extend_name' => 'max:150',
            'coin'        => 'integer',
            'files.*'     => 'image',
            'images'      => 'required|array',
            'released_at' => 'nullable|date',
        ]);

        // merge default values
        $data = array_merge( [
            'released_at' => Carbon::now()
        ], $data );

        // dd( $data );

        if( $request->get('id') ){

            $chapter = Chapter::find( $request->get('id') );

            if( ! $chapter instanceof Chapter ){
                return redirect()->route('admin.manga.chapter.all')->withErrors([
                    'msg' => 'Chapter not found'
                ]);
            }

        } else {
            $chapter = new Chapter();
        }
        
        $chapter->savePostedData( $data );

        return redirect( route('admin.manga.chapter.edit', [
            'chapter' => $chapter->id,
            'id'      => $chapter->manga_id
        ] ) )->with( 'successMsg', 'Saved successfully!' );

    }

    public function edit( $manga_id, $chapter_id ) {

        $chapter = Chapter::find( $chapter_id );
        if( ! $chapter || $chapter->manga_id != $manga_id ) {
            return redirect( route('admin.manga.chapter.all', [
                'id' => $manga_id
            ]) )->withErrors([
                'msg' => 'Chapter not found'
            ]);
        }

        return view('admin.chapter.edit', compact(['chapter']));

    }

    public function delete( $manga_id, $chapter_id ) {

        $chapter = Chapter::find( $chapter_id );
        if( ! $chapter || $chapter->manga_id != $manga_id ) {
            return redirect( route('admin.manga.chapter.all', [
                'id' => $manga_id
            ]) )->withErrors([
                'msg' => 'Chapter not found'
            ]);
        }

        $chapter->delete();

        return redirect( 
            route('admin.manga.chapter.all', [
                'id' => $manga_id
            ]) 
        )->with( 'successMsg', sprintf( 
            'Deleted Chapter "%s" successfully!', 
            $chapter->name 
        ) );

    }

    public function ajaxList( $manga_id ) {

        $chapters = Chapter::whereMangaId( $manga_id )->get();

        return DataTables::of( $chapters )
        ->addColumn('actions', function( Chapter $chapter ) {

            $output = '';

            $output .= sprintf( 
                '<a class="btn btn-success btn-sm mr-1 btn-icon-split" href="%s">
                    <span class="icon text-white-50">
                        <i class="fas fa-eye"></i>
                    </span>
                    <span class="text text-center flex-grow-1">View</span>
                </a>',
                route('chapter.view', [
                    'chapter' => $chapter->slug,
                    'slug' => $chapter->manga->slug
                ])
            );

            $output .= sprintf(
                '<a class="btn btn-primary btn-sm mr-1 btn-icon-split" href="%s">
                    <span class="icon text-white-50">
                        <i class="fas fa-pen"></i>
                    </span>
                    <span class="text text-center flex-grow-1">Edit</span>
                </a>',
                route('admin.manga.chapter.edit', [
                    'chapter' => $chapter->id,
                    'id' => $chapter->manga->id
                ])
            );

            $output .= sprintf(
                '<a 
                    class="btn btn-danger btn-sm btn-icon-split"
                    onclick="appUtils.deleteModal( \'Chapter\', \'%s\', \'%s\' )"
                >
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text text-center flex-grow-1">Delete</span>
                </a>',
                $chapter->name, 
                route('admin.manga.chapter.delete', [
                    'chapter' => $chapter->id,
                    'id' => $chapter->manga->id
                ])
            );

            return $output;
        })
        ->addColumn('created_by', function( $chapter ){
            return $chapter->user->name;
        })
        ->editColumn('coin', function( $chapter ){
            return sprintf('
                <div class="p-2 badge rounded-pill bg-primary text-white">
                    <img src="/img/token.png" class="token-icon">%d tokens
                </div>
            ', $chapter->coin);
        })
        ->editColumn('created_at', function( $chapter ){
            return Str::humanReadString( $chapter->created_at );
        })
        ->editColumn('updated_at', function( $chapter ){
            return Str::humanReadString( $chapter->updated_at );
        })
        ->editColumn('published_at', function( $chapter ){
            return Str::humanReadString( $chapter->updated_at );
        })
        ->rawColumns(['actions', 'coin'])
        ->make();
    }
}
