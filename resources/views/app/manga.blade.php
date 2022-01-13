@push('headerScripts')

    <script src="/assets/vendor/star-rating/star-rating.min.js"></script>
    <script src="/assets/vendor/star-rating/theme.min.js"></script>
    
    <link rel="stylesheet" href="/assets/vendor/star-rating/star-rating.min.css">
    <link rel="stylesheet" href="/assets/vendor/star-rating/theme.min.css">
    <link rel="stylesheet" href="/assets/vendor/animate.min.css"/>

    <link rel="stylesheet" href="/assets/app/css/page.css">
    <link rel="stylesheet" href="/assets/app/css/manga.css">
    <link rel="stylesheet" href="/assets/app/css/comments.css">

@endpush

@push('footerScripts')
    <script src="/assets/app/js/manga.js"></script>    
@endpush

@push('floatMenuItems')
    <a href="{{ $manga->getAdminEditUrl() }}" class="menu-item item-2" data-toggle="tooltip" data-placement="top" title="Edit Manga">
        <i class="fas fa-pen-square"></i>
    </a>
    <a href="{{ $manga->getAdminChaptersListUrl() }}" class="menu-item item-3" data-toggle="tooltip" data-placement="top" title="Edit Manga Chapters List">
        <i class="fas fa-stream"></i>
    </a>
    <a href="{{ route('admin.manga.all') }}" class="menu-item item-4" data-toggle="tooltip" data-placement="top" title="All Mangas Dashboard">
        <i class="fas fa-th-list"></i>
    </a>
@endpush

@section('bodyClass', 'manga-page has-page-header ' . (Auth::check() ? 'has-user' : ''))

@section('pageTitle', $manga->title )

