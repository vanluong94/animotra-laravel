@push('vendorScripts')
    <link href="/assets/vendor/select2.min.css" rel="stylesheet" />
    <link href="/assets/vendor/select2-bootstrap.css" rel="stylesheet" />
    <script src="/assets/vendor/select2.min.js"></script>
@endpush

@push('headerScripts')
    <link rel="stylesheet" href="/assets/app/css/search.css">
@endpush

@push('floatMenuItems')
    <a href="{{ $collection->getAdminEditUrl() }}" class="menu-item item-2" data-toggle="tooltip" data-placement="top" title="Edit {{ $collection->getTypeLabelSingular() }}">
        <i class="fas fa-pen-square"></i>
    </a>
    <a href="{{ route('admin.collection.add', $collection->type) }}" class="menu-item item-3" data-toggle="tooltip" data-placement="top" title="All  {{ $collection->getTypeLabelPlural() }}">
        <i class="fas fa-list"></i>
    </a>
@endpush

@section('bodyClass', 'all-page has-page-header ' )

@section('pageTitle', 'All Mangas' )

<x-app-layout>
    <x-app.header></x-app.header>

    <main id="site-body">
        <div class="page">
            
            <div class="page__header pb-0">
                <div class="container">
                    <p class="text-center fs-5 m-0">{{ $collection->getTypeLabelSingular() }}</p>
                    <h1 class="text-center m-0 fw-bold">{{ $collection->name }}</h1>
                </div>
            </div>

            <div class="page__content">
                <div class="container">
                    <x-app.m-collections :mangas="$mangas" columnClass="col-md-3"></x-app.m-collections>
                </div>
            </div>

        </div>
    </main>

    <x-app.footer></x-app.footer>   

</x-app-layout>