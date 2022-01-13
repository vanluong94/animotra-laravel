@section('bodyClass', 'all-page has-page-header' )

@section('pageTitle', $title )

<x-app-layout>
    <x-app.header></x-app.header>

    <main id="site-body">
        <div class="page">
            
            <div class="page__header pb-0">
                <div class="container">
                    <h1 class="text-center m-0 fw-bold">{{ $title }}</h1>
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