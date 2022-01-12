@props([
    'title', 'mangas'
])

<div class="m-collection m-slider m-collection--big">
    <div class="m-collection__heading">
        <div class="m-heading"><h4 class="m-heading__content">{{ $title }}</h4></div>
    </div>
    <div class="m-collection__content glider-contain">
        <div 
            class="glider"
            data-glider='{
                "slidesToShow":4,
                "slidesToScroll":3,
                "arrows":
                    {
                        "prev":".glider-prev",
                        "next":".glider-next"
                    }
                }'
        >
            @foreach ($mangas as $manga)
                <x-manga-big-thumb :manga="$manga"></x-manga-big-thumb>
            @endforeach
        </div>
        <button class="glider-prev glider-paginate" aria-label="Previous"><i></i><i></i></button>
        <button class="glider-next glider-paginate" aria-label="Next"><i></i><i></i></button>
    </div>
</div>