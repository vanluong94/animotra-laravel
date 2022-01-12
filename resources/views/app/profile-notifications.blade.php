@section('pageTitle', 'Profile | Notifications' )

<x-profile :user="$user">
    <section>
        <h1 class="h4 text-uppercase fw-bold mb-4">Notifications</h1>
    
        <ul class="timeline notifications-timeline">
            @foreach ($user->notifications()->limit(10)->get() as $noti)
                <li class="{{ $noti->isRead() ? '' : 'unread' }}">
                    <div class="card">
                        <a href="{{ $noti->getReadUrl() }}" class="">
                            <div class="card-body d-flex justify-content-between">
                                <span>{!! $noti->content !!}</span>
                                <span>{{ $noti->created_at->format('M d, Y H:i') }}</span>
                            </div>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </section>
</x-profile>