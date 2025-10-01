@extends('frontOffice.layouts.app')
@section('title', 'Contact')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Contact Us</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Contact</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Contact Section -->
  <section>
    <div class="cs_height_150 cs_height_lg_80"></div>
    <div class="container">
      <div class="row align-items-center cs_gap_y_40">
        <div class="col-lg-6">
          <img src="{{ asset('frontOffice/img/others/contact_img.jpg') }}" alt="" class="w-100">
        </div>
        <div class="col-lg-6">
          <div class="cs_pl_75">
            <h3 class="cs_fs_38 cs_semibold cs_mb_14">Get in Touch with Our Team</h3>
            <p class="cs_mb_46">Feel free to reach out to us via the contact form below, and we'll do our best to respond promptly.</p>
            <form action="#" class="cs_contact_form">
              <input type="text" class="cs_form_field cs_mb_25" placeholder="Full name *">
              <input type="text" class="cs_form_field cs_mb_25" placeholder="Email Address *">
              <input type="text" class="cs_form_field cs_mb_25" placeholder="Mobile Number *">
              <textarea class="cs_form_field cs_mb_25" cols="30" rows="4" placeholder="Write your comment *"></textarea>
              <button class="cs_btn cs_style_1">
                Send message
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
      </div>
    </div>
    <div class="cs_height_145 cs_height_lg_75"></div>
  </section>
  <!-- End Contact Section -->

  <!-- Start Contact Info Section -->
  <section>
    <div class="container">
      <div class="row cs_gap_y_30">
        <div class="col-lg-4">
          <div class="cs_iconbox cs_style_7">
            <div class="cs_iconbox_icon cs_center"><img src="{{ asset('frontOffice/img/others/contact_icon_1.svg') }}" alt=""></div>
            <div class="cs_iconbox_info">
              <h3 class="cs_fs_28 cs_semibold cs_mb_10">Office Location</h3>
              <p class="mb-0">452 15h Street, Office 741, Ohio, De 47754, USA</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="cs_iconbox cs_style_7">
            <div class="cs_iconbox_icon cs_center"><img src="{{ asset('frontOffice/img/others/contact_icon_2.svg') }}" alt=""></div>
            <div class="cs_iconbox_info">
              <h3 class="cs_fs_28 cs_semibold cs_mb_10">Email address</h3>
              <p class="mb-0"><a href="mailto:info@ecozone.com">info@ecozone.com</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="cs_iconbox cs_style_7">
            <div class="cs_iconbox_icon cs_center"><img src="{{ asset('frontOffice/img/others/contact_icon_3.svg') }}" alt=""></div>
            <div class="cs_iconbox_info">
              <h3 class="cs_fs_28 cs_semibold cs_mb_10">Office Location</h3>
              <p class="mb-0"><a href="tel:+214544512009">+21 454 451 2009</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End Contact Info Section -->

  <!-- Start Map Section -->
  <div class="cs_map">
    <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96652.27317354927!2d-74.33557928194516!3d40.79756494697628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3a82f1352d0dd%3A0x81d4f72c4435aab5!2sTroy+Meadows+Wetlands!5e0!3m2!1sen!2sbd!4v1563075599994!5m2!1sen!2sbd" allowfullscreen></iframe>
  </div>
  <!-- End Map Section -->
@endsection
