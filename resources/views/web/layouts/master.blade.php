<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-web-page.css') }}">

    @yield('addCss')
</head>

<body>
    {{-- Header & Navbar --}}
    {{-- Header & Navbar hanya ditampilkan jika `showNavbar` bernilai true --}}
    @if (!isset($showNavbar) || $showNavbar)
        @include('web.layouts.navbar')
    @endif

    <main>
        {{-- Content --}}
        @yield('content')
    </main>

    {{-- Footer --}}
    {{-- Footer hanya ditampilkan jika `showFooter` bernilai true --}}
    @if (!isset($showFooter) || $showFooter)
        @include('web.layouts.footer')
    @endif

    <!-- Tombol panah ke atas -->
    <button id="scrollToTopBtn" class="btn btn-primary">
        <i class="fas fa-arrow-up"></i>
    </button>

    @include('sweetalert::alert')

    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/FontAwesome.js') }}"></script>
    <script src="{{ asset('js/script-web-page.js') }}"></script>

    @yield('addJs')
</body>

</html>
