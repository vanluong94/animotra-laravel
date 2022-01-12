@props([
    'mangas'
])

<div class="m-collection m-collection--small">
    <div class="m-collection__content">
        @foreach ($mangas as $manga)
            <x-manga-small-thumb :manga="$manga"></x-manga-small-thumb>
        @endforeach
    </div>
</div>