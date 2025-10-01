@extends('frontOffice.layouts.app')
@section('title', 'Agriculture')

@section('content')
  <!-- Start Hero Slider Section (simplified from template/agriculture.html) -->
  <section class="cs_slider cs_style_1 cs_heading_bg">
    <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="900" data-center="0" data-variable-width="0" data-fade-slide="1" data-slides-per-view="1">
      <div class="cs_slider_wrapper">
        <div class="cs_slide">
          <div class="cs_hero cs_style_4 cs_heading_bg cs_center">
            <div class="cs_hero_bg cs_bg_filed" data-src="{{ asset('assets/img/agriculture/hero_bg_1.jpg') }}"></div>
            <div class="container">
              <div class="cs_hero_text">
                <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_60 cs_mb_lg_40">Forging a Improved Food System, Hand in Hand</h1>
                <a href="{{ route('about') }}" class="cs_btn cs_style_1">
                  Learn More
                  <i>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="cs_slide">
          <div class="cs_hero cs_style_4 cs_heading_bg cs_center">
            <div class="cs_hero_bg cs_bg_filed" data-src="{{ asset('assets/img/agriculture/hero_bg_2.jpg') }}"></div>
            <div class="container">
              <div class="cs_hero_text">
                <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_60 cs_mb_lg_40">Let's Building a Better Food System, Together.</h1>
                <a href="{{ route('about') }}" class="cs_btn cs_style_1">
                  Learn More
                  <i>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="cs_slide">
          <div class="cs_hero cs_style_4 cs_heading_bg cs_center">
            <div class="cs_hero_bg cs_bg_filed" data-src="{{ asset('assets/img/agriculture/hero_bg_3.jpg') }}"></div>
            <div class="container">
              <div class="cs_hero_text">
                <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_60 cs_mb_lg_40">Creating a Stronger Food Network, Side by Side.</h1>
                <a href="{{ route('about') }}" class="cs_btn cs_style_1">
                  Learn More
                  <i>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cs_pagination cs_style_2 cs_type_1"></div>
  </section>
  <div class="container">
    <div class="cs_hero_4_iconbox cs_shadow_1 cs_white_bg">
      <div class="cs_iconbox cs_style_2">
        <div class="cs_iconbox_icon"><img src="{{ asset('assets/img/agriculture/support_local_farmers.svg') }}" alt=""></div>
        <h3 class="cs_iconbox_title mb-0 cs_fs_28 cs_semibold">Support Local Farmers</h3>
      </div>
      <div class="cs_iconbox cs_style_2">
        <div class="cs_iconbox_icon"><img src="{{ asset('assets/img/agriculture/provide_organic_farming.svg') }}" alt=""></div>
        <h3 class="cs_iconbox_title mb-0 cs_fs_28 cs_semibold">Produce Organic Farming</h3>
      </div>
      <div class="cs_iconbox cs_style_2">
        <div class="cs_iconbox_icon"><img src="{{ asset('assets/img/agriculture/stop_chemicals_pesticide.svg') }}" alt=""></div>
        <h3 class="cs_iconbox_title mb-0 cs_fs_28 cs_semibold">Stop Chemicals Pesticide </h3>
      </div>
    </div>
  </div>
  <!-- End Hero Section -->

  <!-- Start About Section -->
  <section class="cs_shape_wrap">
    <div class="cs_height_140 cs_height_lg_70"></div>
    <div class="cs_shape cs_shape_position_7"><img src="{{ asset('assets/img/nature/about_shape_2.svg') }}" alt=""></div>
    <div class="container">
      <div class="row align-items-center cs_gap_y_50">
        <div class="col-lg-6">
          <div class="cs_pr_75">
            <h3 class="cs_accent_color cs_fs_21 cs_semibold cs_mb_13">About Us</h3>
            <h2 class="cs_fs_51 cs_mb_29">Creating a Lasting Alliance for a Greener Future</h2>
            <p class="cs_mb_30">We are passionate advocates for environmental awareness and moral sustainability. Our mission is to empower individuals and community to make positive changes for our planet. We believe that small actions can lead to big transformations, and we're dedicated to providing the knowledge, resources, and inspiration needed.</p>
            <div class="cs_funfact_2_list">
              <div class="cs_funfact cs_style_2">
                <p class="cs_funfact_number cs_fs_70 mb-0 cs_bold">
                  <span class="odometer" data-count-to="500"></span>
                </p>
                <p class="cs_funfact_title mb-0 cs_fs_18">Local Volunteers</p>
              </div>
              <div class="cs_funfact cs_style_2">
                <p class="cs_funfact_number cs_fs_70 mb-0 cs_bold">
                  <span class="odometer" data-count-to="110"></span>M
                </p>
                <p class="cs_funfact_title mb-0 cs_fs_18">Total Fund Raised</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <img src="{{ asset('assets/img/agriculture/about_img.jpg') }}" alt="" class="w-100">
        </div>
      </div>
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End About Section -->
@endsection
