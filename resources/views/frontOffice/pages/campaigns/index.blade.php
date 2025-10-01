@extends('frontOffice.layouts.app')
@section('title', 'Campaigns')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Campaigns</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Campaigns</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Donation Section -->
  <section>
    <div class="cs_height_145 cs_height_lg_75"></div>
    <div class="container">
      <div class="cs_section_heading cs_style_1 text-center">
        <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13">Donation</h3>
        <h2 class="cs_fs_51 mb-0">Supporting Our Environmental <br>Fundraising Initiatives</h2>
      </div>
      <div class="cs_height_90 cs_height_lg_50"></div>
    </div>
    <div class="container">
      <div class="row cs_gap_y_50">
        <div class="col-lg-6">
          <div class="cs_card cs_style_2 cs_type_2 cs_shadow_1 cs_white_bg">
            <div class="cs_card_thumb"><img src="{{ asset('frontOffice/img/others/card_img_1.jpg') }}" alt="" class="w-100"></div>
            <div class="cs_card_info">
              <h2 class="cs_fs_38 cs_mb_20 cs_semibold">Reforestation and Tree Planting Campaign 2024</h2>
              <p class="cs_mb_14">Deforestation poses a significant threat to our environment, contributing to climate change and the loss of crucial habitats for countless species. Our campaign focuses on reversing this trend by planting trees...</p>
              <div class="cs_progress_wrap">
                <div class="cs_progress" data-progress="70">
                  <div class= "cs_progress_in cs_accent_bg"><span>70%</span></div>
                </div>
              </div>
              <div class="cs_progress_heading cs_mb_28">
                <h3 class="cs_fs_21 cs_semibold mb-0">Goal : $4000</h3>
                <h3 class="cs_fs_21 cs_semibold mb-0">Raised : $2800</h3>
              </div>
              <a href="{{ route('contact') }}" class="cs_btn cs_style_1 w-100">
                Donate Now
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
        <div class="col-lg-6">
          <div class="cs_card cs_style_2 cs_type_2 cs_shadow_1 cs_white_bg">
            <div class="cs_card_thumb"><img src="{{ asset('frontOffice/img/others/card_img_2.jpg') }}" alt="" class="w-100"></div>
            <div class="cs_card_info">
              <h2 class="cs_fs_38 cs_mb_20 cs_semibold">Protecting Endangered Species and Their Habitats</h2>
              <p class="cs_mb_14">Deforestation poses a significant threat to our environment, contributing to climate change and the loss of crucial habitats for countless species. Our campaign focuses on reversing this trend by planting trees...</p>
              <div class="cs_progress_wrap">
                <div class="cs_progress" data-progress="78">
                  <div class= "cs_progress_in cs_accent_bg"><span>78%</span></div>
                </div>
              </div>
              <div class="cs_progress_heading cs_mb_28">
                <h3 class="cs_fs_21 cs_semibold mb-0">Goal : $4000</h3>
                <h3 class="cs_fs_21 cs_semibold mb-0">Raised : $3300</h3>
              </div>
              <a href="{{ route('contact') }}" class="cs_btn cs_style_1 w-100">
                Donate Now
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
        <div class="col-lg-6">
          <div class="cs_card cs_style_2 cs_type_2 cs_shadow_1 cs_white_bg">
            <div class="cs_card_thumb"><img src="{{ asset('frontOffice/img/others/card_img_3.jpg') }}" alt="" class="w-100"></div>
            <div class="cs_card_info">
              <h2 class="cs_fs_38 cs_mb_20 cs_semibold">Supporting Sustainable Agriculture and Food Security</h2>
              <p class="cs_mb_14">Deforestation poses a significant threat to our environment, contributing to climate change and the loss of crucial habitats for countless species. Our campaign focuses on reversing this trend by planting trees...</p>
              <div class="cs_progress_wrap">
                <div class="cs_progress" data-progress="50">
                  <div class= "cs_progress_in cs_accent_bg"><span>50%</span></div>
                </div>
              </div>
              <div class="cs_progress_heading cs_mb_28">
                <h3 class="cs_fs_21 cs_semibold mb-0">Goal : $5000</h3>
                <h3 class="cs_fs_21 cs_semibold mb-0">Raised : $2500</h3>
              </div>
              <a href="{{ route('contact') }}" class="cs_btn cs_style_1 w-100">
                Donate Now
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
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End Donation Section -->
@endsection
