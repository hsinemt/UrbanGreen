@extends('layouts.app')

@section('title', 'Blog')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Our Blog</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Blog</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Blog Section -->
  <section class="cs_shape_wrap">
    <div class="cs_height_145 cs_height_lg_75"></div>
    <div class="cs_shape cs_shape_position_4"><img src="{{ asset('assets/img/nature/blog_shape_1.png') }}" alt=""></div>
    <div class="cs_shape cs_shape_position_5"><img src="{{ asset('assets/img/nature/blog_shape_2.png') }}" alt=""></div>
    <div class="container">
      <div class="cs_section_heading cs_style_1 text-center">
        <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13">Blog Post</h3>
        <h2 class="cs_fs_51 mb-0">Our Latest News & Updates</h2>
      </div>
      <div class="cs_height_90 cs_height_lg_50"></div>
      <div class="row cs_gap_y_50">
        <div class="col-lg-4">
          <div class="cs_post cs_style_1">
            <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_post_thumb">
              <img src="{{ asset('assets/img/nature/post_img_1.jpg') }}" alt="Post">
            </a>
            <div class="cs_post_info cs_shadow_1">
              <ul class="cs_post_meta cs_mp_0">
                <li><i class="fa-solid fa-user-pen"></i>Bob marline</li>
                <li><i class="fa-solid fa-tag"></i>Environment</li>
              </ul>
              <h2 class="cs_post_title cs_semibold cs_fs_28 cs_mb_22"><a href="{{ route('blog.show', ['slug' => 'blog-details']) }}">How Reforestation Can Save Our Planet</a></h2>
              <p class="cs_post_subtitle cs_mb_16">Discover the incredible impact of reforest on our environment and the critical role trees play in mitigating climate...</p>
              <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_btn cs_style_2 cs_heading_color">
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
        <div class="col-lg-4">
          <div class="cs_post cs_style_1">
            <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_post_thumb">
              <img src="{{ asset('assets/img/nature/post_img_2.jpg') }}" alt="Post">
            </a>
            <div class="cs_post_info cs_shadow_1">
              <ul class="cs_post_meta cs_mp_0">
                <li><i class="fa-solid fa-user-pen"></i>Bob marline</li>
                <li><i class="fa-solid fa-tag"></i>Environment</li>
              </ul>
              <h2 class="cs_post_title cs_semibold cs_fs_28 cs_mb_22"><a href="{{ route('blog.show', ['slug' => 'blog-details']) }}">Unmasking the Hidden Threat to Our Oceans</a></h2>
              <p class="cs_post_subtitle cs_mb_16">Dive into the disturbing reality of plastic pollution in our oceans. This blog sheds light on the consequences of single...</p>
              <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_btn cs_style_2 cs_heading_color">
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
        <div class="col-lg-4">
          <div class="cs_post cs_style_1">
            <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_post_thumb">
              <img src="{{ asset('assets/img/nature/post_img_3.jpg') }}" alt="Post">
            </a>
            <div class="cs_post_info cs_shadow_1">
              <ul class="cs_post_meta cs_mp_0">
                <li><i class="fa-solid fa-user-pen"></i>Bob marline</li>
                <li><i class="fa-solid fa-tag"></i>Environment</li>
              </ul>
              <h2 class="cs_post_title cs_semibold cs_fs_28 cs_mb_22"><a href="{{ route('blog.show', ['slug' => 'blog-details']) }}">Tips for Sustainable Green Spaces in Home</a></h2>
              <p class="cs_post_subtitle cs_mb_16">Discover the incredible impact of reforest on our environment and the critical role trees play in mitigating climate...</p>
              <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_btn cs_style_2 cs_heading_color">
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
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End Blog Section -->
@endsection
