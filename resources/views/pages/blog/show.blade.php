@extends('layouts.app')

@section('title', 'Blog Details')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Blog Details</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Blog Details</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Blog Details Section -->
  <section>
    <div class="cs_height_145 cs_height_lg_75"></div>
    <div class="container">
      <div class="row cs_gap_y_80">
        <div class="col-xl-8">
          <div class="cs_blog_details">
            <img src="{{ asset('assets/img/others/blog_details_1.jpg') }}" alt="Blog">
            <p>A Elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique. Tortor posuere ac ut consequat semper viverra nam libero justo. Mauris commodo quis imperdiet massa tincidunt nunc pulvinar sapien et. Aliquam purus sit amet luctus venenatis lectus magna fringilla urna. Purus sit amet luctus venenatis lectus. Nunc aliquet bibendum enim facilisis. Pretium viverra suspendisse potenti nullam ac tortor vitae. Purus sit amet luctus venenatis lectus. Nunc aliquet bibendum enim facilisis. Pretium viverra suspendisse potenti nullam ac tortor vitae.</p>
            <h2>Ocean pollution is every corner around the world</h2>
            <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best. <br><br>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances.</p>
            <blockquote>
              <svg class="cs_accent_color" width="41" height="37" viewBox="0 0 41 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M37.0872 18.5001H30.707V13.3959C30.707 10.5806 32.9959 8.29175 35.8112 8.29175H36.4492C37.5099 8.29175 38.3633 7.4384 38.3633 6.37769V2.54956C38.3633 1.48885 37.5099 0.635498 36.4492 0.635498H35.8112C28.7611 0.635498 23.0508 6.34578 23.0508 13.3959V32.5365C23.0508 34.65 24.7655 36.3647 26.8789 36.3647H37.0872C39.2007 36.3647 40.9154 34.65 40.9154 32.5365V22.3282C40.9154 20.2148 39.2007 18.5001 37.0872 18.5001ZM14.1185 18.5001H7.73828V13.3959C7.73828 10.5806 10.0272 8.29175 12.8424 8.29175H13.4805C14.5412 8.29175 15.3945 7.4384 15.3945 6.37769V2.54956C15.3945 1.48885 14.5412 0.635498 13.4805 0.635498H12.8424C5.79232 0.635498 0.0820312 6.34578 0.0820312 13.3959V32.5365C0.0820312 34.65 1.79671 36.3647 3.91016 36.3647H14.1185C16.2319 36.3647 17.9466 34.65 17.9466 32.5365V22.3282C17.9466 20.2148 16.2319 18.5001 14.1185 18.5001Z" fill="currentColor"/>
              </svg>
              But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, who expound the actual teachings of the great explorer of the truth, the master. <small>Andrew Hobar</small>
            </blockquote>
            <h2>Stop now throwing plastic on ocean</h2>
            <p>We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances.</p>
            <a href="https://www.youtube.com/embed/rRid6GCJtgc" class="cs_video_block cs_style_1 cs_bg_filed cs_video_open cs_center" data-src="{{ asset('assets/img/others/blog_details_2.jpg') }}">
              <span class="cs_player_btn cs_white_color">
                <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M35 0C15.7004 0 0 15.7004 0 35C0 54.2996 15.7004 70 35 70C54.2996 70 70 54.2996 70 35C70 15.7004 54.2996 0 35 0ZM35 64.1667C18.9175 64.1667 5.83333 51.0825 5.83333 35C5.83333 18.9175 18.9175 5.83333 35 5.83333C51.0825 5.83333 64.1667 18.9175 64.1667 35C64.1667 51.0825 51.0825 64.1667 35 64.1667ZM23.3333 51.4704L52.6167 35L23.3333 18.5296V51.4733V51.4704ZM29.1667 28.5017L40.7167 35L29.1667 41.4983V28.5017Z" fill="currentColor"/>
                </svg>
              </span>
            </a>
            <p>So, blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain amount of people.</p>
            <p>Our Proposed Solution: Our experienced team of web developers and booking system integration experts will collaborate closely with you to design a website that reflects the professionalism of your cleaning services. Our solution will include:</p>
            <ul>
              <li>An intuitive and visually appealing website design.</li>
              <li>Seamless integration of a booking system, allowing customers to schedule appointments effortlessly.</li>
              <li>Responsive design for optimal user experiences across various devices.</li>
              <li>Rigorous testing to ensure the website and booking system perform flawlessly.</li>
              <li>A content management system for easy updates and maintenance.</li>
              <li>Search engine optimization strategies to enhance online visibility.</li>
            </ul>
          </div>
          <div class="cs_height_50 cs_height_lg_50"></div>
          <div class="cs_post_share">
            <div class="cs_categories">
              <a href="#" class="cs_category">Motion</a>
              <a href="#" class="cs_category">Graphic</a>
              <a href="#" class="cs_category">Video</a>
            </div>
            <div class="text-center">
              <div class="cs_social_share_btns">
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>
          <div class="cs_height_50 cs_height_lg_50"></div>
          <div class="cs_author_card">
            <img src="{{ asset('assets/img/others/avatar.png') }}" alt="Author">
            <div>
              <h3 class="cs_fs_21 cs_semibold">Anthony Kuber</h3>
              <p>Hi, my name is Ahon Bentham. I am environmental activist and ocean <br>lover. I love to travel and writing blogging.</p>
              <div class="cs_social_btns cs_style_1">
                <a href="#" class="cs_center">
                  <i class="fa-brands fa-linkedin-in"></i>
                </a>
                <a href="#" class="cs_center">
                  <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="#" class="cs_center">
                  <i class="fa-brands fa-slack"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="cs_height_135 cs_height_lg_70"></div>
          <h2 class="cs_fs_38  cs_semibold cs_mb_10">Write your opinion</h2>
          <p class="cs_mb_34">Your email address will not be published. Required fields are marked *</p>
          <form action="#" class="row cs_gap_y_30">
            <div class="col-lg-12">
              <textarea cols="30" rows="6" class="cs_form_field" placeholder="Write Your Comment*"></textarea>
            </div>
            <div class="col-lg-6">
              <input type="text" class="cs_form_field" placeholder="Your Name*">
            </div>
            <div class="col-lg-6">
              <input type="text" class="cs_form_field" placeholder="Your Email*">
            </div>
            <div class="col-lg-12">
              <button class="cs_btn cs_style_1 cs_type_2 cs_primary_bg cs_white_color" type="submit">
                Post Comment
                <span>
                  <i>
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M1 8.5L8.5 1M8.5 1L1 1M8.5 1L8.5 8.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M1 8.5L8.5 1M8.5 1L1 1M8.5 1L8.5 8.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </i>
                </span>
              </button>
            </div>
          </form>
        </div>
        <div class="col-xl-4"><!-- Sidebar space for future widgets if needed --></div>
      </div>
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End Blog Details Section -->
@endsection
