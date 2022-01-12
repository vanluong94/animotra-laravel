@push('headerScripts')

    <link rel="stylesheet" href="/assets/app/css/page.css">
    <link rel="stylesheet" href="/assets/app/css/chapter.css">
    <link rel="stylesheet" href="/assets/app/css/comments.css">

@endpush

@push('footerScripts')
    <script src="/assets/app/js/chapter.js"></script>
@endpush

@section('bodyClass', 'manga-page has-page-header')

@section('pageTitle', $chapter->getFullName() . ' | ' . $chapter->manga->title )

@push('floatMenuItems')
    <a href="{{ $chapter->getAdminEditURL() }}" class="menu-item item-2" data-toggle="tooltip" data-placement="top" title="Edit Chapter">
        <i class="fas fa-pen-square"></i>
    </a>
    <a href="{{ $chapter->manga->getAdminEditURL() }}" class="menu-item item-3" data-toggle="tooltip" data-placement="top" title="Edit Manga">
        <i class="fas fa-book-open"></i>
    </a>
    <a href="{{ $chapter->manga->getAdminChaptersList() }}" class="menu-item item-4" data-toggle="tooltip" data-placement="top" title="Edit Manga Chapters List">
        <i class="fas fa-th-list"></i>
    </a>
@endpush

<x-app-layout>
    <x-app.header></x-app.header>

    <main id="site-body">
        <div class="page">

            <div class="page__header">
                <div class="container">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <h1 class="text-uppercase h4 mb-4"><a href="{{ route('manga.view', $chapter->manga->slug) }}">{{ $chapter->manga->title }}</a></h1>

                        <div id="chapterNavigator" class="btn-group rounded-pill overflow-hidden" role="group">
                            <button id="chapterPrev" class="btn btn-secondary rounded-0">Previous</button>
                            
                            <select id="chaptersDropdown" class="btn border-0 rounded-0 form-select">
                                @foreach ($chapter->manga->chapters as $c)
                                    <option value="{{ $c->getViewUrl() }}" {{ $c->id == $chapter->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>

                            <button id="chapterNext" class="btn btn-primary rounded-0">Next</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page__content">
                <div class="container">

                    @guest
                        <x-alert-login-required></x-alert-login-required>    
                    @endguest

                    @auth
                        @if(Auth::user()->hasPurchased($chapter))
                            <!-- READING FRAME -->
                            <section id="readingFrame">
                                <div class="reading__header">
                                    <div id="chapterPageNavigator" class="d-flex justify-content-between">
                                        <button id="pagePrev" class="btn bg-transparent rounded-0"><i class="fas fa-angle-left me-1"></i> Previous Page</button>
                                        <select id="pagesDropdown" class="btn border-0 rounded-0 form-select w-auto px-5">
                                            @foreach ($chapter->getImageUrls()->keys() as $index)
                                                <option value="{{ $index + 1 }}">Page {{ str_pad( $index + 1, 2, 0, STR_PAD_LEFT )}}</option>
                                            @endforeach
                                        </select>
                                        <button id="pageNext" class="btn bg-transparent rounded-0">Next Page <i class="fas fa-angle-right ms-1"></i></button>
                                    </div>
                                </div>
                                <div class="reading__content">
                                    <img id="theImage" src="{{ $chapter->getImageUrls()->shift() }}" alt="{{ $chapter->getFullName() }}">
                                </div>

                                <script>
                                    const chapterImgs = {!! json_encode( $chapter->getImageUrls() ) !!}
                                </script>
                            </section>
                        @else
                            <x-alert-purchase :chapter="$chapter"></x-alert-purchase>
                        @endif
                    @endauth    

                    <div class="mb-5"></div>

                    @if (Auth::check() || $chapter->comments->count())
                        <!-- COMMENT -->
                        <section id="comments">

                            <div class="m-heading"><h4 class="m-heading__content">Comments</h4></div>

                            <x-app.comments :manga="$chapter->manga" :chapter="$chapter" :comments="$chapter->comments"></x-app.comments>
                            
                        </section>
                    @endif

                </div>
            </div>  
        </div>

        {{-- <script>
            const ajaxUrls = {
                rating: '{{ route('ajax.manga.rate', $manga->id )}}',
                userCollectionToggle: '{{ route('ajax.user_collection.toggle') }}'
            };
        </script> --}}

    </main>

    <x-app.footer></x-app.footer>   

</x-app-layout>