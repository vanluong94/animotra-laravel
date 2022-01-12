@props([
    'title', 'mangas'
])

<div class="m-collection m-collection--big m-slider featured-slider">
    <div class="m-collection__heading">
        <div class="m-heading"><h4 class="m-heading__content">{{ $title }}</h4></div>
    </div>
    <div class="m-collection__content glider-contain">
        <div class="glider" data-glider='{"slidesToShow":3,"slidesToScroll":3,"dots":".dots"}'>

            @foreach ($mangas as $manga)
                <x-manga-big-thumb :manga="$manga"></x-manga-big-thumb>
            @endforeach

        </div>
        <div class="dots" role="tablist"></div>
    </div>
</div>