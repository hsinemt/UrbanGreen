<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - UrbanGreen')</title>
    <link rel="icon" type="image/png" href="{{ asset('backOffice-assets/images/favicon.png') }}" sizes="16x16">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('backOffice-assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backOffice-assets/css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backOffice-assets/css/lib/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('backOffice-assets/css/lib/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backOffice-assets/css/lib/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backOffice-assets/css/lib/full-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('backOffice-assets/css/lib/jquery-jvectormap-2.0.5.css') }}">
    <link rel="stylesheet" href="{{ asset('backOffice-assets/css/lib/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('backOffice-assets/css/lib/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('backOffice-assets/css/style.css') }}">

    @stack('styles')
</head>
<body>
<!-- Theme Customization -->
@include('dashboard.partials.theme-customization')

<!-- Sidebar -->
@include('dashboard.partials.sidebar')

<main class="dashboard-main">
    <!-- Header -->
    @include('dashboard.partials.header')

    <!-- Main Content -->
    <div class="dashboard-main-body">
        @yield('breadcrumb')

        @yield('content')
    </div>

    <!-- Footer -->
    @include('dashboard.partials.footer')
</main>

<!-- JavaScript Files -->
<script src="{{ asset('backOffice-assets/js/lib/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('backOffice-assets/js/lib/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backOffice-assets/js/lib/apexcharts.min.js') }}"></script>
<script src="{{ asset('backOffice-assets/js/lib/dataTables.min.js') }}"></script>
<script src="{{ asset('backOffice-assets/js/lib/iconify-icon.min.js') }}"></script>
<script src="{{ asset('backOffice-assets/js/lib/jquery-ui.min.js') }}"></script>
<script src="{{ asset('backOffice-assets/js/lib/jquery-jvectormap-2.0.5.min.js') }}"></script>
<script src="{{ asset('backOffice-assets/js/lib/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('backOffice-assets/js/lib/magnifc-popup.min.js') }}"></script>
<script src="{{ asset('backOffice-assets/js/lib/slick.min.js') }}"></script>
<script src="{{ asset('backOffice-assets/js/app.js') }}"></script>

@stack('scripts')
</body>
</html>
