@extends('layouts.app')

@section('title', 'Charity')

@section('content')
  <!-- Start Hero Section (from template/charity.html) -->
  <section class="cs_hero cs_style_6 cs_heading_bg cs_center cs_ripple_activate" data-src="{{ asset('assets/img/charity/hero_bg.jpg') }}">
    <div class="container">
      <div class="row cs_gap_y_40">
        <div class="col-lg-7">
          <div class="cs_hero_text wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.25s">
            <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_38 cs_mb_lg_25">Nourishing Hope: Food Donations for a Cause</h1>
            <p class="cs_hero_subtitle cs_white_color mb-0">Your food donations play a pivotal role in supporting local charities and communities in need. Together, let's create a positive impact by providing nourishment and sustenance to those who need it most.</p>
            <span class="cs_accent_color cs_hero_shape">
              <svg width="84" height="77" viewBox="0 0 84 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.6366 15.0076C22.4931 17.106 25.7716 20.1709 29.492 22.4975C33.1396 24.7755 36.5395 27.5247 39.8471 30.235C46.5547 35.7188 52.6793 42.1594 56.8126 49.8047C57.3615 50.8198 56.0209 51.9224 55.1855 51.0578C49.2794 44.9037 43.213 38.9148 37.0447 33.0376C34.043 30.1686 30.9993 27.3369 27.9135 24.5423C24.6496 21.594 20.9049 19.1994 17.6847 16.2414C17.0144 15.6197 17.8741 14.5899 18.6366 15.0076Z" fill="currentColor"/>
                <path d="M1.09196 43.7784C5.4822 43.7558 9.83247 44.8587 14.2137 45.1017C18.5077 45.3373 22.8121 46.1051 27.0168 46.8834C35.5376 48.4507 44.0094 51.1374 51.3181 55.84C52.2886 56.4644 51.6463 58.077 50.4974 57.7227C42.3552 55.1816 34.1524 52.8624 25.914 50.6903C21.9008 49.6255 17.8686 48.6135 13.8175 47.6544C9.53626 46.6466 5.10093 46.3558 0.853263 45.3183C-0.0337717 45.0971 0.222502 43.7804 1.09196 43.7784Z" fill="currentColor"/>
                <path d="M51.1749 0.725824C53.2884 4.57411 54.3935 8.92399 56.2693 12.891C58.1099 16.7778 59.4877 20.9275 60.8088 24.9946C63.4946 33.2319 65.1732 41.9599 64.5253 50.6269C64.4393 51.7777 62.7157 51.9821 62.4792 50.8033C60.8299 42.4345 58.9565 34.1181 56.9369 25.8408C55.959 21.8053 54.9256 17.7784 53.8367 13.7601C52.6808 9.51622 50.8214 5.47884 49.7076 1.25038C49.479 0.365176 50.7585 -0.0374784 51.1749 0.725824Z" fill="currentColor"/>
              </svg>
            </span>
          </div>
        </div>
        <div class="col-lg-5 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">
          <form action="#" class="cs_donate_form_1 cs_gray_bg">
            <input class="cs_input_amount" type="text" value="$50" placeholder="Amount..." disabled>
            <div class="cs_fixed_amount_wrap">
              <div class="cs_fixed_amount_item">
                <input class="cs_fixed_amount_check" type="radio" name="fixed_amount" id="fixed_amount_1" value="10">
                <label class="cs_center cs_white_bg" for="fixed_amount_1">$10</label>
              </div>
              <div class="cs_fixed_amount_item">
                <input class="cs_fixed_amount_check" type="radio" name="fixed_amount" id="fixed_amount_2" value="50" checked>
                <label class="cs_center cs_white_bg" for="fixed_amount_2">$50</label>
              </div>
              <div class="cs_fixed_amount_item">
                <input class="cs_fixed_amount_check" type="radio" name="fixed_amount" id="fixed_amount_3" value="100">
                <label class="cs_center cs_white_bg" for="fixed_amount_3">$100</label>
              </div>
              <div class="cs_fixed_amount_item">
                <input class="cs_fixed_amount_check" type="radio" name="fixed_amount" id="fixed_amount_4" value="500">
                <label class="cs_center cs_white_bg" for="fixed_amount_4">$500</label>
              </div>
            </div>
            <button class="cs_custom_amount_btn" type="button">Custom Amount</button>
            <button class="cs_btn cs_style_1 w-100" type="submit">
              Donate Now
              <i>
                <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Donation Cards Slider (subset) -->
  <section class="cs_negative_box_110">
    <div class="cs_slider cs_style_1 cs_slider_gap_24 cs_ptb_12">
      <div class="container">
        <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lg-slides="3" data-add-slides="3">
          <div class="cs_slider_wrapper">
            <div class="cs_slide">
              <div class="cs_card cs_style_2 cs_shadow_1 cs_white_bg">
                <div class="cs_card_thumb"><img src="{{ asset('assets/img/charity/card_img_1.jpg') }}" alt=""></div>
                <div class="cs_card_info">
                  <h2 class="cs_fs_28 cs_mb_11 cs_semibold">Harvesting Hope: Ensuring Food Security for All</h2>
                  <p class="cs_mb_11">Deforestation poses a significant threat to our environment, contributing to climate change and the loss of crucial habitats for...</p>
                  <div class="cs_progress_wrap">
                    <div class="cs_progress" data-progress="70">
                      <div class="cs_progress_in cs_accent_bg"><span>70%</span></div>
                    </div>
                  </div>
                  <div class="cs_progress_heading cs_mb_24">
                    <h3 class="cs_fs_21 cs_semibold mb-0">Goal: $4000</h3>
                    <h3 class="cs_fs_21 cs_semibold mb-0">Raised: $2800</h3>
                  </div>
                  <a href="{{ route('contact') }}" class="cs_btn cs_style_1 w-100">
                    Donate Now
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
            <div class="cs_slide">
              <div class="cs_card cs_style_2 cs_shadow_1 cs_white_bg">
                <div class="cs_card_thumb"><img src="{{ asset('assets/img/charity/card_img_2.jpg') }}" alt=""></div>
                <div class="cs_card_info">
                  <h2 class="cs_fs_28 cs_mb_11 cs_semibold">Nourish to Flourish: Promoting Nutrition Education</h2>
                  <p class="cs_mb_11">Deforestation poses a significant threat to our environment, contributing to climate change and the loss of crucial habitats for...</p>
                  <div class="cs_progress_wrap">
                    <div class="cs_progress" data-progress="78">
                      <div class="cs_progress_in cs_accent_bg"><span>78%</span></div>
                    </div>
                  </div>
                  <div class="cs_progress_heading cs_mb_24">
                    <h3 class="cs_fs_21 cs_semibold mb-0">Goal: $4000</h3>
                    <h3 class="cs_fs_21 cs_semibold mb-0">Raised: $3300</h3>
                  </div>
                  <a href="{{ route('contact') }}" class="cs_btn cs_style_1 w-100">
                    Donate Now
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
    </div>
  </section>
  <!-- End Donation Cards Slider -->
@endsection
