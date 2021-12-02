<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }} - @yield('header.title')</title>

        @yield('header.meta')
    </head>
    <body class="@yield('body.class')">
        @yield('body.content')
        @yield('body.scripts')
    </body>
</html>
