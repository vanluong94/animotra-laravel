@push('vendorScripts')
    <link href="/assets/vendor/select2.min.css" rel="stylesheet" />
    <link href="/assets/vendor/select2-bootstrap.css" rel="stylesheet" />
    <script src="/assets/vendor/select2.min.js"></script>
@endpush

@push('headerScripts')
    <link rel="stylesheet" href="/assets/app/css/search.css">
@endpush

@push('footerScripts')
    <script>
        jQuery(function($){

            $('.select2-field').select2().on("select2:open", function (e) {  
                if( ! $(this).parent().hasClass('keep-floating') ){
                    $(this).parent().addClass('label-floating');
                }
            }).on("select2:close", function (e) {
                if( ! $(this).parent().hasClass('keep-floating') ){
                    let hasValue = false;
                    let val = $(this).val();
                    if (Array.isArray(val)) {
                        hasValue = val.length ? true : false;
                    } else {
                        hasValue = val ? true : false;
                    }
                    $(this).parent().toggleClass('label-floating', hasValue);
                }
            })

            $(".select2-tags").each((i, e) => {
                let $this = $(e);
                let $parent = $this.parent();
                
                $this.select2({
                    minimumInputLength: 1,
                    ajax: {
                        url: $this.data('ajax-url'),
                        data: function (params) {

                            var query = {
                                search: params.term,
                                page: params.page || 1,
                                selected: $this.val()
                            }

                            // Query parameters will be ?search=[term]&page=[page]
                            return query;
                        }
                    }
                })
                
                $this.on("select2:open", function (e) {  
                    $parent.addClass('label-floating');
                }).on("select2:close", function (e) {
                    $hasValue = false;
                    if (Array.isArray($this.val())) {
                        $hasValue = $this.val().length ? true : false;
                    } else {
                        $hasValue = $this.val() ? true : false;
                    }
                    $parent.toggleClass('label-floating', $hasValue);
                })

            })

            $('#advancedSearchForm').on('reset', function(e){
                e.preventDefault();

                $(this).find('[name]').each(function(i,e){
                    $(e).val('').trigger('change').trigger('select2:close');
                })
            })

            $(document).ready(function(){
                if(!$('body').hasClass('advanced-search')) {
                    $('button[data-bs-target="#collapsableSearch"]').click();
                }
            })
            
        });
    </script>
@endpush

@section('bodyClass', 'manga-page has-page-header ' . ($isSearchExpanded ? 'advanced-search' : '') )

@section('pageTitle', 'All Mangas' )

