@extends('frontOffice.layouts.app')
@section('title', 'Campaign Details')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('frontOffice/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Campaign Details</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Campaign Details</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Campaing Details -->
  <section>
    <div class="cs_height_150 cs_height_lg_80"></div>
    <div class="container">
      <div class="row cs_gap_y_80">
        <div class="col-lg-7">
          <div class="cs_details_content">
            <img src="{{ asset('frontOffice/img/others/campaing_details_1.jpg') }}" alt="">
            <h2>Reforestation and Tree Planting Campaign 2024</h2>
            <p>Join us in our ambitious Reforestation and Tree Planting Campaign as we embark on a mission to revitalize our ecosystems and combat climate change. The year 2024 marks a pivotal moment in our commitment to environmental restoration, and we invite you to be a key participant in this transformative initiative.</p>
            <h3>Campaign Goals:</h3>
            <p>We prioritize products that are made from recycled or renewable materials, are energy-efficient, and have minimal environmental footprints. Our selection process involves assessing the entire lifecycle of each product to ensure it aligns with our commitment to sustainability.</p>
            <h4>1. Planting Targets</h4>
            <p>Our goal is to plant thousand of trees across the europe by the end of 2024. Each tree planted contributes to carbon sequestration, biodiversity enhancement, and the restoration of vital ecosystems.</p>
            <h4>2. Community Engagement</h4>
            <p>Foster a sense of environmental stewardship by engaging local communities, schools, and organizations in tree planting events, workshops, and awareness campaigns.</p>
            <h4>3. Biodiversity Conservation</h4>
            <p>Prioritize the planting of native tree species to support local biodiversity, create habitats for wildlife, and strengthen the resilience of natural ecosystems.</p>
            <h3>How You Can Contribute:</h3>
            <p>Contribute to the campaign by sponsoring the planting of one or more trees. Your sponsorship covers the cost of saplings, planting materials, and ongoing care. Participate in tree planting events and community workshops to actively contribute to the campaign on the ground. Check our events calendar for upcoming opportunities. Raise awareness about the campaign by sharing our posts on social media, using our campaign hashtags, and encouraging friends and family to join the movement.</p>
            <h3>Impact and Progress Tracking:</h3>
            <p>Stay updated on the campaign's progress through our interactive online tracker. We'll regularly share updates on the number of trees planted, community involvement, and the positive environmental impact achieved.</p>
            <h3>Celebrating Success:</h3>
            <p>As the campaign progresses, we'll highlight success stories, showcase community efforts, and express gratitude to sponsors and volunteers who have played a pivotal role in making the Reforestation and Tree Planting Campaign a resounding success.</p>
            <h3>Together, let's make 2024 a landmark year for environmental restoration. Join the Reforestation and Tree Planting Campaign today and leave a lasting legacy for future generations.</h3>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="cs_progress_widget cs_gray_bg">
            <div class="cs_round_progress_wrap">
              <div class="cs_round_progress_in">
                <div class="cs_round_progress_number mb-0 cs_semibold cs_fs_51">
                  <span data-count-to="75" class="odometer"></span>%
                </div>
              </div>
              <div class="cs_round_progress cs_accent_color">
                <svg class="cs_round_progress_percentage" viewbox="0 0 100 100" width="163" height="163" data-percent="75"><circle cx="50" cy="50" r="40" /></svg>
              </div>
            </div>
            <h3 class="cs_progress_widget_info cs_fs_21 cs_semibold">
              <span>Goal : $4000</span>
              <span>Raised : $2800</span>
            </h3>
          </div>
          <div class="cs_height_50 cs_height_lg_40"></div>
          <form action="#" class="cs_donate_form_1 cs_gray_bg cs_donate_widget">
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
            <div class="cs_height_23 cs_height_lg_23"></div>
            <h3 class="cs_semibold cs_mb_30">Personal Info</h3>
            <input type="text" class="cs_donate_input cs_mb_20" placeholder="Your name">
            <input type="text" class="cs_donate_input cs_mb_20" placeholder="Email Address">
            <input type="text" class="cs_donate_input cs_mb_30" placeholder="Mobile Number">
            <h4 class="cs_fs_21 cs_semibold cs_mb_27">Total Donation: <span class="cs_accent_color">$50</span></h4>
            <button class="cs_btn cs_style_1 w-100" type="submit">
              Donate Now
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
          <div class="cs_height_50 cs_height_lg_40"></div>
          <div class="cs_social_widget cs_gray_bg">
            <h2 class="cs_fs_28 cs_semibold cs_mb_30">Share This Opportunity</h2>
            <div class="cs_social_widget_list">
              <a href="#" class="cs_center"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#" class="cs_center"><i class="fa-brands fa-twitter"></i></a>
              <a href="#" class="cs_center"><i class="fa-brands fa-pinterest-p"></i></a>
              <a href="#" class="cs_center"><i class="fa-brands fa-instagram"></i></a>
              <a href="#" class="cs_center"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End Campaing Details -->
@endsection
