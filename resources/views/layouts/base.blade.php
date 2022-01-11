<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ env('APP_NAME') }} - @yield('pageTitle')</title>

        <link rel="shortcut icon" href="/favicon.png" type="image/png">

        @stack('vendorScripts')
        
        @stack('headerScripts')

        <script src="/js/utils.js"></script>
        
    </head>
    <body class="@yield('bodyClass')">
        
        {{ $slot }}

        @stack('footerScripts')

        <x-modal-confirm-delete></x-modal-confirm-delete>

        <script src="/js/initialize.js"></script>
        
    </body>
</html>
