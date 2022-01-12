@push('headerScripts')
    <link rel="stylesheet" href="/assets/app/css/home.css">
@endpush

@section('bodyClass', 'home-page has-page-header ' . (Auth::check() ? 'has-user' : ''))

@section('pageTitle', 'Home' )

<x-app-layout>
    <x-app.header></x-app.header>

    <main id="site-body">
        <div class="page">
        </div>
    </main>

    <x-app.footer></x-app.footer>   
</x-app-layout>
    