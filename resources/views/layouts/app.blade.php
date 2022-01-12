<x-base-layout>

    @prepend('vendorScripts')
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200;0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">

        <link rel="stylesheet" href="/assets/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/vendor/glider.min.css">

        <script type="text/javascript" src="/assets/vendor/glider.min.js"></script>
        <script type="text/javascript" src="/assets/vendor/jquery.min.js"></script>
        <script type="text/javascript" src="/assets/vendor/slick.min.js"></script>
        
    @endprepend 

    @prepend('headerScripts')
        <link rel="stylesheet" href="/assets/app/css/reset.css">
        <link rel="stylesheet" href="/assets/app/css/general.css">
        <link rel="stylesheet" href="/assets/app/css/page.css">
        <link rel="stylesheet" href="/assets/app/css/m-slider.css">
        <link rel="stylesheet" href="/assets/app/css/m-collection.css">
        <script src="/assets/vendor/popper.min.js"></script>
    @endprepend

    @push('footerScripts')
        <script src="/assets/vendor/bootstrap.min.js"></script>
        <script src="/assets/app/js/m-slider.js"></script>
    @endpush

    {{ $slot }}

    @if (Auth::user()->isAdmin())
        @include('app.floating-menu')
    @endif

</x-base-layout>