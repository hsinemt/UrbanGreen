@extends('dashboard.layouts.dashboard')

@section('title', 'Dashboard - UrbanGreen')

@section('breadcrumb')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Dashboard</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('back.home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Home</li>
        </ul>
    </div>
@endsection

{{--@section('content')--}}
{{--    <div class="row gy-4">--}}
{{--        <div class="col-xxl-8">--}}
{{--            <div class="row gy-4">--}}
{{--                <!-- Statistics Cards -->--}}
{{--                @include('dashboard.components.stats-cards')--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Revenue Growth Chart -->--}}
{{--        <div class="col-xxl-4">--}}
{{--            @include('dashboard.components.revenue-growth')--}}
{{--        </div>--}}

{{--        <!-- Earning Statistics -->--}}
{{--        <div class="col-xxl-8">--}}
{{--            @include('dashboard.components.earning-stats')--}}
{{--        </div>--}}

{{--        <!-- Campaign & Customer Overview -->--}}
{{--        <div class="col-xxl-4">--}}
{{--            <div class="row gy-4">--}}
{{--                <div class="col-xxl-12 col-sm-6">--}}
{{--                    @include('dashboard.components.campaigns')--}}
{{--                </div>--}}
{{--                <div class="col-xxl-12 col-sm-6">--}}
{{--                    @include('dashboard.components.customer-overview')--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Client Payment Status -->--}}
{{--        <div class="col-xxl-4 col-sm-6">--}}
{{--            @include('dashboard.components.payment-status')--}}
{{--        </div>--}}

{{--        <!-- Countries Status -->--}}
{{--        <div class="col-xxl-4 col-sm-6">--}}
{{--            @include('dashboard.components.countries-status')--}}
{{--        </div>--}}

{{--        <!-- Top Performers -->--}}
{{--        <div class="col-xxl-4">--}}
{{--            @include('dashboard.components.top-performers')--}}
{{--        </div>--}}

{{--        <!-- Latest Tasks -->--}}
{{--        <div class="col-xxl-6">--}}
{{--            @include('dashboard.components.latest-tasks')--}}
{{--        </div>--}}

{{--        <!-- Last Transactions -->--}}
{{--        <div class="col-xxl-6">--}}
{{--            @include('dashboard.components.last-transactions')--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

@push('scripts')
    <script src="{{ asset('assets/js/homeTwoChart.js') }}"></script>
@endpush
