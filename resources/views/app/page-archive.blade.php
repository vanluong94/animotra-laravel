@section('bodyClass', 'all-page has-page-header' )

@section('pageTitle', $title )

<x-app-layout>
    <x-app.header></x-app.header>

    <main id="site-body">
        <div class="page">
            
            <div class="page__header pb-0">
                <div class="container">
                    <div class="m-heading page-heading text-center">
                        <h1 class="m-heading__content text-normal">{{ $title }}</h1>
                    </div>
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