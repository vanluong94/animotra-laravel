@props([
    'title', 'mangas'
])

<div class="m-collection m-collection--big">
    <div class="m-collection__heading">
        <div class="m-heading"><h4 class="m-heading__content">{{ $title }}</h4></div>
    </div>
    <div class="m-collection__content">
        <div class="row">

            @foreach ($mangas as $manga)
                <div class="col-md-3">
                    <x-manga-big-thumb :manga="$manga"></x-manga-big-thumb>
                </div>
            @endforeach

        </div>
    </div>
</div>

