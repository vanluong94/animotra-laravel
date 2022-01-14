@props([
    'manga'
])

<div class="m-item">
    <div class="thumbnail">
        <div class="thumbnail-content" style="background-image: url({{ $manga->getThumbnailUrl() }})">
            
        </div>
    </div>
    <div class="meta__top">
        <div class="badge--left">
            <div class="badge--left-wrapper">
                <div class="badge--left-content">
                    <div class="badge-text-big">{{ $manga->getRating() }}</div>
                    <div class="badge-text">rating</div>
                </div>
            </div>
        </div>
        <div class="badge--right">
            <i class="fas fa-play"></i>
        </div>
    </div>
    <div class="meta__bottom">
        <div class="meta-title">
            <div class="item-title text-nowrap"><a href="{{ $manga->getViewUrl() }}">{{ $manga->title }}</a></div>
            @if (($latestChapter = $manga->getLatestChapter()))
                <div class="manga-chapter">
                    <a href="{{ $latestChapter->getViewUrl() }}">{{ $latestChapter->getFullName() }}</a>
                </div>
            @endif
        </div>
    </div>
    <a href="{{ $manga->getViewUrl() }}" class="item-link"></a>
</div>