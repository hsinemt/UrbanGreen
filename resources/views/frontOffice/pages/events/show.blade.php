@extends('frontOffice.layouts.app')
@section('title', 'Event Details')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Event Details</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Event Details</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Event Details Section -->
  <section>
    <div class="cs_height_150 cs_height_lg_80"></div>
    <div class="container">
      <div class="row cs_gap_y_80">
        <div class="col-lg-7">
          <div class="cs_details_content">
            <img src="{{ asset('assets/img/others/event_details_1.jpg') }}" alt="">
            <h2>A Beacon of Knowledge Symposium</h2>
            <p>Embark on a journey of enlightenment with our Learning Lighthouse symposium. This educational event brings together passionate speakers and experts to illuminate the path of knowledge. Join us for insightful discussions, workshops, and interactive sessions designed to empower minds and inspire a lifelong love for learning. Together, let's build a brighter future through education!</p>
            <h3>Agenda:</h3>
            <p>We prioritize products that are made from recycled or renewable materials, are energy-efficient, and have minimal environmental footprints. Our selection process involves assessing the entire lifecycle of each product to ensure it aligns with our commitment to sustainability.</p>
            <h4>1. Keynote Address: "Navigating the Seas of Knowledge"</h4>
            <p>An inspiring talk by <a href="#">Kerua Zoshua</a> on the importance of education as a guiding force in personal and societal development.</p>
            <h4>2. Interactive Workshops</h4>
            <p>Engage in hands-on workshops covering a range of subjects, from STEM activities to arts and literature, tailored for various age groups.</p>
            <h4>3. Panel Discussions: "Shaping Minds, Shaping Futures"</h4>
            <p>Thought-provoking discussions featuring educators, scholars, and industry leaders exploring the role of education in shaping the future of individuals and communities.</p>
            <h4>4. Innovative Teaching Methods Showcase</h4>
            <p>Learn about and experience cutting-edge teaching methods and technologies that enhance the learning experience.</p>
            <h4>5. Student Spotlight: Showcasing Talent and Creativity</h4>
            <p>A platform for students to showcase their talents, projects, and creative endeavors, fostering a sense of achievement and confidence.</p>
            <h4>6. Networking Lunch: Connecting Minds over Meals</h4>
            <p>A casual lunch session providing opportunities for attendees to connect, share ideas, and build networks within the educational community.</p>
            <h4>7. Resource Fair: Explore the Tools of Learning</h4>
            <p>An exhibition featuring educational resources, tools, and technologies aimed at enhancing teaching and learning experiences.</p>
            <h4>8. Closing Ceremony: "Igniting Sparks, Building Futures"</h4>
            <p>A closing ceremony acknowledging participants, highlighting key takeaways, and inspiring a collective commitment to the ongoing journey of education.</p>
            <h3>Registration Information:</h3>
            <p>Registration is free. To secure your spot, please email us <a href="mailto:event@ecozone.com">event@ecozone.com</a> or contact us throw contact form.</p>
            <h3>Join us at Learning Lighthouse Symposium for an inspiring day of education, collaboration, and the celebration of knowledge! Together, let's light up the path to a brighter future through the power of learning.</h3>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="cs_info_card cs_gray_bg">
            <h3 class="cs_fs_28 cs_semibold cs_mb_28">Event Details :</h3>
            <ul class="cs_fs_21 cs_medium cs_heading_font cs_mp_0">
              <li>Speakers : Kerua Zoshua</li>
              <li>Date : 11 Dec 2024</li>
              <li>Time : 08:00 - 09:00</li>
              <li>Location : Arm Stadium, London, UK</li>
            </ul>
          </div>
          <div class="cs_height_50 cs_height_lg_40"></div>
          <div class="cs_form_widget cs_gray_bg">
            <h3 class="cs_form_widget_title cs_fs_28 cs_semibold cs_mb_31">Contact Us :</h3>
            <form action="#">
              <input type="text" class="cs_form_field cs_type_2 cs_mb_20" placeholder="Your Name">
              <input type="text" class="cs_form_field cs_type_2 cs_mb_20" placeholder="Your Email">
              <input type="text" class="cs_form_field cs_type_2 cs_mb_20" placeholder="Mobile Number">
              <textarea rows="4" cols="10" class="cs_form_field cs_type_2 cs_mb_20" placeholder="Type Your Comment"></textarea>
              <button type="submit" class="cs_btn cs_style_1 w-100">
                Contact Now
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
          <div class="cs_height_50 cs_height_lg_40"></div>
          <div class="cs_social_widget cs_gray_bg">
            <h2 class="cs_fs_28 cs_semibold cs_mb_30">Share This Opportunity</h2>
            <div class="cs_social_widget_list">
              <a href="#" class="cs_center"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#" class="cs_center"><i class="fa-brands fa-instagram"></i></a>
              <a href="#" class="cs_center"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="#" class="cs_center"><i class="fa-brands fa-twitter"></i></a>
              <a href="#" class="cs_center"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cs_height_140 cs_height_lg_70"></div>
  </section>
  <!-- End Event Details Section -->
@endsection
