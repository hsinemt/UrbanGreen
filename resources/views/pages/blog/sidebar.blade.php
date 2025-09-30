@extends('layouts.app')

@section('title', 'Blog With Sidebar')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Blog With Sidebar</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Blog With Sidebar</li>
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
        <div class="col-xl-8">
          <div class="row cs_gap_y_50">
            <div class="col-lg-6">
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
            <div class="col-lg-6">
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
            <div class="col-lg-6">
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
            <div class="col-lg-6">
              <div class="cs_post cs_style_1">
                <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_post_thumb">
                  <img src="{{ asset('assets/img/nature/post_img_7.jpg') }}" alt="Post">
                </a>
                <div class="cs_post_info cs_shadow_1">
                  <ul class="cs_post_meta cs_mp_0">
                    <li><i class="fa-solid fa-user-pen"></i>Bob marline</li>
                    <li><i class="fa-solid fa-tag"></i>Environment</li>
                  </ul>
                  <h2 class="cs_post_title cs_semibold cs_fs_28 cs_mb_22"><a href="{{ route('blog.show', ['slug' => 'blog-details']) }}">Stylish Choices for a Planet-Friendly Wardrobe</a></h2>
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
        <div class="col-xl-4">
          <div class="cs_sidebar cs_right_sidebar">
            <div class="cs_sidebar_item widget_search">
              <form class="cs_sidebar_search" action="#">
                <input type="text" placeholder="Search...">
                <button class="cs_sidebar_search_btn">
                  <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.83334 19.1667C7.98738 19.1667 6.18287 18.6193 4.64802 17.5937C3.11316 16.5682 1.91688 15.1105 1.21046 13.4051C0.504044 11.6996 0.319213 9.82298 0.679342 8.0125C1.03947 6.20201 1.92838 4.53896 3.23367 3.23367C4.53896 1.92838 6.20201 1.03947 8.0125 0.679342C9.82298 0.319213 11.6996 0.504044 13.4051 1.21046C15.1105 1.91688 16.5682 3.11316 17.5937 4.64802C18.6193 6.18287 19.1667 7.98738 19.1667 9.83334C19.1639 12.3078 18.1797 14.6802 16.4299 16.4299C14.6802 18.1797 12.3078 19.1639 9.83334 19.1667ZM9.83334 2.83334C8.44887 2.83334 7.09549 3.24388 5.94435 4.01305C4.7932 4.78222 3.89599 5.87547 3.36618 7.15455C2.83637 8.43364 2.69774 9.8411 2.96784 11.199C3.23794 12.5568 3.90462 13.8041 4.88359 14.7831C5.86256 15.7621 7.10984 16.4287 8.46771 16.6988C9.82557 16.9689 11.233 16.8303 12.5121 16.3005C13.7912 15.7707 14.8845 14.8735 15.6536 13.7223C16.4228 12.5712 16.8333 11.2178 16.8333 9.83334C16.8315 7.97739 16.0934 6.19799 14.781 4.88564C13.4687 3.57328 11.6893 2.83519 9.83334 2.83334Z" fill="currentColor"/>
                    <path d="M20.3346 21.5001C20.0252 21.5 19.7285 21.377 19.5098 21.1582L14.8431 16.4916C14.6306 16.2715 14.513 15.9768 14.5157 15.6709C14.5183 15.365 14.641 15.0724 14.8573 14.8561C15.0736 14.6398 15.3663 14.5171 15.6722 14.5144C15.9781 14.5118 16.2728 14.6294 16.4928 14.8419L21.1595 19.5086C21.3226 19.6717 21.4336 19.8796 21.4786 20.1059C21.5236 20.3321 21.5005 20.5667 21.4122 20.7798C21.324 20.993 21.1745 21.1752 20.9827 21.3034C20.7908 21.4316 20.5653 21.5 20.3346 21.5001Z" fill="currentColor"/>
                  </svg>
                </button>
              </form>
            </div>
            <div class="cs_sidebar_item widget_categories">
              <h4 class="cs_sidebar_widget_title">Categories</h4>
              <ul>
                <li class="cat-item">
                  <a href="#">Charity</a>
                </li>
                <li class="cat-item">
                  <a href="#">Environment</a>
                </li>
                <li class="cat-item">
                  <a href="#">Planet</a>
                </li>
                <li class="cat-item">
                  <a href="#">Pollution</a>
                </li>
                <li class="cat-item">
                  <a href="#">Ocean</a>
                </li>
                <li class="cat-item">
                  <a href="#">Donation</a>
                </li>
              </ul>
            </div>
            <div class="cs_sidebar_item">
              <h4 class="cs_sidebar_widget_title">Latest post</h4>
              <ul class="cs_recent_posts">
                <li>
                  <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_recent_post_thumb">
                    <img src="{{ asset('assets/img/nature/post_img_4.jpg') }}" alt="">
                  </a>
                  <div class="cs_recent_post">
                    <h3 class="cs_recent_post_title"><a href="{{ route('blog.show', ['slug' => 'blog-details']) }}">How reforestation can save our planet</a></h3>
                    <p class="cs_recent_post_date mb-0">Apr 10, 2024</p>
                  </div>
                </li>
                <li>
                  <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_recent_post_thumb">
                    <img src="{{ asset('assets/img/nature/post_img_5.jpg') }}" alt="">
                  </a>
                  <div class="cs_recent_post">
                    <h3 class="cs_recent_post_title"><a href="{{ route('blog.show', ['slug' => 'blog-details']) }}">Unmasking the hidden threat to our oceans</a></h3>
                    <p class="cs_recent_post_date mb-0">Sep 7, 2023</p>
                  </div>
                </li>
                <li>
                  <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_recent_post_thumb">
                    <img src="{{ asset('assets/img/nature/post_img_6.jpg') }}" alt="">
                  </a>
                  <div class="cs_recent_post">
                    <h3 class="cs_recent_post_title"><a href="{{ route('blog.show', ['slug' => 'blog-details']) }}">Tips for sustainable green space in home</a></h3>
                    <p class="cs_recent_post_date mb-0">July 1, 2023</p>
                  </div>
                </li>
                <li>
                  <a href="{{ route('blog.show', ['slug' => 'blog-details']) }}" class="cs_recent_post_thumb">
                    <img src="{{ asset('assets/img/nature/post_img_7.jpg') }}" alt="">
                  </a>
                  <div class="cs_recent_post">
                    <h3 class="cs_recent_post_title"><a href="{{ route('blog.show', ['slug' => 'blog-details']) }}">Unveiling beauty of upcycled and recycled</a></h3>
                    <p class="cs_recent_post_date mb-0">Oct 21, 2024</p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="cs_sidebar_item widget_tag_cloud">
              <h4 class="cs_sidebar_widget_title">Popular tags</h4>
              <div class="tagcloud">
                <a href="#" class="tag-cloud-link">Environment</a>
                <a href="#" class="tag-cloud-link">Green</a>
                <a href="#" class="tag-cloud-link">Climate</a>
                <a href="#" class="tag-cloud-link">Ocean</a>
                <a href="#" class="tag-cloud-link">Recycling</a>
                <a href="#" class="tag-cloud-link">Charity</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End Blog Section -->
@endsection
