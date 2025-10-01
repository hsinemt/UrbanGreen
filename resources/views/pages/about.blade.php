@extends('layouts.app')

@section('title', 'About')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">About Us</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">About</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start About Section -->
  <section class="cs_shape_wrap">
    <div class="cs_height_140 cs_height_lg_70"></div>
    <div class="cs_shape cs_shape_position_1"><img src="{{ asset('img/nature/about_shape_1.svg') }}" alt=""></div>
    <div class="container">
      <div class="row align-items-center cs_gap_y_50">
        <div class="col-lg-6">
          <a href="https://www.youtube.com/embed/rRid6GCJtgc" class="cs_video_block cs_style_1 cs_bg_filed cs_video_open cs_center" data-src="{{ asset('img/nature/video_block_bg.jpg') }}">
            <span class="cs_player_btn cs_white_color">
              <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M35 0C15.7004 0 0 15.7004 0 35C0 54.2996 15.7004 70 35 70C54.2996 70 70 54.2996 70 35C70 15.7004 54.2996 0 35 0ZM35 64.1667C18.9175 64.1667 5.83333 51.0825 5.83333 35C5.83333 18.9175 18.9175 5.83333 35 5.83333C51.0825 5.83333 64.1667 18.9175 64.1667 35C64.1667 51.0825 51.0825 64.1667 35 64.1667ZM23.3333 51.4704L52.6167 35L23.3333 18.5296V51.4733V51.4704ZM29.1667 28.5017L40.7167 35L29.1667 41.4983V28.5017Z" fill="currentColor"/>
              </svg>
            </span>
          </a>
        </div>
        <div class="col-lg-6">
          <div class="cs_pl_75">
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
                  <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End About Section -->

  <!-- Start Feature Section -->
  <section class="cs_gray_bg_2">
    <div class="cs_height_145 cs_height_lg_75"></div>
    <div class="container">
      <div class="cs_section_heading cs_style_1 text-center">
        <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13">What We Do</h3>
        <h2 class="cs_fs_51 mb-0">Our Initiatives and Impact</h2>
      </div>
      <div class="cs_height_90 cs_height_lg_50"></div>
    </div>
    <div class="container">
      <div class="row cs_gap_y_40">
        <div class="col-xl-3 col-md-6">
          <div class="cs_iconbox cs_style_6 cs_shadow_1 text-center cs_white_bg">
            <div class="cs_iconbox_icon cs_accent_bg cs_mb_30 cs_center">
              <img src="{{ asset('img/others/feature_icon_1.svg') }}" alt="">
            </div>
            <h3 class="cs_iconbox_title cs_fs_28 cs_semibold cs_mb_24">Environmental Education</h3>
            <p class="mb-0">We provide educational resources, articles, and guides on various environmental topics to raise awareness and empower individuals to make informed choices.</p>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="cs_iconbox cs_style_6 cs_shadow_1 text-center cs_white_bg">
            <div class="cs_iconbox_icon cs_accent_bg cs_mb_30 cs_center">
              <img src="{{ asset('img/others/feature_icon_2.svg') }}" alt="">
            </div>
            <h3 class="cs_iconbox_title cs_fs_28 cs_semibold cs_mb_24">Advocacy and <br>Action</h3>
            <p class="mb-0">We lead and support environmental advocacy campaigns and initiatives aimed at addressing pressing issues and inspiring positive change.</p>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="cs_iconbox cs_style_6 cs_shadow_1 text-center cs_white_bg">
            <div class="cs_iconbox_icon cs_accent_bg cs_mb_30 cs_center">
              <img src="{{ asset('img/others/feature_icon_3.svg') }}" alt="">
            </div>
            <h3 class="cs_iconbox_title cs_fs_28 cs_semibold cs_mb_24">Community <br>Building</h3>
            <p class="mb-0">We foster a community of environmentally conscious individuals, encouraging engagement, collaboration, and the sharing of ideas and initiatives.</p>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="cs_iconbox cs_style_6 cs_shadow_1 text-center cs_white_bg">
            <div class="cs_iconbox_icon cs_accent_bg cs_mb_30 cs_center">
              <img src="{{ asset('img/others/feature_icon_4.svg') }}" alt="">
            </div>
            <h3 class="cs_iconbox_title cs_fs_28 cs_semibold cs_mb_24">Promoting Sustainability</h3>
            <p class="mb-0">We promote sustainable living practices, eco-friendly products, and actionable tips to help individuals and communities reduce their environmental footprint.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End Feature Section -->

  <!-- Start Funfact -->
  <div class="cs_height_132 cs_height_lg_70"></div>
  <div class="container">
    <div class="cs_funfact_1_list">
      <div class="cs_funfact cs_style_1">
        <h2 class="cs_funfact_number cs_fs_70 mb-0">
          <span class="odometer" data-count-to="5"></span>K
        </h2>
        <p class="cs_funfact_title mb-0">Local <br>Volunteers</p>
      </div>
      <div class="cs_funfact cs_style_1">
        <h2 class="cs_funfact_number cs_fs_70 mb-0">
          <span class="odometer" data-count-to="110"></span>M
        </h2>
        <p class="cs_funfact_title mb-0">World Fund <br>Raised</p>
      </div>
      <div class="cs_funfact cs_style_1">
        <h2 class="cs_funfact_number cs_fs_70 mb-0">
          <span class="odometer" data-count-to="200"></span>+
        </h2>
        <p class="cs_funfact_title mb-0">Project <br>Completed</p>
      </div>
      <div class="cs_funfact cs_style_1">
        <h2 class="cs_funfact_number cs_fs_70 mb-0">
          <span class="odometer" data-count-to="2"></span>K
        </h2>
        <p class="cs_funfact_title mb-0">World Wide <br>Members</p>
      </div>
    </div>
  </div>
  <div class="cs_height_125 cs_height_lg_60"></div>
  <!-- End Funfact -->

  <!-- Start About Section 2 -->
  <section>
    <div class="container">
      <div class="row cs_gap_y_50 cs_col_reverse_lg">
        <div class="col-lg-6 d-flex align-items-center">
          <div class="cs_pr_75">
            <div class="cs_height_66 cs_height_lg_0"></div>
            <h3 class="cs_accent_color cs_fs_21 cs_semibold cs_mb_13">Lets Save Planet Together</h3>
            <h2 class="cs_fs_51 cs_mb_29">Quenching Thirst, Saving Lives with Support</h2>
            <p class="cs_mb_46 cs_mb_lg_30">We are passionate advocates for environmental awareness and moral sustainability. Our mission is to empower individuals and community to make positive changes for our planet.</p>
            <p class="cs_progress_wrap_title cs_heading_color">Donation Collection</p>
            <div class="cs_progress_wrap">
              <div class="cs_progress" data-progress="70">
                <div class="cs_progress_in cs_accent_bg"><span>70%</span></div>
              </div>
            </div>
            <div class="cs_height_33 cs_height_lg_33"></div>
            <p class="cs_progress_wrap_title cs_heading_color">Project Success</p>
            <div class="cs_progress_wrap">
              <div class="cs_progress" data-progress="80">
                <div class="cs_progress_in cs_accent_bg"><span>80%</span></div>
              </div>
            </div>
            <div class="cs_height_70 cs_height_lg_0"></div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="row cs_gap_y_30">
            <div class="col-sm-6">
              <img src="{{ asset('img/nature/about_img_1.jpg') }}" alt="" class="w-100">
            </div>
            <div class="col-sm-6">
              <div class="cs_height_30 cs_height_lg_0"></div>
              <img src="{{ asset('img/nature/about_img_2.jpg') }}" alt="" class="w-100">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End About Section 2 -->
@endsection
