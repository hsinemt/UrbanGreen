<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
    <title>@yield('title', 'Ecozone')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/light-gallerr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>
<body>
    <!-- Preloader (optional keep as-is) -->
    <div class="cs_preloader">
        <div class="cs_preloader_in">
            <span></span>
            <span></span>
        </div>
        <div class="cs_preloader_shape"><img src="{{ asset('img/nature/about_shape_1.svg') }}" alt=""></div>
        <div class="cs_preloader_shape_2"><img src="{{ asset('img/nature/about_shape_2.svg') }}" alt=""></div>
    </div>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slick.min.js') }}"></script>
    <script src="{{ asset('js/odometer.js') }}"></script>
    <script src="{{ asset('js/YTPlayer.min.js') }}"></script>
    <script src="{{ asset('js/light-gallery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/ripples.min.js') }}"></script>
    <script src="{{ asset('js/gsap.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    @stack('scripts')
</body>
</html>
