<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Str;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CommentController extends Controller
{
    public function all() {
        return view('admin.comment.all');
    }

    public function ajaxList() {
        $comments = Comment::query();

        return DataTables::of( $comments )
        ->addColumn('avatar', function( Comment $comment ){
            return sprintf( '<img src="%s" class="rounded-circle img-avatar"/>', $comment->user->getAvatar() );
        })
        ->addColumn('user', function( Comment $comment ){
            return $comment->user->username;
        })
        ->addColumn('article', function( Comment $comment ){
            return sprintf( '<a href="%s">%s</a>', $comment->getPageUrl(), $comment->getPageName() );
        })
        ->editColumn('created_at', function( $manga ){
            return Str::humanReadDatetime( $manga->created_at );
        })
        ->addColumn('actions', function( Comment $comment ) {

            $output = '';

            $output .= sprintf( 
                '<a class="btn btn-success btn-sm mr-1 btn-icon-split" href="%s">
                    <span class="icon text-white-50">
                        <i class="fas fa-eye"></i>
                    </span>
                    <span class="text text-center flex-grow-1">View</span>
                </a>',
                $comment->getViewUrl()
            );

            $output .= sprintf(
                '<a 
                    class="btn btn-danger btn-sm btn-icon-split"
                    onclick="appUtils.deleteModal( \'Comment\', \'%s\', \'%s\' )"
                >
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text text-center flex-grow-1">Delete</span>
                </a>',
                substr( $comment->content, 0, 100 ), 
                $comment->getAdminDeleteUrl()
            );

            return $output;
        })
        ->rawColumns(['actions', 'avatar', 'article'])
        ->make();

    }

    public function delete( $id ) {

        $comment = Comment::find( $id );
        if( ! $comment ) {
            return redirect()->route('admin.comment.all')->withErrors([
                'msg' => 'Comment not found'
            ]);
        }

        $comment->delete();

        return redirect()->route('admin.comment.all')->with( 'successMsg', 'Deleted comment successfully!' );

    }
}

