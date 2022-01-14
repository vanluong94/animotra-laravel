@section('pageTitle', 'Profile | Comments' )

@push('headerScripts')
    <link rel="stylesheet" href="/assets/app/css/comments.css">
@endpush

<x-profile :user="$user">
    <section>
        <h1 class="h4 text-uppercase fw-bold mb-4">Your Comments</h1>
        @if ($comments->isNotEmpty())
            <ul class="timeline">
                @foreach ($comments as $comment)
                    <li>
                        <div class="d-flex justify-content-between">
                            <a href="{{ $comment->getPageUrl() }}">{{ $comment->getPageName() }}</a>
                            <a href="{{ $comment->getViewUrl() }}" class="float-right">{{ $comment->created_at->format('M d, Y H:i') }}</a>
                        </div>
                        <div class="comment-item" id="comment-{{ $comment->id }}">
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
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>You have no comment</p>
        @endif
    </section>
</x-profile>