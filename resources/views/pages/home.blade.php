@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <!-- Start Hero Section (from template/index.html) -->
  <section class="cs_hero cs_style_1 cs_heading_bg cs_center cs_bg_filed" data-src="public/img/nature/hero_bg.jpg">
    <div class="container">
      <div class="cs_hero_thumb wow fadeIn" data-wow-duration="1s" data-wow-delay="0.25s">
        <div class="cs_hero_thumb_left"><img src="public/img/nature/hero_img_1.jpg" alt="Thumb"></div>
        <div class="cs_hero_thumb_right"><img src="public/img/nature/hero_img_2.jpg" alt="Thumb"></div>
        <div class="cs_rotate_text_box cs_bg_filed cs_center" data-src="public/img/nature/hero_rotate_text_bg.svg">
          <img src="public/img/nature/hero_rotate_text.svg" alt="">
        </div>
      </div>
      <div class="cs_slider cs_style_1 cs_slider_gap_24 wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.25s">
        <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="1">
          <div class="cs_slider_wrapper">
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
        <div class="cs_pagination cs_style_1"></div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Feature Section (from template/index.html) -->
  <section>
    <div class="cs_height_150 cs_height_lg_80"></div>
    <div class="container">
      <div class="row cs_row_gap_50 cs_gap_y_50">
        <div class="col-lg-4">
          <div class="cs_iconbox cs_style_1">
            <div class="cs_iconbox_icon cs_mb_26 cs_mb_lg_20"><img src="public/img/nature/climate_change_icon.svg" alt=""></div>
            <h2 class="cs_fs_38 cs_semibold cs_mb_22 cs_mb_lg_15">Climate Change</h2>
            <p class="mb-0">Discuss the science, impacts, and solutions related to climate change, including global warming, extreme weather events, and the transition to renewable energy sources.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="cs_iconbox cs_style_1">
            <div class="cs_iconbox_icon cs_mb_26 cs_mb_lg_20"><img src="public/img/nature/sustainable_living.png" alt=""></div>
            <h2 class="cs_fs_38 cs_semibold cs_mb_22 cs_mb_lg_15">Sustainable Living</h2>
            <p class="mb-0">Provide tips and information on sustainable practices in areas such as energy conservation, waste reduction, and eco-friendly lifestyle choices.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="cs_iconbox cs_style_1">
            <div class="cs_iconbox_icon cs_mb_26 cs_mb_lg_20"><img src="public/img/nature/deforestation.svg" alt=""></div>
            <h2 class="cs_fs_38 cs_semibold cs_mb_22 cs_mb_lg_15">Deforestation</h2>
            <p class="mb-0">Discuss the impact of deforestation on ecosystems, climate, and biodiversity, as well as reforestation and afforestation efforts.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Feature Section -->

