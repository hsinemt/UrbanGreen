@extends('layouts.app')

@section('title', 'Climate Change')

@section('content')
  <!-- Start Hero Section (from template/climate-change.html) -->
  <section class="cs_hero cs_style_1 cs_type_1 cs_heading_bg cs_center" data-src="{{ asset('assets/img/climate-change/hero_bg.jpg') }}">
    <div class="youtube-bg">
      <div id="bgndVideo" class="player" data-property="{videoURL:'https://www.youtube.com/embed/0_jNjpVxUt0?list=PLDTG-mhC5UzPo-QFAg7dXbJUVtRCjUN6J', containment:'.youtube-bg',autoPlay:true, mute:true, startAt:1, opacity:1, showControls:false, loop:true}"></div>
    </div>
    <div class="container">
      <div class="cs_hero_text wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.25s">
        <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_30">Climate Action Now: Uniting for a Sustainable Future</h1>
        <p class="cs_hero_subtitle cs_white_color cs_mb_37">Welcome to Ecozone, your hub for climate change awareness and action. Together, we strive to address the urgent challenges posed by climate change and create a sustainable future for our planet.</p>
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
    <div class="cs_rotate_text_box cs_bg_filed cs_center" data-src="{{ asset('assets/img/climate-change/hero_rotate_text_bg.svg') }}">
      <img src="{{ asset('assets/img/climate-change/hero_rotate_text.svg') }}" alt="">
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Feature Section (from template/climate-change.html) -->
  <section>
    <div class="cs_height_150 cs_height_lg_80"></div>
    <div class="container">
      <div class="row cs_row_gap_50 cs_gap_y_50">
        <div class="col-lg-4">
          <div class="cs_iconbox cs_style_1">
            <div class="cs_iconbox_icon cs_mb_26 cs_mb_lg_20"><img src="{{ asset('assets/img/nature/climate_change_icon.svg') }}" alt=""></div>
            <h2 class="cs_fs_38 cs_semibold cs_mb_22 cs_mb_lg_15">Climate Change</h2>
            <p class="mb-0">Discuss the science, impacts, and solutions related to climate change, including global warming, extreme weather events, and the transition to renewable energy sources.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="cs_iconbox cs_style_1">
            <div class="cs_iconbox_icon cs_mb_26 cs_mb_lg_20"><img src="{{ asset('assets/img/nature/sustainable_living.png') }}" alt=""></div>
            <h2 class="cs_fs_38 cs_semibold cs_mb_22 cs_mb_lg_15">Sustainable Living</h2>
            <p class="mb-0">Provide tips and information on sustainable practices in areas such as energy conservation, waste reduction, and eco-friendly lifestyle choices.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="cs_iconbox cs_style_1">
            <div class="cs_iconbox_icon cs_mb_26 cs_mb_lg_20"><img src="{{ asset('assets/img/nature/deforestation.svg') }}" alt=""></div>
            <h2 class="cs_fs_38 cs_semibold cs_mb_22 cs_mb_lg_15">Deforestation</h2>
            <p class="mb-0">Discuss the impact of deforestation on ecosystems, climate, and biodiversity, as well as reforestation and afforestation efforts.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="cs_height_140 cs_height_lg_70"></div>
  </section>
  <!-- End Feature Section -->

  <!-- Start About Section (from template/climate-change.html) -->
  <section>
    <div class="container">
      <div class="row align-items-center cs_gap_y_50">
        <div class="col-lg-6">
          <div class="cs_layer_img_box cs_type_2">
            <div class="cs_layer_img_1">
              <img src="{{ asset('assets/img/climate-change/about_img_1.jpg') }}" alt="" class="cs_shadow_1">
            </div>
            <div class="cs_layer_img_2">
              <img src="{{ asset('assets/img/climate-change/about_img_2.jpg') }}" alt="">
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="cs_pl_75 wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.25s">
            <h3 class="cs_accent_color cs_fs_21 cs_semibold cs_mb_13">About Us</h3>
            <h2 class="cs_fs_51 cs_mb_29">Creating a Lasting Alliance for a Greener Future</h2>
            <p class="cs_mb_37">We are passionate advocates for environmental awareness and moral sustainability. Our mission is to empower individuals and community to make positive changes for our planet. We believe that small actions can lead to big transformations, and we're dedicated to providing the knowledge, resources, and inspiration needed.</p>
            <ul class="cs_list cs_style_1 cs_mp_0">
              <li>
                <i class="cs_list_icon cs_accent_color">
                  <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 9.62275C0.0320847 8.83012 0.390363 8.2499 1.11227 7.93388C1.84487 7.61269 2.54004 7.73702 3.1443 8.25508C4.06406 9.0477 4.96777 9.85587 5.87684 10.6589C6.04796 10.8091 6.21908 10.9645 6.39554 11.1148C6.65757 11.3427 6.88751 11.3323 7.12279 11.0733C9.096 8.91819 11.0639 6.75789 13.0371 4.5976C14.3686 3.13668 15.7054 1.68094 17.037 0.220014C17.2027 0.0386945 17.3952 -0.0493752 17.6412 0.0283334C17.8498 0.0956808 18.0102 0.277001 17.9995 0.494585C17.9941 0.608557 17.946 0.732891 17.8819 0.831322C16.3685 3.19884 14.8552 5.56118 13.3419 7.92352C11.5986 10.6433 9.85534 13.3631 8.11207 16.0881C7.80727 16.5647 7.39551 16.8859 6.81264 16.974C6.15491 17.0776 5.60947 16.8704 5.19237 16.3782C3.69508 14.6116 2.20849 12.8399 0.716557 11.0681C0.433143 10.7469 0.133686 10.4257 0.0534744 9.98539C0.0267372 9.85587 0.0160423 9.73154 0 9.62275Z" fill="currentColor"/>
                  </svg>
                </i>
                <h3 class="cs_fs_28 cs_semibold cs_mb_15">Our Mission</h3>
                <p class="mb-0">Explain the core purpose of your website, which may be to raise awareness, educate, or inspire positive environmental change.</p>
              </li>
              <li>
                <i class="cs_list_icon cs_accent_color">
                  <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 9.62275C0.0320847 8.83012 0.390363 8.2499 1.11227 7.93388C1.84487 7.61269 2.54004 7.73702 3.1443 8.25508C4.06406 9.0477 4.96777 9.85587 5.87684 10.6589C6.04796 10.8091 6.21908 10.9645 6.39554 11.1148C6.65757 11.3427 6.88751 11.3323 7.12279 11.0733C9.096 8.91819 11.0639 6.75789 13.0371 4.5976C14.3686 3.13668 15.7054 1.68094 17.037 0.220014C17.2027 0.0386945 17.3952 -0.0493752 17.6412 0.0283334C17.8498 0.0956808 18.0102 0.277001 17.9995 0.494585C17.9941 0.608557 17.946 0.732891 17.8819 0.831322C16.3685 3.19884 14.8552 5.56118 13.3419 7.92352C11.5986 10.6433 9.85534 13.3631 8.11207 16.0881C7.80727 16.5647 7.39551 16.8859 6.81264 16.974C6.15491 17.0776 5.60947 16.8704 5.19237 16.3782C3.69508 14.6116 2.20849 12.8399 0.716557 11.0681C0.433143 10.7469 0.133686 10.4257 0.0534744 9.98539C0.0267372 9.85587 0.0160423 9.73154 0 9.62275Z" fill="currentColor"/>
                  </svg>
                </i>
                <h3 class="cs_fs_28 cs_semibold cs_mb_15">Our Values</h3>
                <p class="mb-0">Outline the principles and values that guide your work, such as sustainability, scientific accuracy, inclusivity, and the promotion of positive action.</p>
              </li>
            </ul>
            <div class="cs_height_45 cs_height_lg_30"></div>
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
  </section>
  <!-- End About Section -->
@endsection
