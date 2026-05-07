<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name', 'Cacorrafiofobia'))</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="font" href="{{ asset('font/DragonSlayer.otf') }}">
    </head>
    <body class="bg-light-subtle text-dark d-flex flex-column min-vh-100">
        @include('layouts.navbar')

        <main class="flex-fill">
            @yield('content')
        </main>

        @include('layouts.footer')
    </body>
</html>
