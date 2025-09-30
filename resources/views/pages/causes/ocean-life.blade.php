@extends('layouts.app')

@section('title', 'Ocean Life')

@section('content')
  <!-- Start Hero Section (from template/ocean-life.html) -->
  <section class="cs_hero cs_style_5 cs_heading_bg cs_center cs_bg_fixed" data-src="{{ asset('assets/img/ocean-life/hero_bg.jpg') }}">
    <div class="container wow fadeInRight" data-wow-duration="0.9s" data-wow-delay="0.25s">
      <div class="cs_slider cs_style_1 cs_slider_gap_24">
        <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="600" data-center="0" data-variable-width="0" data-slides-per-view="1">
          <div class="cs_slider_wrapper">
            <div class="cs_slide">
              <div class="cs_hero_text">
                <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_30">Advocating for Marine Life Conservation</h1>
                <p class="cs_hero_subtitle cs_white_color cs_mb_37">Dive into the mission of marine conservation with us. As 'Guardians of the Sea,' we are dedicated to protecting and preserving marine life.</p>
                <a href="{{ route('about') }}" class="cs_btn cs_style_1">
                  Our Mission
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
            <div class="cs_slide">
              <div class="cs_hero_text">
                <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_30">Taking Small Strides to Preserve Our Planet</h1>
                <p class="cs_hero_subtitle cs_white_color cs_mb_37">Ecology, as a field of science, investigates the interconnections between living organisms and their surroundings, encompassing both the physical and chemical aspects.</p>
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
        <div class="cs_pagination cs_style_2 cs_type_2"></div>
      </div>
    </div>
    <div class="cs_hero_video_block cs_bg_filed youtube-bg" data-src="{{ asset('assets/img/ocean-life/hero_video_bg.jpg') }}">
      <div id="bgndVideo" class="player" data-property="{videoURL:'https://www.youtube.com/embed/Q2zZ2S5esu8', containment:'.youtube-bg',autoPlay:true, mute:true, startAt:1, opacity:1, showControls:false, loop:true}"></div>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Main Feature Section (subset from template/ocean-life.html) -->
  <section>
    <div class="cs_height_145 cs_height_lg_75"></div>
    <div class="container">
      <div class="cs_section_heading cs_style_1 text-center">
        <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">What We Do</h3>
        <h2 class="cs_fs_51 cs_mb_9 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.25s">Time to Go Back Our Root Farming</h2>
        <p class="mb-0 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">Discover a range of services aimed at promoting environmental <br>awareness, sustainability, and positive action.</p>
      </div>
      <div class="cs_height_90 cs_height_lg_50"></div>
      <div class="row cs_gap_y_30">
        <div class="col-lg-4">
          <div class="cs_iconbox cs_style_3 cs_accent_bg text-center">
            <div class="cs_iconbox_icon cs_mb_26"><img src="{{ asset('assets/img/ocean-life/feature_icon_1.svg') }}" alt=""></div>
            <h3 class="cs_fs_38 cs_semibold">Climate Change</h3>
            <p class="cs_white_color cs_mb_21">Address the impacts of climate change on oceans by supporting initiatives aimed at reducing greenhouse gas emissions and promoting marine ecosystems.</p>
            <a href="{{ route('services.show', ['slug' => 'service-details']) }}" class="cs_btn cs_style_2 cs_heading_color">
              Learn More
              <i>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </i>
            </a>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="cs_iconbox cs_style_3 cs_accent_bg text-center">
            <div class="cs_iconbox_icon cs_mb_26"><img src="{{ asset('assets/img/ocean-life/feature_icon_2.svg') }}" alt=""></div>
            <h3 class="cs_fs_38 cs_semibold">Sustainable Fishing</h3>
            <p class="cs_white_color cs_mb_21">Promote and support sustainable fishing practices to prevent overfishing and preserve the balance of marine ecosystems.</p>
            <a href="{{ route('services.show', ['slug' => 'service-details']) }}" class="cs_btn cs_style_2 cs_heading_color">
              Learn More
              <i>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Main Feature Section -->
@endsection
