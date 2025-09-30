@extends('layouts.app')

@section('title', 'Team')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="assets/img/page_heading_bg.jpg">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Team</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Team</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Team Section -->
  <section class="cs_shape_wrap">
    <div class="cs_height_145 cs_height_lg_75"></div>
    <div class="cs_shape cs_shape_position_2"><img src="assets/img/nature/about_shape_1.svg" alt=""></div>
    <div class="cs_shape cs_shape_position_3"><img src="assets/img/nature/about_shape_2.svg" alt=""></div>
    <div class="container">
      <div class="cs_section_heading cs_style_1 text-center">
        <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13">Our Team</h3>
        <h2 class="cs_fs_51 mb-0">Meet Our Dedicated Environmental <br>Advocates and Experts</h2>
      </div>
      <div class="cs_height_90 cs_height_lg_50"></div>
      <div class="row cs_gap_y_50 cs_row_gap_60">
        <div class="col-lg-6">
          <div class="cs_team cs_style_1">
            <div class="cs_team_thumb"><img src="assets/img/nature/team_member_1.jpg" alt=""></div>
            <div class="cs_team_right">
              <p class="text-uppercase cs_accent_color cs_mb_1">CEO FOUNDER</p>
              <h3 class="cs_fs_38 cs_mb_18">Jhon Beboral</h3>
              <hr class="cs_mb_12">
              <p class="cs_mb_20">Team component built to improve trust and culture within your.</p>
              <div class="cs_team_social_list cs_heading_color">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="cs_team cs_style_1">
            <div class="cs_team_thumb"><img src="assets/img/nature/team_member_2.jpg" alt=""></div>
            <div class="cs_team_right">
              <p class="text-uppercase cs_accent_color cs_mb_1">VOLUNTEER</p>
              <h3 class="cs_fs_38 cs_mb_18">Peter Dobar</h3>
              <hr class="cs_mb_12">
              <p class="cs_mb_20">Team component built to improve trust and culture within your.</p>
              <div class="cs_team_social_list cs_heading_color">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="cs_team cs_style_1">
            <div class="cs_team_thumb"><img src="assets/img/nature/team_member_3.jpg" alt=""></div>
            <div class="cs_team_right">
              <p class="text-uppercase cs_accent_color cs_mb_1">MANAGER</p>
              <h3 class="cs_fs_38 cs_mb_18">Jubena Lili</h3>
              <hr class="cs_mb_12">
              <p class="cs_mb_20">Team component built to improve trust and culture within your.</p>
              <div class="cs_team_social_list cs_heading_color">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="cs_team cs_style_1">
            <div class="cs_team_thumb"><img src="assets/img/nature/team_member_4.jpg" alt=""></div>
            <div class="cs_team_right">
              <p class="text-uppercase cs_accent_color cs_mb_1">VOLUNTEER</p>
              <h3 class="cs_fs_38 cs_mb_18">Zixan Bony</h3>
              <hr class="cs_mb_12">
              <p class="cs_mb_20">Team component built to improve trust and culture within your.</p>
              <div class="cs_team_social_list cs_heading_color">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="cs_team cs_style_1">
            <div class="cs_team_thumb"><img src="assets/img/nature/team_member_5.jpg" alt=""></div>
            <div class="cs_team_right">
              <p class="text-uppercase cs_accent_color cs_mb_1">Activist</p>
              <h3 class="cs_fs_38 cs_mb_18">Pual Mendary</h3>
              <hr class="cs_mb_12">
              <p class="cs_mb_20">Team component built to improve trust and culture within your.</p>
              <div class="cs_team_social_list cs_heading_color">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="cs_team cs_style_1">
            <div class="cs_team_thumb"><img src="assets/img/nature/team_member_6.jpg" alt=""></div>
            <div class="cs_team_right">
              <p class="text-uppercase cs_accent_color cs_mb_1">Volunteer</p>
              <h3 class="cs_fs_38 cs_mb_18">Monica Hars</h3>
              <hr class="cs_mb_12">
              <p class="cs_mb_20">Team component built to improve trust and culture within your.</p>
              <div class="cs_team_social_list cs_heading_color">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End Team Section -->
@endsection