<x-app-layout>
    <x-app.header></x-app.header>

    <main id="site-body">
        <div class="page">

            <!-- PAGE HEADER -->
            <div class="page__header">
                <div class="manga__header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <h1 class="manga__title h3">{{ $manga->title }}</h1>
                                <div class="manga-status mb-1">
                                    <span class="manga-status__label mr-1">Manga Status:</span>
                                    <span class="manga-status__value">{{ $manga->getReleaseStatus() }}</span>
                                </div>
                                <div class="manga__rating">
                                    <input id="mangaRating" name="mangaRating" value="{{ $manga->rating }}" class="kv-ltr-theme-fas-star rating-loading" data-size="sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PAGE CONTENT -->
            <div class="page__content">
                <div class="container">
                    <div class="row">

                        <!-- SIDEBAR -->
                        <div class="sidebar-col col-md-4">
                            <div class="sidebar-col__content sidebar--offset">

                                <!-- MANGA INFO -->
                                <section class="manga-info bg-white mb-5">
                                    <div class="m-table">
                                        <div class="m-table__row p-0">
                                            <div class="manga-thumbnail bg-image-cover" style="background-image: url({{ $manga->getThumbnailURL() }})">
                                                <a href="{{ $manga->getViewUrl() }}">
                                                    
                                                </a>
                                            </div>
                                        </div>

                                        @if ($manga->categories->isNotEmpty())
                                            <div class="m-table__row">
                                                <span class="m-table__row-label">Category:</span>
                                                <span class="m-table__row-value">
                                                    @foreach ($manga->categories as $cat)
                                                        <a href="{{ $cat->getViewUrl() }}">{{ $cat->name }}</a>
                                                    @endforeach
                                                </span> 
                                            </div>
                                        @endif

                                        @if ($manga->year->isNotEmpty())
                                            <div class="m-table__row">
                                                <span class="m-table__row-label">Release Year:</span>
                                                <span class="m-table__row-value">
                                                    @foreach ($manga->year as $year)
                                                        <a href="{{ $year->getViewUrl() }}">{{ $year->name }}</a>
                                                    @endforeach
                                                </span> 
                                            </div>
                                        @endif

                                        @if ($manga->authors->isNotEmpty())
                                            <div class="m-table__row">
                                                <span class="m-table__row-label">Author:</span>
                                                <span class="m-table__row-value">
                                                    @foreach ($manga->authors as $author)
                                                        <a href="{{ $author->getViewUrl() }}">{{ $author->name }}</a>
                                                    @endforeach
                                                </span> 
                                            </div>
                                        @endif

                                        <div class="m-table__row">
                                            <span class="m-table__row-label">Rank:</span>
                                            <span class="m-table__row-value">#768</span>
                                        </div>

                                        <div class="m-table__row">
                                            <span class="m-table__row-label">Chapters:</span>
                                            <span class="m-table__row-value">{{ count( $manga->chapters )}}</span>
                                        </div>
                                    </div>
                                </section>

                                @if ($manga->relatedMangas()->isNotEmpty())
                                    <!-- RELATED MANGA -->
                                    <section class="related-mangas mb-5">
                                        <h3 class="manga-info-heading text-uppercase">Related Mangas</h3>
                                        <div class="m-collection m-collection--small my-0">
                                            <div class="m-collection__content">
                                                @foreach ($manga->relatedMangas() as $r_manga)
                                                    <div class="m-item">
                                                        <div class="item-thumbnail">
                                                            <a href="{{ $r_manga->getViewUrl() }}">
                                                            <div class="thumbnail">
                                                                    <img src="{{ $r_manga->getThumbnailUrl() }}" alt="{{ $r_manga->title }}">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        
                                                        <div class="item-meta">
                                                                <div class="item-title"><a href="#">{{ $r_manga->title }}</a></div>
                                                                @if (($latestChapter = $r_manga->getLatestChapter()))
                                                                    <div class="item-title">
                                                                        <a href="{{ $latestChapter->getViewUrl() }}">{{ $latestChapter->name }}</a>
                                                                    </div>
                                                                    <div class="item-link">
                                                                        <a href="{{ $r_manga->getViewUrl() }}">Read now</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </section>
                                @endif

                            </div>
                        </div>

                        <!-- MAIN COL -->
                        <div class="main-col col-md-8">

                            <div class="main-col__content">

                                @if($manga->getSummary()) 
                                    <!-- SUMMARY -->
                                    <section class="manga-summary mb-5">
                                        <h3 class="manga-info-heading text-uppercase">The Story Line</h3>
                                        <p>
                                            {!! $manga->getSummary() !!}
                                        </p>
                                    </section>
                                @endif

                                <!-- BUTTONS -->
                                <section class="manga-buttons mb-5">

                                    <x-app.user-collection-btn 
                                        class="btn btn-favorite" 
                                        :manga="$manga" 
                                        added-icon="fas fa-heart" 
                                        add-icon="far fa-heart" 
                                        animate="bounceIn"
                                        text="Add to Favorite" 
                                        collection="favorite"
                                    ></x-app.user-collection-btn>

                                    <x-app.user-collection-btn 
                                        class="btn btn-read-later" 
                                        :manga="$manga" 
                                        added-icon="fas fa-clock" 
                                        add-icon="far fa-clock" 
                                        animate="bounceIn"
                                        animate="flash"
                                        text="Read Later" 
                                        collection="read_later"
                                    ></x-app.user-collection-btn>

                                    <x-app.user-collection-btn 
                                        class="btn btn-subscribe" 
                                        :manga="$manga" 
                                        added-icon="fas fa-bell" 
                                        add-icon="far fa-bell" 
                                        animate="tada"
                                        text="Subscribe" 
                                        collection="subscribe"
                                    ></x-app.user-collection-btn>

                                    <div class="btn btn-rate" data-bs-toggle="modal" data-bs-target="#rateModal">
                                        <div class="btn__icon"><i class="fas fa-star"></i></div>
                                        <div class="btn__text"><span class="text-uppercase">Rate It</span></div>
                                    </div>
                                        
                                </section>

                                @if ($manga->chapters->isNotEmpty())
                                    <section class="manga-chapters-list mb-5">

                                        <h3 class="manga-info-heading text-uppercase">Chapters List</h3>

                                        {{-- CHAPTER LIST START --}}
                                        <ul id="chapters-list">

                                            @foreach ($manga->chapters as $chapter)
                                                <li class="chapter-item">
                                                    <div class="chapter-item--left">
                                                        <div class="chapter-name">
                                                            <a href="{{ $chapter->getViewUrl() }}">{{ $chapter->name }}</a>
                                                        </div>
                                                        <div class="chapter-extend-name">
                                                            <a href="{{ $chapter->getViewUrl() }}">{{ $chapter->extend_name }}</a>
                                                        </div>
                                                    </div>
                                                    <div class="chapter-item--right">
                                                        <div class="chapter-buttons">
                                                            @if ($chapter->coin)
                                                                <a href="{{ $chapter->getViewUrl() }}" class="btn btn-primary btn-go-chapter {{ Auth::user()->hasPurchased($chapter) ? 'purchased' : '' }}">
                                                                    <img src="/img/token.png" alt="token" class="token-icon">{{ $chapter->coin }}
                                                                </a>
                                                            @else
                                                                <a href="{{ $chapter->getViewUrl() }}" class="btn btn-success rounded-pill text-uppercase btn-go-chapter">
                                                                    free
                                                                </a>
                                                            @endif
                                                            {{-- <a class="btn" href="{{ $chapter->getViewUrl() }}"><i class="fas fa-book-reader"></i></a> --}}
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                        {{-- CHAPTER LIST END --}}

                                    </section>
                                @endif

                                @if ($manga->tags->isNotEmpty())
                                    <section class="manga-tags mb-5">
                                        <h3 class="manga-info-heading text-uppercase">Tags</h3>
                                        <ul id="tags-list">
                                            @foreach ($manga->tags as $tag)
                                                <li>
                                                    <a href="{{ $tag->getViewUrl() }}" class="tag-item">{{ $tag->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </section>
                                @endif

                                <section class="manga-comments mb-5">

                                    <div class="m-heading">
                                        <h4 class="m-heading__content">Comments</h4>
                                    </div>
                                    
                                    <x-app.comments :manga="$manga" :comments="$manga->comments"></x-app.comments>
                                    
                                </section>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <x-app.modal-rating :rating="$manga->rating"></x-app.modal-rating>

        <script>
            const ajaxUrls = {
                rating: '{{ route('ajax.manga.rate', $manga->id )}}',
                userCollectionToggle: '{{ route('ajax.user_collection.toggle') }}'
            };
        </script>
    </main>

    <x-app.footer></x-app.footer>   
</x-app-layout>