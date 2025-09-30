@extends('layouts.app')

@section('title', 'Project Details')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Project Details</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Project Details</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Project Details -->
  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <div class="cs_details_content">
      <img src="{{ asset('assets/img/others/project_details_1.jpg') }}" alt="" class="cs_mb_40">
      <h2>Sustainable Cities Blueprint - Transforming Urban Landscapes</h2>
      <p>Welcome to our groundbreaking initiative, "Sustainable Cities Blueprint." In the face of urbanization and climate challenges, we are committed to redefining the future of cities. This project is a comprehensive strategy to transform urban landscapes into sustainable, resilient, and eco-friendly hubs.</p>
      <h2 class="cs_details_content_title">Objectives</h2>
      <div class="row cs_mb_40">
        <div class="col-lg-6">
          <ul class="cs_list cs_style_2 cs_mp_0">
            <li>
              <span class="cs_list_number cs_fs_70 cs_bold cs_heading_font">01</span>
              <div class="cs_list_right">
                <h3 class="cs_fs_28 cs_semibold cs_mb_10">Green Infrastructure Development</h3>
                <p class="mb-0">Implementing green roofs, urban forests, and sustainable public spaces to enhance biodiversity and improve air quality.</p>
              </div>
            </li>
            <li>
              <span class="cs_list_number cs_fs_70 cs_bold cs_heading_font">02</span>
              <div class="cs_list_right">
                <h3 class="cs_fs_28 cs_semibold cs_mb_10">Renewable Energy Integration</h3>
                <p class="mb-0">Advancing the use of renewable energy sources within urban areas, with a focus on solar, wind, and innovative technologies.</p>
              </div>
            </li>
            <li>
              <span class="cs_list_number cs_fs_70 cs_bold cs_heading_font">03</span>
              <div class="cs_list_right">
                <h3 class="cs_fs_28 cs_semibold cs_mb_10">Sustainable Transportation Solutions</h3>
                <p class="mb-0">Promoting eco-friendly modes of transportation, such as cycling lanes, electric vehicles, and efficient public transit systems.</p>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-lg-6">
          <ul class="cs_list cs_style_2 cs_mp_0">
            <li>
              <span class="cs_list_number cs_fs_70 cs_bold cs_heading_font">04</span>
              <div class="cs_list_right">
                <h3 class="cs_fs_28 cs_semibold cs_mb_10">Waste Management Innovation</h3>
                <p class="mb-0">Introducing cutting-edge waste reduction and recycling programs to minimize urban waste and promote a circular economy.</p>
              </div>
            </li>
            <li>
              <span class="cs_list_number cs_fs_70 cs_bold cs_heading_font">05</span>
              <div class="cs_list_right">
                <h3 class="cs_fs_28 cs_semibold cs_mb_10">Renewable Energy Integration</h3>
                <p class="mb-0">Launching educational programs to raise awareness about sustainable practices in urban development.</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <img src="{{ asset('assets/img/others/project_details_2.jpg') }}" alt="">
        </div>
        <div class="col-sm-6">
          <img src="{{ asset('assets/img/others/project_details_3.jpg') }}" alt="">
        </div>
      </div>
      <h2 class="cs_details_content_title">Progress and Achievements</h2>
      <ul>
        <li>Successfully implemented green spaces in Ohio, resulting in a [percentage] increase in urban greenery.</li>
        <li>Installed 500 solar panels, contributing to a 30% reduction in carbon emissions within the city.</li>
        <li>Initiated the "Green Commute" campaign, leading to a 40% increase in the use of eco-friendly transportation options.</li>
      </ul>
      <h2 class="cs_details_content_title">Get Involved</h2>
      <p>Get Involved: Join us in building a sustainable future for our cities! Whether you're a resident, business owner, or city planner, there are various ways to contribute:</p>
      <ul>
        <li>Participate in community events and workshops.</li>
        <li>Share your ideas for sustainable urban development.</li>
        <li>Support our initiatives through volunteering or donations.</li>
      </ul>
      <p>Together, we can create cities that thrive in harmony with nature, setting an example for a sustainable and resilient future. Thank you for being a part of the Sustainable Cities Blueprint project!</p>
    </div>
  </div>
  <div class="cs_height_140 cs_height_lg_70"></div>
@endsection
