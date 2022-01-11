<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comment;
use App\Models\Manga;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function post( Request $request ) {

        $data = $request->validate([
            'content'    => 'required',
            'manga_id'   => 'required|integer',
            'chapter_id' => 'integer'
        ]);

        $manga = Manga::find( $data['manga_id'] );
        if( ! $manga ){
            abort(404);
        }

        if( isset( $data['chapter_id'] ) ){
            $chapter = Chapter::find( $data['chapter_id'] );
            if( ! $chapter ){
                abort(404);
            }
        }

        $comment = Comment::create([
            'user_id'    => $request->user()->id,
            'manga_id'   => $manga->id,
            'chapter_id' => isset( $chapter ) ? $chapter->id : null,
            'content'    => strip_tags( $request->content )
        ]);

        $comment_id = '#comment-' . $comment->id;
        
        if( isset( $chapter ) ) {
            $url = route('chapter.view', [
                'slug'    => $manga->slug,
                'chapter' => $chapter->slug
            ]) . $comment_id;
        } else {
            $url = route('manga.view', [
                'slug'    => $manga->slug,
            ]) . $comment_id;
        }

        return redirect( $url );

    }
}
