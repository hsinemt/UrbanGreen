@extends('layouts.app')

@section('title', 'Service Details')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Service Details</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Service Details</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Service Details Section -->
  <section>
    <div class="cs_height_150 cs_height_lg_80"></div>
    <div class="container">
      <div class="row cs_gap_y_80">
        <div class="col-xl-4 col-lg-5">
          <div class="cs_nav_widget cs_shadow_1">
            <h3 class="cs_nav_widget_title cs_accent_bg cs_white_color cs_fs_28 cs_semibold mb-0">Our Services</h3>
            <ul class="cs_mp_0">
              <li>
                <a href="{{ route('services.show', ['slug' => 'service-details']) }}">
                  Eco-Friendly Product
                  <i class="fa-solid fa-arrow-right-long"></i>
                </a>
              </li>
              <li>
                <a href="{{ route('services.show', ['slug' => 'service-details']) }}">
                  Advocacy and Campaigns
                  <i class="fa-solid fa-arrow-right-long"></i>
                </a>
              </li>
              <li>
                <a href="{{ route('services.show', ['slug' => 'service-details']) }}">
                  Sustainable Gardening
                  <i class="fa-solid fa-arrow-right-long"></i>
                </a>
              </li>
              <li>
                <a href="{{ route('services.show', ['slug' => 'service-details']) }}">
                  Wildlife Saving
                  <i class="fa-solid fa-arrow-right-long"></i>
                </a>
              </li>
              <li>
                <a href="{{ route('services.show', ['slug' => 'service-details']) }}">
                  Environmental Literature
                  <i class="fa-solid fa-arrow-right-long"></i>
                </a>
              </li>
              <li>
                <a href="{{ route('services.show', ['slug' => 'service-details']) }}">
                  Membership and Donations
                  <i class="fa-solid fa-arrow-right-long"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="cs_height_50 cs_height_lg_40"></div>
          <div class="cs_contact_widget cs_bg_filed text-center cs_" data-src="{{ asset('assets/img/others/contact_bg.jpg') }}">
            <div class="cs_contact_widget_in cs_center">
              <div class="cs_contact_widget_icon cs_accent_bg cs_center cs_mb_24"><img src="{{ asset('assets/img/others/contact_icon.svg') }}" alt=""></div>
              <h3 class="cs_contact_widget_title cs_white_color cs_fs_38 cs_semibold cs_mb_40">Have Any Query Feel Free Contact</h3>
              <a href="{{ route('contact') }}" class="cs_btn cs_style_1">
                Contact Now
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
          <div class="cs_height_50 cs_height_lg_40"></div>
          <div class="cs_form_widget cs_shadow_1">
            <h3 class="cs_form_widget_title cs_fs_28 cs_semibold cs_mb_31">Request a Quote</h3>
            <form action="#">
              <input type="text" class="cs_form_field cs_type_1 cs_mb_20" placeholder="Your Name">
              <input type="text" class="cs_form_field cs_type_1 cs_mb_20" placeholder="Your Email ">
              <textarea rows="4" cols="10" class="cs_form_field cs_type_1 cs_mb_20" placeholder="Message"></textarea>
              <button type="submit" class="cs_btn cs_style_1 w-100">
                Subscribe
                <i>
                  <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
                  <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
                </i>
              </button>
            </form>
          </div>
        </div>
        <div class="col-xl-8 col-lg-7">
          <div class="cs_details_content">
            <img src="{{ asset('assets/img/others/service_details_1.jpg') }}" alt="">
            <h4>1. Product Range</h4>
            <p>Explore our diverse range of eco-friendly products, including but not limited to reusable bags, biodegradable cutlery, sustainable home goods, organic clothing, and energy-efficient devices. Each product is carefully chosen to meet our high standards for environmental impact.</p>
            <h4>2. Sustainability Standards</h4>
            <p>We prioritize products that are made from recycled or renewable materials, are energy-efficient, and have minimal environmental footprints. Our selection process involves assessing the entire lifecycle of each product to ensure it aligns with our commitment to sustainability.</p>
            <h4>3. Educational Resources</h4>
            <p>In addition to offering eco-friendly products, we believe in empowering our customers with knowledge. Find informative guides, tips, and resources on our website to help you make informed choices about sustainable living and using our products.</p>
            <h4>4. Community Engagement</h4>
            <p>Join our community of environmentally conscious consumers. Connect with like-minded individuals, share your eco-friendly lifestyle tips, and participate in discussions about sustainable living. Together, we can amplify our positive impact on the planet.</p>
            <div class="row">
              <div class="col-sm-6">
                <img src="{{ asset('assets/img/others/service_details_2.jpg') }}" alt="" class="w-100">
              </div>
              <div class="col-sm-6">
                <div class="cs_height_30 cs_height_lg_30"></div>
                <img src="{{ asset('assets/img/others/service_details_3.jpg') }}" alt="" class="w-100">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End Service Details Section -->
@endsection
