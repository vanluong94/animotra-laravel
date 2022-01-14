@auth
    <form action="{{ route('comment.post') }}" method="POST" id="commentForm" class="my-4">
        <div class="form-floating mb-3">
            <textarea class="form-control" id="commentContent" name="content" value="" placeholder="Comment" style="height: 100px;" required></textarea>
            <label for="commentContent">Comment</label>
        </div>

        <input type="hidden" name="manga_id" value={{ $manga->id }}>

        @if (isset( $chapter ))
            <input type="hidden" name="chapter_id" value="{{ $chapter->id }}">
        @endif

        @csrf

        <button type="submit" class="btn btn-primary btn-lg text-uppercase">Post</button>
    </form>
@endauth

<div id="commentsList">
    @if ($comments->count())
        <ul>
            @foreach ($comments as $comment)
                <li class="comment-item" id="comment-{{ $comment->id }}">
                    <div class="comment-item__header">
                        <div class="comment-item__header--left">
                            <div class="user-avatar rounded-circle overflow-hidden">
                                <img src="{{ $comment->user->getAvatar() }}" alt="{{ $comment->user->name }}">
                            </div>
                        </div>
                        <div class="comment-item__header--right">
                            <div class="comment-item-author">{{ $comment->user->name }}</div>
                            <div class="comment-item-datetime">{{ $comment->created_at }}</div>
                        </div>
                    </div>
                    <div class="comment-item__content">
                        <p>{{ $comment->content }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-center fs-5">Let's be the first one make the mark here!</p>
    @endif
</div>