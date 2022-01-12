@props([
    'manga'
])

<div class="m-item">
    <div class="item-thumbnail">
        <a href="{{ $manga->getViewUrl() }}">
            <div class="thumbnail">
                <img src="{{ $manga->getThumbnailUrl() }}" alt="{{ $manga->title }}">
            </div>
        </a>
    </div>
    
    <div class="item-meta">
        <div class="item-title"><a href="#">{{ $manga->title }}</a></div>
        @if (($latestChapter = $manga->getLatestChapter()))
            <div class="item-title">
                <a href="{{ $latestChapter->getViewUrl() }}">{{ $latestChapter->name }}</a>
            </div>
            <div class="item-link">
                <a href="{{ $manga->getViewUrl() }}">Read now</a>
            </div>
        @endif
    </div>
</div>