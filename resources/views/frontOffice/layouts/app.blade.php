<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('frontOffice/img/favicon.png') }}">
    <title>@yield('title', 'Ecozone')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('frontOffice/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/light-gallerr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/loginstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/auth-styles.css') }}">

    @stack('styles')
</head>
<body>
<!-- Preloader (optional keep as-is) -->
<div class="cs_preloader">
    <div class="cs_preloader_in">
        <span></span>
        <span></span>
    </div>
    <div class="cs_preloader_shape"><img src="{{ asset('frontOffice/img/nature/about_shape_1.svg') }}" alt=""></div>
    <div class="cs_preloader_shape_2"><img src="{{ asset('frontOffice/img/nature/about_shape_2.svg') }}" alt=""></div>
</div>

@include('frontOffice.partials.header')

<main>
    @yield('content')
</main>

@include('frontOffice.partials.footer')

<!-- Scripts -->
<script src="{{ asset('frontOffice/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/jquery.slick.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/odometer.js') }}"></script>
<script src="{{ asset('frontOffice/js/YTPlayer.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/light-gallery.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/ripples.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/gsap.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/wow.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/main.js') }}"></script>

@stack('scripts')
</body>
</html>
