@props([
    'mangas', 'columnClass'
])

@if ($mangas->count())
    <div class="m-collection m-collection--big m-0">
        <div class="m-collection__content">
            <div class="row">
                @foreach ($mangas as $manga)
                    <div class="{{ $columnClass }}">
                        <x-manga-big-thumb :manga="$manga"></x-manga-big-thumb>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{ $mangas->links() }}
@else
    <p class="text-center py-5 text-gray display-6">
        <i class="fas fa-sad-cry"></i> No results found
    </p>
@endif