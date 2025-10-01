@extends('frontOffice.layouts.app')
@section('title', 'Recycling')

@section('content')
  <!-- Start Hero Slider Section (from template/recycling.html) -->
  <section class="cs_slider cs_style_1">
    <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="1000" data-center="0" data-variable-width="0" data-slides-per-view="1">
      <div class="cs_slider_wrapper">
        <div class="cs_slide">
          <div class="cs_hero cs_style_3 text-center cs_heading_bg cs_center">
            <div class="cs_hero_bg cs_bg_filed" data-src="{{ asset('assets/img/recycling/hero_bg_1.jpg') }}"></div>
            <div class="container">
              <div class="cs_hero_text">
                <h3 class="cs_hero_title_up cs_fs_21 cs_accent_color cs_semibold cs_mb_19"><span>Recycling For Future</span></h3>
                <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_30">Recycle for a Better Tomorrow, Join the Green Revolution</h1>
                <p class="cs_hero_subtitle cs_white_color cs_mb_37">Welcome to our recycling hub, where every action counts towards a sustainable future. Join us in the journey to reduce, reuse, and recycle for a greener planet.</p>
                <div class="cs_hero_btns">
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
                  <a href="{{ route('contact') }}" class="cs_btn cs_style_1 cs_color_1">
                    Contact Us
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
        <div class="cs_slide">
          <div class="cs_hero cs_style_3 text-center cs_heading_bg cs_center">
            <div class="cs_hero_bg cs_bg_filed" data-src="{{ asset('assets/img/recycling/hero_bg_2.jpg') }}"></div>
            <div class="container">
              <div class="cs_hero_text">
                <h3 class="cs_hero_title_up cs_fs_21 cs_accent_color cs_semibold cs_mb_19"><span>Recycling for Tomorrow</span></h3>
                <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_30">Embrace Sustainability Today, Be Part of the Eco-Friendly Future</h1>
                <p class="cs_hero_subtitle cs_white_color cs_mb_37">Welcome to our eco-center, where each step brings us closer to a sustainable world. Let's work together to reduce, reuse, and recycle for a healthier Earth.</p>
                <div class="cs_hero_btns">
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
                  <a href="{{ route('contact') }}" class="cs_btn cs_style_1 cs_color_1">
                    Contact Us
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
        <div class="cs_slide">
          <div class="cs_hero cs_style_3 text-center cs_heading_bg cs_center">
            <div class="cs_hero_bg cs_bg_filed" data-src="{{ asset('assets/img/recycling/hero_bg_3.jpg') }}"></div>
            <div class="container">
              <div class="cs_hero_text">
                <h3 class="cs_hero_title_up cs_fs_21 cs_accent_color cs_semibold cs_mb_19"><span>Preserving Future Recycling</span></h3>
                <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_30">Go Green for a Brighter Future, Together We Can Make a Difference</h1>
                <p class="cs_hero_subtitle cs_white_color cs_mb_37">Step into our green hub, where every effort contributes to a sustainable tomorrow. Join us in the mission to reduce, reuse, and recycle for a cleaner planet.</p>
                <div class="cs_hero_btns">
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
                  <a href="{{ route('contact') }}" class="cs_btn cs_style_1 cs_color_1">
                    Contact Us
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
    </div>
  </section>
  <!-- End Hero Slider Section -->
@endsection
