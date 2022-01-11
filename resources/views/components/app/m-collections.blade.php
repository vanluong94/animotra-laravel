@props([
    'mangas'
])

@if ($mangas->count())
    <div class="m-collection m-collection--big m-0">
        <div class="m-collection__content">
            <div class="row">
                @foreach ($mangas as $manga)
                    <div class="col-md-3">
                        <x-app.card-manga-big :manga="$manga"></x-app.card-manga-big>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{ $mangas->links() }}
@else
    <h3 class="text-center">
        <i class="fas fa-sad-cry"></i> No results found
    </h3>
@endif