<x-app-layout>
    <x-app.header></x-app.header>

    <main id="site-body">
        <div class="page">
            
            <div class="page__header pb-0">

                <div class="filters__top d-flex justify-content-center border-bottom pb-5">
                    <div class="container">
                        <!-- SORTING -->
                        <ul class="filter-sorting filters-list d-flex-center mb-3">
                            <li class="filter-item">
                                <a 
                                    href="{{ request()->fullUrlWithQuery([ 'order' => 'alphabet']) }}" 
                                    class="text-uppercase {{ $order == 'alphabet' ? 'fw-bold' : '' }}"
                                >Sort By a-z</a>
                            </li>
                            <li class="filter-item">
                                <a 
                                    href="{{ request()->fullUrlWithQuery([ 'order' => 'rating']) }}" 
                                    class="text-uppercase {{ $order == 'rating' ? 'fw-bold' : '' }}"
                                >Sort By rating</a></li>
                            <li class="filter-item">
                                <a 
                                    href="{{ request()->fullUrlWithQuery([ 'order' => 'newest']) }}" 
                                    class="text-uppercase {{ $order == 'newest' ? 'fw-bold' : '' }}"
                                >Sort By newest</a></li>
                        </ul>
                        <!-- ALPHABET -->
                        <ul class="filter-alphabet filters-list d-flex-center">
                            @foreach ([
                                'all', 'char', 
                                'a', 'b', 'c', 'd', 'e', 'f', 
                                'g', 'h', 'i', 'k', 'l', 'm', 'n', 'o', 
                                'p', 'q', 'r', 's', 't', 'u', 'v', 
                                'w', 'x', 'y', 'z'
                            ] as $g)
                                <li class="filter-item">
                                    <a 
                                        href="{{ request()->fullUrlWithQuery([ 'group' => $g]) }}" 
                                        class="text-uppercase {{ $group == $g ? 'fw-bold' : '' }}"
                                    >{{ $g == 'char' ? '#' : ucfirst( $g ) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="filters__center py-2">
                    <button class="btn text-center d-block w-100 text-gray" data-bs-toggle="collapse" data-bs-target="#collapsableSearch" role="button" aria-expanded="true" aria-controls="collapsableSearch">
                        Advanced Search
                    </button>
                </div>
                <div id="collapsableSearch" class="filters__bottom collapse show border-top">
                    <div class="container py-5">
                        <form method="GET" id="advancedSearchForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="s" id="search_keyword" placeholder="Search keywords" value="{{ $s }}">
                                        <label for="search_keyword"><i class="fas fa-search"></i> Search keywords</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3 label-floating keep-floating">
                                        <select name="release_status" id="" class="select2-field form-control">
                                            <option value="">All</option>
                                            <option value="ongoing" {{ isset( $releaseStatus ) && $releaseStatus == 'ongoing' ? 'selected' : '' }}>On Going</option>
                                            <option value="end" {{ isset( $releaseStatus ) && $releaseStatus == 'end' ? 'selected' : '' }}>End</option>
                                            <option value="completed" {{ isset( $releaseStatus ) && $releaseStatus == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                        <label for="search_status"><i class="fas fa-swatchbook"></i> Manga Status</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3 {!! isset( $year ) ? 'label-floating' : '' !!}">
                                        <select name="year" id="" class="form-control select2-tags" data-ajax-url="{{ route('admin.ajax.collection.search', 'year')}}">
                                            @if (isset($year))
                                                <option value="{{ $year }}" selected>{{ $year }}</option>
                                            @endif
                                        </select>
                                        <label><i class="fas fa-book-open"></i> Manga Release Year</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3 {!! !empty( $categories ) ? 'label-floating' : '' !!}">
                                        <select name="categories[]" id="" class="form-control select2-tags" data-ajax-url="{{ route('admin.ajax.collection.search', 'category')}}" multiple>
                                            @if (isset($categories) && is_array($categories))
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category }}" selected>{{ $category }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <label><i class="fas fa-archive"></i> Manga Categories</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3 {!! !empty( $tags ) ? 'label-floating' : '' !!}">
                                        <select name="tags[]" id="" class="form-control select2-tags" data-ajax-url="{{ route('admin.ajax.collection.search', 'tag')}}" multiple>
                                            @if (isset($tags) && is_array($tags))
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag }}" selected>{{ $tag }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <label><i class="fas fa-tags"></i> Manga Tags</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3 {!! !empty( $authors ) ? 'label-floating' : '' !!}">
                                        <select name="authors[]" id="" class="form-control select2-tags" data-ajax-url="{{ route('admin.ajax.collection.search', 'author')}}" multiple>
                                            @if (isset($authors) && is_array($authors))
                                                @foreach ($authors as $author)
                                                    <option value="{{ $author }}" selected>{{ $author }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <label><i class="fas fa-pen-nib"></i> Manga Authors</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-lg-center mt-3">
                                <div class="btn-group">
                                    <button type="reset" class="btn btn-secondary btn-lg">Reset</button>
                                    <button type="submit" class="btn btn-primary bt-lg">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="page__content">
                <div class="container">
                    <x-app.m-collections :mangas="$mangas"></x-app.m-collections>
                </div>
            </div>

        </div>
    </main>

    <x-app.footer></x-app.footer>   

</x-app-layout>