{{--  <!-- Start About Section (from template/index.html) -->--}}
{{--  <section class="cs_shape_wrap">--}}
{{--    <div class="cs_height_140 cs_height_lg_70"></div>--}}
{{--    <div class="cs_shape cs_shape_position_1"><img src="{{ asset('public/img/nature/about_shape_1.svg') }}" alt=""></div>--}}
{{--    <div class="container">--}}
{{--      <div class="row align-items-center cs_gap_y_50">--}}
{{--        <div class="col-lg-6">--}}
{{--          <a href="https://www.youtube.com/embed/rRid6GCJtgc" class="cs_video_block cs_style_1 cs_bg_filed cs_video_open cs_center" data-src="{{ asset('public/img/nature/video_block_bg.jpg') }}">--}}
{{--            <span class="cs_player_btn cs_white_color">--}}
{{--              <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                <path d="M35 0C15.7004 0 0 15.7004 0 35C0 54.2996 15.7004 70 35 70C54.2996 70 70 54.2996 70 35C70 15.7004 54.2996 0 35 0ZM35 64.1667C18.9175 64.1667 5.83333 51.0825 5.83333 35C5.83333 18.9175 18.9175 5.83333 35 5.83333C51.0825 5.83333 64.1667 18.9175 64.1667 35C64.1667 51.0825 51.0825 64.1667 35 64.1667ZM23.3333 51.4704L52.6167 35L23.3333 18.5296V51.4733V51.4704ZM29.1667 28.5017L40.7167 35L29.1667 41.4983V28.5017Z" fill="currentColor"/>--}}
{{--              </svg>--}}
{{--            </span>--}}
{{--          </a>--}}
{{--        </div>--}}
{{--        <div class="col-lg-6">--}}
{{--          <div class="cs_pl_75">--}}
{{--            <h3 class="cs_accent_color cs_fs_21 cs_semibold cs_mb_13">About Us</h3>--}}
{{--            <h2 class="cs_fs_51 cs_mb_29">Creating a Lasting Alliance for a Greener Future</h2>--}}
{{--            <p class="cs_mb_37">We are passionate advocates for environmental awareness and moral sustainability. Our mission is to empower individuals and community to make positive changes for our planet. We believe that small actions can lead to big transformations, and we're dedicated to providing the knowledge, resources, and inspiration needed.</p>--}}
{{--            <ul class="cs_list cs_style_1 cs_mp_0">--}}
{{--              <li>--}}
{{--                <i class="cs_list_icon cs_accent_color">--}}
{{--                  <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path d="M0 9.62275C0.0320847 8.83012 0.390363 8.2499 1.11227 7.93388C1.84487 7.61269 2.54004 7.73702 3.1443 8.25508C4.06406 9.0477 4.96777 9.85587 5.87684 10.6589C6.04796 10.8091 6.21908 10.9645 6.39554 11.1148C6.65757 11.3427 6.88751 11.3323 7.12279 11.0733C9.096 8.91819 11.0639 6.75789 13.0371 4.5976C14.3686 3.13668 15.7054 1.68094 17.037 0.220014C17.2027 0.0386945 17.3952 -0.0493752 17.6412 0.0283334C17.8498 0.0956808 18.0102 0.277001 17.9995 0.494585C17.9941 0.608557 17.946 0.732891 17.8819 0.831322C16.3685 3.19884 14.8552 5.56118 13.3419 7.92352C11.5986 10.6433 9.85534 13.3631 8.11207 16.0881C7.80727 16.5647 7.39551 16.8859 6.81264 16.974C6.15491 17.0776 5.60947 16.8704 5.19237 16.3782C3.69508 14.6116 2.20849 12.8399 0.716557 11.0681C0.433143 10.7469 0.133686 10.4257 0.0534744 9.98539C0.0267372 9.85587 0.0160423 9.73154 0 9.62275Z" fill="currentColor"/>--}}
{{--                  </svg>--}}
{{--                </i>--}}
{{--                <h3 class="cs_fs_28 cs_semibold cs_mb_15">Our Mission</h3>--}}
{{--                <p class="mb-0">Explain the core purpose of your website, which may be to raise awareness, educate, or inspire positive environmental change.</p>--}}
{{--              </li>--}}
{{--              <li>--}}
{{--                <i class="cs_list_icon cs_accent_color">--}}
{{--                  <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path d="M0 9.62275C0.0320847 8.83012 0.390363 8.2499 1.11227 7.93388C1.84487 7.61269 2.54004 7.73702 3.1443 8.25508C4.06406 9.0477 4.96777 9.85587 5.87684 10.6589C6.04796 10.8091 6.21908 10.9645 6.39554 11.1148C6.65757 11.3427 6.88751 11.3323 7.12279 11.0733C9.096 8.91819 11.0639 6.75789 13.0371 4.5976C14.3686 3.13668 15.7054 1.68094 17.037 0.220014C17.2027 0.0386945 17.3952 -0.0493752 17.6412 0.0283334C17.8498 0.0956808 18.0102 0.277001 17.9995 0.494585C17.9941 0.608557 17.946 0.732891 17.8819 0.831322C16.3685 3.19884 14.8552 5.56118 13.3419 7.92352C11.5986 10.6433 9.85534 13.3631 8.11207 16.0881C7.80727 16.5647 7.39551 16.8859 6.81264 16.974C6.15491 17.0776 5.60947 16.8704 5.19237 16.3782C3.69508 14.6116 2.20849 12.8399 0.716557 11.0681C0.433143 10.7469 0.133686 10.4257 0.0534744 9.98539C0.0267372 9.85587 0.0160423 9.73154 0 9.62275Z" fill="currentColor"/>--}}
{{--                  </svg>--}}
{{--                </i>--}}
{{--                <h3 class="cs_fs_28 cs_semibold cs_mb_15">Our Values</h3>--}}
{{--                <p class="mb-0">Outline the principles and values that guide your work, such as sustainability, scientific accuracy, inclusivity, and the promotion of positive action.</p>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--            <div class="cs_height_45 cs_height_lg_30"></div>--}}
{{--            <a href="{{ route('about') }}" class="cs_btn cs_style_1">--}}
{{--              Learn More--}}
{{--              <i>--}}
{{--                <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                  <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                </svg>--}}
{{--                <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                  <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                </svg>--}}
{{--              </i>--}}
{{--            </a>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--    <div class="cs_height_150 cs_height_lg_80"></div>--}}
{{--  </section>--}}
{{--  <!-- End About Section -->--}}

{{--  <!-- Start Services Section (What We Do) -->--}}
{{--  <section class="cs_gray_bg_2">--}}
{{--    <div class="cs_height_145 cs_height_lg_75"></div>--}}
{{--    <div class="container">--}}
{{--      <div class="cs_section_heading cs_style_1 text-center">--}}
{{--        <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13">What We Do</h3>--}}
{{--        <h2 class="cs_fs_51 mb-0">Our Initiatives and Impact</h2>--}}
{{--      </div>--}}
{{--      <div class="cs_height_90 cs_height_lg_50"></div>--}}
{{--    </div>--}}
{{--    <div class="container">--}}
{{--      <div class="row cs_gap_y_40">--}}
{{--        <div class="col-xl-3 col-md-6">--}}
{{--          <div class="cs_iconbox cs_style_6 cs_shadow_1 text-center cs_white_bg">--}}
{{--            <div class="cs_iconbox_icon cs_accent_bg cs_mb_30 cs_center">--}}
{{--              <img src="{{ asset('assets/img/others/feature_icon_1.svg') }}" alt="">--}}
{{--            </div>--}}
{{--            <h3 class="cs_iconbox_title cs_fs_28 cs_semibold cs_mb_24">Environmental Education</h3>--}}
{{--            <p class="mb-0">Educational resources, articles, and guides to raise awareness and empower informed choices.</p>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-md-6">--}}
{{--          <div class="cs_iconbox cs_style_6 cs_shadow_1 text-center cs_white_bg">--}}
{{--            <div class="cs_iconbox_icon cs_accent_bg cs_mb_30 cs_center">--}}
{{--              <img src="{{ asset('assets/img/others/feature_icon_2.svg') }}" alt="">--}}
{{--            </div>--}}
{{--            <h3 class="cs_iconbox_title cs_fs_28 cs_semibold cs_mb_24">Advocacy & Action</h3>--}}
{{--            <p class="mb-0">Support and lead campaigns addressing pressing environmental issues.</p>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-md-6">--}}
{{--          <div class="cs_iconbox cs_style_6 cs_shadow_1 text-center cs_white_bg">--}}
{{--            <div class="cs_iconbox_icon cs_accent_bg cs_mb_30 cs_center">--}}
{{--              <img src="{{ asset('assets/img/others/feature_icon_3.svg') }}" alt="">--}}
{{--            </div>--}}
{{--            <h3 class="cs_iconbox_title cs_fs_28 cs_semibold cs_mb_24">Community Building</h3>--}}
{{--            <p class="mb-0">Fostering collaboration among environmentally conscious individuals.</p>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-md-6">--}}
{{--          <div class="cs_iconbox cs_style_6 cs_shadow_1 text-center cs_white_bg">--}}
{{--            <div class="cs_iconbox_icon cs_accent_bg cs_mb_30 cs_center">--}}
{{--              <img src="{{ asset('assets/img/others/feature_icon_4.svg') }}" alt="">--}}
{{--            </div>--}}
{{--            <h3 class="cs_iconbox_title cs_fs_28 cs_semibold cs_mb_24">Promoting Sustainability</h3>--}}
{{--            <p class="mb-0">Tips, products, and practices to reduce environmental footprint.</p>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--    <div class="cs_height_150 cs_height_lg_80"></div>--}}
{{--  </section>--}}
{{--  <!-- End Services Section -->--}}

{{--  <!-- Start Team Preview Section -->--}}
{{--  <section>--}}
{{--    <div class="cs_height_145 cs_height_lg_75"></div>--}}
{{--    <div class="container">--}}
{{--      <div class="cs_section_heading cs_style_1 text-center">--}}
{{--        <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13">Our Team</h3>--}}
{{--        <h2 class="cs_fs_51 mb-0">Meet Our Dedicated Environmental Advocates</h2>--}}
{{--      </div>--}}
{{--      <div class="cs_height_90 cs_height_lg_50"></div>--}}
{{--      <div class="row cs_gap_y_50">--}}
{{--        <div class="col-lg-6">--}}
{{--          <div class="cs_team cs_style_1">--}}
{{--            <div class="cs_team_thumb"><img src="{{ asset('assets/img/nature/team_member_1.jpg') }}" alt=""></div>--}}
{{--            <div class="cs_team_right">--}}
{{--              <p class="text-uppercase cs_accent_color cs_mb_1">CEO FOUNDER</p>--}}
{{--              <h3 class="cs_fs_38 cs_mb_18">Jhon Beboral</h3>--}}
{{--              <hr class="cs_mb_12">--}}
{{--              <p class="cs_mb_20">Team component built to improve trust and culture within your.</p>--}}
{{--              <div class="cs_team_social_list cs_heading_color">--}}
{{--                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>--}}
{{--                <a href="#"><i class="fa-brands fa-instagram"></i></a>--}}
{{--                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-6">--}}
{{--          <div class="cs_team cs_style_1">--}}
{{--            <div class="cs_team_thumb"><img src="{{ asset('assets/img/nature/team_member_2.jpg') }}" alt=""></div>--}}
{{--            <div class="cs_team_right">--}}
{{--              <p class="text-uppercase cs_accent_color cs_mb_1">VOLUNTEER</p>--}}
{{--              <h3 class="cs_fs_38 cs_mb_18">Peter Dobar</h3>--}}
{{--              <hr class="cs_mb_12">--}}
{{--              <p class="cs_mb_20">Team component built to improve trust and culture within your.</p>--}}
{{--              <div class="cs_team_social_list cs_heading_color">--}}
{{--                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>--}}
{{--                <a href="#"><i class="fa-brands fa-instagram"></i></a>--}}
{{--                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--      <div class="cs_height_45 cs_height_lg_30"></div>--}}
{{--      <div class="text-center">--}}
{{--        <a href="{{ route('team') }}" class="cs_btn cs_style_1">--}}
{{--          View Full Team--}}
{{--          <i>--}}
{{--            <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--              <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--            </svg>--}}
{{--            <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--              <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--            </svg>--}}
{{--          </i>--}}
{{--        </a>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--    <div class="cs_height_150 cs_height_lg_80"></div>--}}
{{--  </section>--}}
{{--  <!-- End Team Preview Section -->--}}

{{--  <!-- Start Blog Section -->--}}
{{--  <section class="cs_shape_wrap">--}}
{{--    <div class="cs_height_145 cs_height_lg_75"></div>--}}
{{--    <div class="cs_shape cs_shape_position_4"><img src="{{ asset('assets/img/nature/blog_shape_1.png') }}" alt=""></div>--}}
{{--    <div class="cs_shape cs_shape_position_5"><img src="{{ asset('assets/img/nature/blog_shape_2.png') }}" alt=""></div>--}}
{{--    <div class="container">--}}
{{--      <div class="cs_section_heading cs_style_1 text-center">--}}
{{--        <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13">Blog Post</h3>--}}
{{--        <h2 class="cs_fs_51 mb-0">Our Latest News & Updates</h2>--}}
{{--      </div>--}}
{{--      <div class="cs_height_90 cs_height_lg_50"></div>--}}
{{--      <div class="row cs_gap_y_50">--}}
{{--        <div class="col-lg-4">--}}
{{--          <div class="cs_post cs_style_1">--}}
{{--            <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_post_thumb">--}}
{{--              <img src="{{ asset('assets/img/nature/post_img_1.jpg') }}" alt="Post">--}}
{{--            </a>--}}
{{--            <div class="cs_post_info cs_shadow_1">--}}
{{--              <ul class="cs_post_meta cs_mp_0">--}}
{{--                <li><i class="fa-solid fa-user-pen"></i>Bob marline</li>--}}
{{--                <li><i class="fa-solid fa-tag"></i>Environment</li>--}}
{{--              </ul>--}}
{{--              <h2 class="cs_post_title cs_semibold cs_fs_28 cs_mb_22"><a href="{{ route('blog.show', ['slug' => 'blog-details']) }}">How Reforestation Can Save Our Planet</a></h2>--}}
{{--              <p class="cs_post_subtitle cs_mb_16">Discover the incredible impact of reforest on our environment and the critical role trees play in mitigating climate...</p>--}}
{{--              <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_btn cs_style_2 cs_heading_color">--}}
{{--                Learn More--}}
{{--                <i>--}}
{{--                  <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                  </svg>--}}
{{--                  <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                  </svg>--}}
{{--                </i>--}}
{{--              </a>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4">--}}
{{--          <div class="cs_post cs_style_1">--}}
{{--            <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_post_thumb">--}}
{{--              <img src="{{ asset('assets/img/nature/post_img_2.jpg') }}" alt="Post">--}}
{{--            </a>--}}
{{--            <div class="cs_post_info cs_shadow_1">--}}
{{--              <ul class="cs_post_meta cs_mp_0">--}}
{{--                <li><i class="fa-solid fa-user-pen"></i>Bob marline</li>--}}
{{--                <li><i class="fa-solid fa-tag"></i>Environment</li>--}}
{{--              </ul>--}}
{{--              <h2 class="cs_post_title cs_semibold cs_fs_28 cs_mb_22"><a href="{{ route('blog.show', ['slug' => 'blog-details']) }}">Unmasking the Hidden Threat to Our Oceans</a></h2>--}}
{{--              <p class="cs_post_subtitle cs_mb_16">Dive into the disturbing reality of plastic pollution in our oceans. This blog sheds light on the consequences of single...</p>--}}
{{--              <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_btn cs_style_2 cs_heading_color">--}}
{{--                Learn More--}}
{{--                <i>--}}
{{--                  <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                  </svg>--}}
{{--                  <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                  </svg>--}}
{{--                </i>--}}
{{--              </a>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4">--}}
{{--          <div class="cs_post cs_style_1">--}}
{{--            <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_post_thumb">--}}
{{--              <img src="{{ asset('assets/img/nature/post_img_3.jpg') }}" alt="Post">--}}
{{--            </a>--}}
{{--            <div class="cs_post_info cs_shadow_1">--}}
{{--              <ul class="cs_post_meta cs_mp_0">--}}
{{--                <li><i class="fa-solid fa-user-pen"></i>Bob marline</li>--}}
{{--                <li><i class="fa-solid fa-tag"></i>Environment</li>--}}
{{--              </ul>--}}
{{--              <h2 class="cs_post_title cs_semibold cs_fs_28 cs_mb_22"><a href="{{ route('blog.show', ['slug' => 'blog-details']) }}">Tips for Sustainable Green Spaces in Home</a></h2>--}}
{{--              <p class="cs_post_subtitle cs_mb_16">Discover the incredible impact of reforest on our environment and the critical role trees play in mitigating climate...</p>--}}
{{--              <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_btn cs_style_2 cs_heading_color">--}}
{{--                Learn More--}}
{{--                <i>--}}
{{--                  <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                  </svg>--}}
{{--                  <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                  </svg>--}}
{{--                </i>--}}
{{--              </a>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--    <div class="cs_height_150 cs_height_lg_80"></div>--}}
{{--  </section>--}}
{{--  <!-- End Blog Section -->--}}

{{--  <!-- Start Gallery Strip -->--}}
{{--  <section>--}}
{{--    <div class="container-fluid p-0">--}}
{{--      <div class="cs_gallery_list cs_style_1">--}}
{{--        <a href="{{ asset('assets/img/ocean-life/gallery_img_1.jpg') }}" class="cs_gallery_item">--}}
{{--          <img src="{{ asset('assets/img/ocean-life/gallery_img_1.jpg') }}" alt="">--}}
{{--          <div class="cs_gallery_hover cs_center">--}}
{{--            <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--              <g>--}}
{{--                <path d="M55.5833 26.5833H31.4167V2.41667C31.4167 1.77573 31.1621 1.16104 30.7088 0.707825C30.2556 0.254612 29.6409 0 29 0C28.3591 0 27.7444 0.254612 27.2912 0.707825C26.8379 1.16104 26.5833 1.77573 26.5833 2.41667V26.5833H2.41667C1.77573 26.5833 1.16104 26.8379 0.707825 27.2912C0.254612 27.7444 0 28.3591 0 29C0 29.6409 0.254612 30.2556 0.707825 30.7088C1.16104 31.1621 1.77573 31.4167 2.41667 31.4167H26.5833V55.5833C26.5833 56.2243 26.8379 56.839 27.2912 57.2922C27.7444 57.7454 28.3591 58 29 58C29.6409 58 30.2556 57.7454 30.7088 57.2922C31.1621 56.839 31.4167 56.2243 31.4167 55.5833V31.4167H55.5833C56.2243 31.4167 56.839 31.1621 57.2922 30.7088C57.7454 30.2556 58 29.6409 58 29C58 28.3591 57.7454 27.7444 57.2922 27.2912C56.839 26.8379 56.2243 26.5833 55.5833 26.5833Z" fill="white"/>--}}
{{--              </g>--}}
{{--            </svg>--}}
{{--          </div>--}}
{{--        </a>--}}
{{--        <a href="{{ asset('assets/img/ocean-life/gallery_img_2.jpg') }}" class="cs_gallery_item">--}}
{{--          <img src="{{ asset('assets/img/ocean-life/gallery_img_2.jpg') }}" alt="">--}}
{{--          <div class="cs_gallery_hover cs_center"></div>--}}
{{--        </a>--}}
{{--        <a href="{{ asset('assets/img/ocean-life/gallery_img_3.jpg') }}" class="cs_gallery_item">--}}
{{--          <img src="{{ asset('assets/img/ocean-life/gallery_img_3.jpg') }}" alt="">--}}
{{--          <div class="cs_gallery_hover cs_center"></div>--}}
{{--        </a>--}}
{{--        <a href="{{ asset('assets/img/ocean-life/gallery_img_4.jpg') }}" class="cs_gallery_item">--}}
{{--          <img src="{{ asset('assets/img/ocean-life/gallery_img_4.jpg') }}" alt="">--}}
{{--          <div class="cs_gallery_hover cs_center"></div>--}}
{{--        </a>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--    <div class="cs_height_150 cs_height_lg_80"></div>--}}
{{--  </section>--}}
{{--  <!-- End Gallery Strip -->--}}
@endsection
