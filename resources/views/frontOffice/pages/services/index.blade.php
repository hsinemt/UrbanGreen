@extends('layouts.app')

@section('title', 'Services')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Services</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Services</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Services Section -->
  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <div class="row cs_gap_y_50">
      <div class="col-xl-4 col-md-6">
        <div class="cs_iconbox cs_style_3 cs_shadow_1 cs_white_bg text-center">
          <div class="cs_iconbox_icon cs_mb_28"><img src="{{ asset('assets/img/nature/service_icon_1.svg') }}" alt=""></div>
          <h2 class="cs_fs_28 cs_semibold cs_mb_25">Eco-Friendly Product</h2>
          <p class="cs_mb_20">Share reviews and recommendations for eco friendly products, from energy-efficient appliances to sustainable clothing.</p>
          <a href="{{ route('services.show', ['slug' => 'service-details']) }}" class="cs_btn cs_style_2 cs_heading_color">
            Learn More
            <i>
              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </i>
          </a>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div class="cs_iconbox cs_style_3 cs_shadow_1 cs_white_bg text-center">
          <div class="cs_iconbox_icon cs_mb_28"><img src="{{ asset('assets/img/nature/service_icon_2.svg') }}" alt=""></div>
          <h2 class="cs_fs_28 cs_semibold cs_mb_25">Advocacy and Campaigns</h2>
          <p class="cs_mb_20">Organize and promote environmental campaigns and advocacy efforts, encouraging visitors to take action on important issues.</p>
          <a href="{{ route('services.show', ['slug' => 'service-details']) }}" class="cs_btn cs_style_2 cs_heading_color">
            Learn More
            <i>
              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </i>
          </a>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div class="cs_iconbox cs_style_3 cs_shadow_1 cs_white_bg text-center">
          <div class="cs_iconbox_icon cs_mb_28"><img src="{{ asset('assets/img/nature/service_icon_3.svg') }}" alt=""></div>
          <h2 class="cs_fs_28 cs_semibold cs_mb_25">Sustainable Gardening</h2>
          <p class="cs_mb_20">Offer guidance on sustainable gardening practices, including organic gardening, and water conservation in gardens.</p>
          <a href="{{ route('services.show', ['slug' => 'service-details']) }}" class="cs_btn cs_style_2 cs_heading_color">
            Learn More
            <i>
              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </i>
          </a>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div class="cs_iconbox cs_style_3 cs_shadow_1 cs_white_bg text-center">
          <div class="cs_iconbox_icon cs_mb_28"><img src="{{ asset('assets/img/nature/service_icon_4.svg') }}" alt=""></div>
          <h2 class="cs_fs_28 cs_semibold cs_mb_25">Wildlife Saving</h2>
          <p class="cs_mb_20">Promote and support wildlife conservation programs and encourage donations or volunteer participation.</p>
          <a href="{{ route('services.show', ['slug' => 'service-details']) }}" class="cs_btn cs_style_2 cs_heading_color">
            Learn More
            <i>
              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </i>
          </a>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div class="cs_iconbox cs_style_3 cs_shadow_1 cs_white_bg text-center">
          <div class="cs_iconbox_icon cs_mb_28"><img src="{{ asset('assets/img/nature/service_icon_5.svg') }}" alt=""></div>
          <h2 class="cs_fs_28 cs_semibold cs_mb_25">Wildlife Saving</h2>
          <p class="cs_mb_20">Promote and support wildlife conservation programs and encourage donations or volunteer participation.</p>
          <a href="{{ route('services.show', ['slug' => 'service-details']) }}" class="cs_btn cs_style_2 cs_heading_color">
            Learn More
            <i>
              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </i>
          </a>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div class="cs_iconbox cs_style_3 cs_shadow_1 cs_white_bg text-center">
          <div class="cs_iconbox_icon cs_mb_28"><img src="{{ asset('assets/img/nature/service_icon_6.svg') }}" alt=""></div>
          <h2 class="cs_fs_28 cs_semibold cs_mb_25">Environmental Literature</h2>
          <p class="cs_mb_20">Share reviews and recommendations for eco friendly products, from energy-efficient appliances to sustainable clothing.</p>
          <a href="{{ route('services.show', ['slug' => 'service-details']) }}" class="cs_btn cs_style_2 cs_heading_color">
            Learn More
            <i>
              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
  <!-- End Services Section -->
@endsection
