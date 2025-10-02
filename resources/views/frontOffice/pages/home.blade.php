@extends('frontOffice.layouts.app')
@section('title', 'Home')

@section('content')
    <!-- Start Hero Section -->
    <section class="cs_hero cs_style_1 cs_heading_bg cs_center cs_bg_filed" data-src="{{ asset('frontOffice/img/nature/hero_bg.jpg') }}">
        <div class="container">
            <div class="cs_hero_thumb wow fadeIn" data-wow-duration="1s" data-wow-delay="0.25s">
                <div class="cs_hero_thumb_left"><img src="{{asset('frontOffice/img/nature/hero_img_1.jpg')}} "alt="Thumb"></div>
                <div class="cs_hero_thumb_right"><img src="{{asset('frontOffice/img/nature/hero_img_2.jpg')}} " alt="Thumb"></div>
                <div class="cs_rotate_text_box cs_bg_filed cs_center" data-src="{{asset('frontOffice/img/nature/hero_rotate_text_bg.svg')}} ">
                    <img src="{{asset('frontOffice/img/nature/hero_rotate_text.svg')}} " alt="">
                </div>
            </div>
            <div class="cs_slider cs_style_1 cs_slider_gap_24 wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.25s">
                <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="1">
                    <div class="cs_slider_wrapper">
                        <div class="cs_slide">
                            <div class="cs_hero_text">
                                <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_30">Taking Small Strides to Preserve Our Planet</h1>
                                <p class="cs_hero_subtitle cs_white_color cs_mb_37">Ecology, as a field of science, investigates the interconnections between living organisms and their surroundings, encompassing both the physical and chemical aspects.</p>
                                <a href="about.html" class="cs_btn cs_style_1">
                                    Learn More
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
                        <div class="cs_slide">
                            <div class="cs_hero_text">
                                <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_30">Taking Small Strides to Preserve Our Planet</h1>
                                <p class="cs_hero_subtitle cs_white_color cs_mb_37">Ecology, as a field of science, investigates the interconnections between living organisms and their surroundings, encompassing both the physical and chemical aspects.</p>
                                <a href="about.html" class="cs_btn cs_style_1">
                                    Learn More
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
                        <div class="cs_slide">
                            <div class="cs_hero_text">
                                <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_30">Taking Small Strides to Preserve Our Planet</h1>
                                <p class="cs_hero_subtitle cs_white_color cs_mb_37">Ecology, as a field of science, investigates the interconnections between living organisms and their surroundings, encompassing both the physical and chemical aspects.</p>
                                <a href="about.html" class="cs_btn cs_style_1">
                                    Learn More
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
    </section>
    <!-- End Hero Section -->
    <!-- Start Feature Section -->
    <section>
        <div class="cs_height_150 cs_height_lg_80"></div>
        <div class="container">
            <div class="row cs_row_gap_50 cs_gap_y_50">
                <div class="col-lg-4">
                    <div class="cs_iconbox cs_style_1">
                        <div class="cs_iconbox_icon cs_mb_26 cs_mb_lg_20"><img src="assets/frontOffice/img/nature/climate_change_icon.svg" alt=""></div>
                        <h2 class="cs_fs_38 cs_semibold cs_mb_22 cs_mb_lg_15">Climate Change</h2>
                        <p class="mb-0">Discuss the science, impacts, and solutions related to climate change, including global warming, extreme weather events, and the transition to renewable energy sources.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cs_iconbox cs_style_1">
                        <div class="cs_iconbox_icon cs_mb_26 cs_mb_lg_20"><img src="assets/frontOffice/img/nature/sustainable_living.png" alt=""></div>
                        <h2 class="cs_fs_38 cs_semibold cs_mb_22 cs_mb_lg_15">Sustainable Living</h2>
                        <p class="mb-0">Provide tips and information on sustainable practices in areas such as energy conservation, waste reduction, and eco-friendly lifestyle choices.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cs_iconbox cs_style_1">
                        <div class="cs_iconbox_icon cs_mb_26 cs_mb_lg_20"><img src="assets/frontOffice/img/nature/deforestation.svg" alt=""></div>
                        <h2 class="cs_fs_38 cs_semibold cs_mb_22 cs_mb_lg_15">Deforestation</h2>
                        <p class="mb-0">Discuss the impact of deforestation on ecosystems, climate, and biodiversity, as well as reforestation and afforestation efforts.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Feature Section -->
    <!-- Start About Section -->
    <section class="cs_shape_wrap">
        <div class="cs_height_140 cs_height_lg_70"></div>
        <div class="cs_shape cs_shape_position_1"><img src="assets/frontOffice/img/nature/about_shape_1.svg" alt=""></div>
        <div class="container">
            <div class="row align-items-center cs_gap_y_50">
                <div class="col-lg-6 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">
                    <a href="https://www.youtube.com/embed/rRid6GCJtgc" class="cs_video_block cs_style_1 cs_bg_filed cs_video_open cs_center" data-src="assets/frontOffice/img/nature/video_block_bg.jpg">
              <span class="cs_player_btn cs_white_color">
                <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M35 0C15.7004 0 0 15.7004 0 35C0 54.2996 15.7004 70 35 70C54.2996 70 70 54.2996 70 35C70 15.7004 54.2996 0 35 0ZM35 64.1667C18.9175 64.1667 5.83333 51.0825 5.83333 35C5.83333 18.9175 18.9175 5.83333 35 5.83333C51.0825 5.83333 64.1667 18.9175 64.1667 35C64.1667 51.0825 51.0825 64.1667 35 64.1667ZM23.3333 51.4704L52.6167 35L23.3333 18.5296V51.4733V51.4704ZM29.1667 28.5017L40.7167 35L29.1667 41.4983V28.5017Z" fill="currentColor"/>
                </svg>
              </span>
                    </a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.25s">
                    <div class="cs_pl_75">
                        <h3 class="cs_accent_color cs_fs_21 cs_semibold cs_mb_13">About Us</h3>
                        <h2 class="cs_fs_51 cs_mb_29">Creating a Lasting Alliance for a Greener Future</h2>
                        <p class="cs_mb_37">We are passionate advocates for environmental awareness and moral sustainability. Our mission is to empower individuals and community to make positive changes for our planet. We believe that small actions can lead to big transformations, and we're dedicated to providing the knowledge, resources, and inspiration needed.</p>
                        <ul class="cs_list cs_style_1 cs_mp_0">
                            <li>
                                <i class="cs_list_icon cs_accent_color">
                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 9.62275C0.0320847 8.83012 0.390363 8.2499 1.11227 7.93388C1.84487 7.61269 2.54004 7.73702 3.1443 8.25508C4.06406 9.0477 4.96777 9.85587 5.87684 10.6589C6.04796 10.8091 6.21908 10.9645 6.39554 11.1148C6.65757 11.3427 6.88751 11.3323 7.12279 11.0733C9.096 8.91819 11.0639 6.75789 13.0371 4.5976C14.3686 3.13668 15.7054 1.68094 17.037 0.220014C17.2027 0.0386945 17.3952 -0.0493752 17.6412 0.0283334C17.8498 0.0956808 18.0102 0.277001 17.9995 0.494585C17.9941 0.608557 17.946 0.732891 17.8819 0.831322C16.3685 3.19884 14.8552 5.56118 13.3419 7.92352C11.5986 10.6433 9.85534 13.3631 8.11207 16.0881C7.80727 16.5647 7.39551 16.8859 6.81264 16.974C6.15491 17.0776 5.60947 16.8704 5.19237 16.3782C3.69508 14.6116 2.20849 12.8399 0.716557 11.0681C0.433143 10.7469 0.133686 10.4257 0.0534744 9.98539C0.0267372 9.85587 0.0160423 9.73154 0 9.62275Z" fill="currentColor"/>
                                    </svg>
                                </i>
                                <h3 class="cs_fs_28 cs_semibold cs_mb_15">Our Mission</h3>
                                <p class="mb-0">Explain the core purpose of your website, which may be to raise awareness, educate, or inspire positive environmental change.</p>
                            </li>
                            <li>
                                <i class="cs_list_icon cs_accent_color">
                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 9.62275C0.0320847 8.83012 0.390363 8.2499 1.11227 7.93388C1.84487 7.61269 2.54004 7.73702 3.1443 8.25508C4.06406 9.0477 4.96777 9.85587 5.87684 10.6589C6.04796 10.8091 6.21908 10.9645 6.39554 11.1148C6.65757 11.3427 6.88751 11.3323 7.12279 11.0733C9.096 8.91819 11.0639 6.75789 13.0371 4.5976C14.3686 3.13668 15.7054 1.68094 17.037 0.220014C17.2027 0.0386945 17.3952 -0.0493752 17.6412 0.0283334C17.8498 0.0956808 18.0102 0.277001 17.9995 0.494585C17.9941 0.608557 17.946 0.732891 17.8819 0.831322C16.3685 3.19884 14.8552 5.56118 13.3419 7.92352C11.5986 10.6433 9.85534 13.3631 8.11207 16.0881C7.80727 16.5647 7.39551 16.8859 6.81264 16.974C6.15491 17.0776 5.60947 16.8704 5.19237 16.3782C3.69508 14.6116 2.20849 12.8399 0.716557 11.0681C0.433143 10.7469 0.133686 10.4257 0.0534744 9.98539C0.0267372 9.85587 0.0160423 9.73154 0 9.62275Z" fill="currentColor"/>
                                    </svg>
                                </i>
                                <h3 class="cs_fs_28 cs_semibold cs_mb_15">Our Values</h3>
                                <p class="mb-0">Outline the principles and values that guide your work, such as sustainability, scientific accuracy, inclusivity, and the promotion of positive action.</p>
                            </li>
                        </ul>
                        <div class="cs_height_45 cs_height_lg_30"></div>
                        <a href="about.html" class="cs_btn cs_style_1">
                            Learn More
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
        <div class="cs_height_150 cs_height_lg_80"></div>
    </section>
    <!-- End About Section -->
    <!-- Start Services Section -->
    <section class="cs_half_bg_wrap">
        <div class="cs_height_145 cs_height_lg_75"></div>
        <div class="cs_half_bg_top cs_accent_bg cs_bg_filed" data-src="{{asset('frontOffice/img/nature/service_bg.svg')}} "></div>
        <div class="container-fluid">
            <div class="cs_section_heading cs_style_1 text-center">
                <h3 class="cs_fs_21 cs_semibold cs_white_color cs_mb_13 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">Services</h3>
                <h2 class="cs_fs_51 cs_mb_9 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.25s">Our Environmental Services</h2>
                <p class="mb-0 cs_heading_color wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">Discover a range of services aimed at promoting environmental <br>awareness, sustainability, and positive action.</p>
            </div>
            <div class="cs_height_90 cs_height_lg_50"></div>
            <div class="cs_slider cs_style_1 cs_slider_gap_24 cs_ptb_12">
                <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lg-slides="3" data-add-slides="4">
                    <div class="cs_slider_wrapper">
                        <div class="cs_slide">
                            <div class="cs_iconbox cs_style_3 cs_shadow_1 cs_white_bg text-center">
                                <div class="cs_iconbox_icon cs_mb_28"><img src="{{asset('frontOffice/img/nature/service_icon_1.svg')}} " alt=""></div>
                                <h2 class="cs_fs_28 cs_semibold cs_mb_25">Eco-Friendly Product</h2>
                                <p class="cs_mb_20">Share reviews and recommendations for eco friendly products, from energy-efficient appliances to sustainable clothing.</p>
                                <a href="service-details.html" class="cs_btn cs_style_2 cs_heading_color">
                                    Learn More
                                    <i>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </i>
                                </a>
                            </div>
                        </div>
                        <div class="cs_slide">
                            <div class="cs_iconbox cs_style_3 cs_shadow_1 cs_white_bg text-center">
                                <div class="cs_iconbox_icon cs_mb_28"><img src="{{asset('frontOffice/img/nature/service_icon_2.svg')}} "alt=""></div>
                                <h2 class="cs_fs_28 cs_semibold cs_mb_25">Advocacy and Campaigns</h2>
                                <p class="cs_mb_20">Organize and promote environmental campaigns and advocacy efforts, encouraging visitors to take action on important issues.</p>
                                <a href="service-details.html" class="cs_btn cs_style_2 cs_heading_color">
                                    Learn More
                                    <i>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </i>
                                </a>
                            </div>
                        </div>
                        <div class="cs_slide">
                            <div class="cs_iconbox cs_style_3 cs_shadow_1 cs_white_bg text-center">
                                <div class="cs_iconbox_icon cs_mb_28"><img src="{{asset('frontOffice/img/nature/service_icon_3.svg')}} " alt=""></div>
                                <h2 class="cs_fs_28 cs_semibold cs_mb_25">Sustainable Gardening</h2>
                                <p class="cs_mb_20">Offer guidance on sustainable gardening practices, including organic gardening, and water conservation in gardens.</p>
                                <a href="service-details.html" class="cs_btn cs_style_2 cs_heading_color">
                                    Learn More
                                    <i>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </i>
                                </a>
                            </div>
                        </div>
                        <div class="cs_slide">
                            <div class="cs_iconbox cs_style_3 cs_shadow_1 cs_white_bg text-center">
                                <div class="cs_iconbox_icon cs_mb_28"><img src="{{asset('frontOffice/img/nature/service_icon_4.svg')}} "alt=""></div>
                                <h2 class="cs_fs_28 cs_semibold cs_mb_25">Wildlife Saving</h2>
                                <p class="cs_mb_20">Promote and support wildlife conservation programs and encourage donations or volunteer participation.</p>
                                <a href="service-details.html" class="cs_btn cs_style_2 cs_heading_color">
                                    Learn More
                                    <i>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </i>
                                </a>
                            </div>
                        </div>
                        <div class="cs_slide">
                            <div class="cs_iconbox cs_style_3 cs_shadow_1 cs_white_bg text-center">
                                <div class="cs_iconbox_icon cs_mb_28"><img src="{{asset('frontOffice/img/nature/service_icon_2.svg')}} " alt=""></div>
                                <h2 class="cs_fs_28 cs_semibold cs_mb_25">Advocacy and Campaigns</h2>
                                <p class="cs_mb_20">Organize and promote environmental campaigns and advocacy efforts, encouraging visitors to take action on important issues.</p>
                                <a href="service-details.html" class="cs_btn cs_style_2 cs_heading_color">
                                    Learn More
                                    <i>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cs_height_50 cs_height_lg_40"></div>
                <div class="cs_pagination cs_style_2"></div>
            </div>
        </div>
    </section>
    <!-- End Services Section -->
    <!-- Start Funfact  -->
    <div class="cs_height_132 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_funfact_1_list">
            <div class="cs_funfact cs_style_1">
                <h2 class="cs_funfact_number cs_fs_70 mb-0">
                    <span class="odometer" data-count-to="5"></span>K
                </h2>
                <p class="cs_funfact_title mb-0">Local <br>Volunteers</p>
            </div>
            <div class="cs_funfact cs_style_1">
                <h2 class="cs_funfact_number cs_fs_70 mb-0">
                    <span class="odometer" data-count-to="110"></span>M
                </h2>
                <p class="cs_funfact_title mb-0">World Fund <br>Raised</p>
            </div>
            <div class="cs_funfact cs_style_1">
                <h2 class="cs_funfact_number cs_fs_70 mb-0">
                    <span class="odometer" data-count-to="200"></span>+
                </h2>
                <p class="cs_funfact_title mb-0">Project <br>Completed</p>
            </div>
            <div class="cs_funfact cs_style_1">
                <h2 class="cs_funfact_number cs_fs_70 mb-0">
                    <span class="odometer" data-count-to="2"></span>K
                </h2>
                <p class="cs_funfact_title mb-0">World Wide <br>Members</p>
            </div>
        </div>
    </div>
    <div class="cs_height_125 cs_height_lg_60"></div>
    <!-- End Funfact  -->
    <!-- Start Faq Section -->
    <section class="cs_gray_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cs_pr_95">
                        <div class="cs_height_93 cs_height_lg_80"></div>
                        <div class="cs_section_heading cs_style_1">
                            <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13">FAQ</h3>
                            <h2 class="cs_fs_51 mb-0">Have Any Questions?</h2>
                        </div>
                        <div class="cs_height_50 cs_height_lg_50"></div>
                        <div class="cs_accordians cs_style_1">
                            <div class="cs_accordian active">
                                <div class="cs_accordian_head">
                                    <h2 class="cs_accordian_title cs_fs_21 cs_semibold">1. What is the primary goal of this website?</h2>
                                    <span class="cs_accordian_toggle"><i class="fa-solid fa-angle-down"></i></span>
                                </div>
                                <div class="cs_accordian_body">
                                    <p>Our primary goal is to raise awareness about environmental issues, provide educational resources, and inspire positive environmental action.</p>
                                </div>
                            </div><!-- .cs_accordian -->
                            <div class="cs_accordian">
                                <div class="cs_accordian_head">
                                    <h2 class="cs_accordian_title cs_fs_21 cs_semibold">2. How can I support your website's mission?</h2>
                                    <span class="cs_accordian_toggle"><i class="fa-solid fa-angle-down"></i></span>
                                </div>
                                <div class="cs_accordian_body">
                                    <p>Our primary goal is to raise awareness about environmental issues, provide educational resources, and inspire positive environmental action.</p>
                                </div>
                            </div><!-- .cs_accordian -->
                            <div class="cs_accordian">
                                <div class="cs_accordian_head">
                                    <h2 class="cs_accordian_title cs_fs_21 cs_semibold">3. How do you ensure the sustainability of website?</h2>
                                    <span class="cs_accordian_toggle"><i class="fa-solid fa-angle-down"></i></span>
                                </div>
                                <div class="cs_accordian_body">
                                    <p>Our primary goal is to raise awareness about environmental issues, provide educational resources, and inspire positive environmental action.</p>
                                </div>
                            </div><!-- .cs_accordian -->
                            <div class="cs_accordian">
                                <div class="cs_accordian_head">
                                    <h2 class="cs_accordian_title cs_fs_21 cs_semibold">4. How can I get involved in environmental initiatives?</h2>
                                    <span class="cs_accordian_toggle"><i class="fa-solid fa-angle-down"></i></span>
                                </div>
                                <div class="cs_accordian_body">
                                    <p>Our primary goal is to raise awareness about environmental issues, provide educational resources, and inspire positive environmental action.</p>
                                </div>
                            </div><!-- .cs_accordian -->
                        </div>
                        <div class="cs_height_100 cs_height_lg_50"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cs_half_screen_right">
                        <div class="cs_half_screen_thumb cs_bg_filed" data-src="{{asset('frontOffice/img/nature/faq_bg.jpg')}} "></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cs_height_0 cs_height_lg_80"></div>
    </section>
    <!-- End Faq Section -->
    <!-- Start Donation Section -->
    <section>
        <div class="cs_height_145 cs_height_lg_75"></div>
        <div class="container">
            <div class="cs_section_heading cs_style_1 text-center">
                <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">Donation</h3>
                <h2 class="cs_fs_51 mb-0 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.25s">Supporting Our Environmental <br>Fundraising Initiatives</h2>
            </div>
            <div class="cs_height_90 cs_height_lg_50"></div>
        </div>
        <div class="cs_slider cs_style_1 cs_slider_gap_24 cs_ptb_12">
            <div class="container">
                <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="1">
                    <div class="cs_slider_wrapper">
                        <div class="cs_slide">
                            <div class="cs_card cs_style_1 cs_shadow_1">
                                <div class="cs_card_thumb"><img src="{{asset('frontOffice/img/nature/donation_img_1.jpg')}} "alt=""></div>
                                <div class="cs_card_info">
                                    <h2 class="cs_fs_38 cs_mb_20 cs_semibold">Reforestation and Tree Planting Campaign 2024</h2>
                                    <p class="cs_mb_15">Deforestation poses a significant threat to our environment, contributing to climate change and the loss of crucial habitats for countless species. Our campaign focuses on reversing this trend by planting trees...</p>
                                    <div class="cs_progress_wrap">
                                        <div class="cs_progress" data-progress="70">
                                            <div class="cs_progress_in cs_accent_bg"><span>70%</span></div>
                                        </div>
                                    </div>
                                    <div class="cs_progress_heading cs_mb_28">
                                        <h3 class="cs_fs_21 cs_semibold mb-0">Goal: $4000</h3>
                                        <h3 class="cs_fs_21 cs_semibold mb-0">Raised: $2800</h3>
                                    </div>
                                    <a href="contact.html" class="cs_btn cs_style_1 w-100">
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
                        <div class="cs_slide">
                            <div class="cs_card cs_style_1 cs_shadow_1">
                                <div class="cs_card_thumb"><img src="{{asset('frontOffice/img/nature/donation_img_2.jpg')}} " alt=""></div>
                                <div class="cs_card_info">
                                    <h2 class="cs_fs_38 cs_mb_20 cs_semibold">Protecting Endangered Species and Their Habitats</h2>
                                    <p class="cs_mb_15">Deforestation poses a significant threat to our environment, contributing to climate change and the loss of crucial habitats for countless species. Our campaign focuses on reversing this trend by planting trees...</p>
                                    <div class="cs_progress_wrap">
                                        <div class="cs_progress" data-progress="80">
                                            <div class="cs_progress_in cs_accent_bg"><span>80%</span></div>
                                        </div>
                                    </div>
                                    <div class="cs_progress_heading cs_mb_28">
                                        <h3 class="cs_fs_21 cs_semibold mb-0">Goal: $5000</h3>
                                        <h3 class="cs_fs_21 cs_semibold mb-0">Raised: $4500</h3>
                                    </div>
                                    <a href="contact.html" class="cs_btn cs_style_1 w-100">
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
                        <div class="cs_slide">
                            <div class="cs_card cs_style_1 cs_shadow_1">
                                <div class="cs_card_thumb"><img src="{{asset('frontOffice/img/nature/donation_img_3.jpg')}} " alt=""></div>
                                <div class="cs_card_info">
                                    <h2 class="cs_fs_38 cs_mb_20 cs_semibold">Supporting Sustainable Agriculture and Food Security</h2>
                                    <p class="cs_mb_15">Deforestation poses a significant threat to our environment, contributing to climate change and the loss of crucial habitats for countless species. Our campaign focuses on reversing this trend by planting trees...</p>
                                    <div class="cs_progress_wrap">
                                        <div class="cs_progress" data-progress="40">
                                            <div class="cs_progress_in cs_accent_bg"><span>40%</span></div>
                                        </div>
                                    </div>
                                    <div class="cs_progress_heading cs_mb_28">
                                        <h3 class="cs_fs_21 cs_semibold mb-0">Goal: $5000</h3>
                                        <h3 class="cs_fs_21 cs_semibold mb-0">Raised: $1400</h3>
                                    </div>
                                    <a href="contact.html" class="cs_btn cs_style_1 w-100">
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
            </div>
            <div class="cs_slider_arrows cs_style_1">
                <div class="cs_arrow_wrap cs_arrow_wrap_left cs_center">
                    <div class="cs_left_arrow rounded-circle cs_center">
                        <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.292892 7.29289C-0.0976315 7.68342 -0.0976315 8.31658 0.292892 8.70711L6.65685 15.0711C7.04738 15.4616 7.68054 15.4616 8.07107 15.0711C8.46159 14.6805 8.46159 14.0474 8.07107 13.6569L2.41421 8L8.07107 2.34315C8.46159 1.95262 8.46159 1.31946 8.07107 0.928932C7.68054 0.538408 7.04738 0.538408 6.65685 0.928932L0.292892 7.29289ZM22 7L1 7V9L22 9V7Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
                <div class="cs_arrow_wrap cs_arrow_wrap_right cs_center">
                    <div class="cs_right_arrow rounded-circle cs_center">
                        <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.7071 8.70711C22.0976 8.31658 22.0976 7.68342 21.7071 7.29289L15.3431 0.928932C14.9526 0.538408 14.3195 0.538408 13.9289 0.928932C13.5384 1.31946 13.5384 1.95262 13.9289 2.34315L19.5858 8L13.9289 13.6569C13.5384 14.0474 13.5384 14.6805 13.9289 15.0711C14.3195 15.4616 14.9526 15.4616 15.3431 15.0711L21.7071 8.70711ZM0 9L21 9V7L0 7L0 9Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Donation Section -->
    <!-- Start Testimonial Section -->
    <section class="cs_half_bg_wrap">
        <div class="cs_height_145 cs_height_lg_75"></div>
        <div class="cs_half_bg_bottom cs_accent_bg cs_bg_filed" data-src="{{asset('frontOffice/img/nature/testimonial_bg.svg')}} "></div>
        <div class="container">
            <div class="cs_slider cs_style_1 cs_slider_gap_24 cs_ptb_12">
                <div class="cs_slider_heading_1">
                    <div class="cs_section_heading cs_style_1">
                        <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">Testimonial</h3>
                        <h2 class="cs_fs_51 mb-0 wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.25s">What People Think About Us</h2>
                    </div>
                    <div class="cs_pagination cs_style_2 cs_hide_lg"></div>
                </div>
                <div class="cs_height_90 cs_height_lg_50"></div>
                <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="600" data-center="0" data-variable-width="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lg-slides="3" data-add-slides="3">
                    <div class="cs_slider_wrapper">
                        <div class="cs_slide">
                            <div class="cs_testimonial cs_style_1 cs_shadow_1 cs_white_bg">
                                <div class="cs_testimonial_avatar cs_mb_42">
                                    <img src="{{asset('frontOffice/img/nature/avatar_img_1.png')}} " alt="Avatar">
                                    <div class="cs_testimonial_avatar_right">
                                        <h3 class="cs_fs_21 cs_semibold cs_mb_2">Angrew Bolar</h3>
                                        <p class="mb-0 cs_accent_color">Volunteer</p>
                                    </div>
                                </div>
                                <blockquote class="cs_fs_18 cs_mb_45">The resources have been a tremendous help in making my lifestyle more eco-friendly. Plus, the campaigns are a fantastic way to get involved. Keep up the excellent work!</blockquote>
                                <div class="cs_rating cs_accent_color" data-rating="5">
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <div class="cs_rating_percentage">
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cs_slide">
                            <div class="cs_testimonial cs_style_1 cs_shadow_1 cs_white_bg">
                                <div class="cs_testimonial_avatar cs_mb_42">
                                    <img src="{{asset('frontOffice/img/nature/avatar_img_2.png')}} " alt="Avatar">
                                    <div class="cs_testimonial_avatar_right">
                                        <h3 class="cs_fs_21 cs_semibold cs_mb_2">Milisa Geui</h3>
                                        <p class="mb-0 cs_accent_color">Volunteer</p>
                                    </div>
                                </div>
                                <blockquote class="cs_fs_18 cs_mb_45">I particularly appreciate the emphasis on practical tips for sustainable living. It's refreshing to find a place that not only highlights the issues but also provides solutions.</blockquote>
                                <div class="cs_rating cs_accent_color" data-rating="5">
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <div class="cs_rating_percentage">
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cs_slide">
                            <div class="cs_testimonial cs_style_1 cs_shadow_1 cs_white_bg">
                                <div class="cs_testimonial_avatar cs_mb_42">
                                    <img src="{{asset('frontOffice/img/nature/avatar_img_3.png')}} " alt="Avatar">
                                    <div class="cs_testimonial_avatar_right">
                                        <h3 class="cs_fs_21 cs_semibold cs_mb_2">Michaku</h3>
                                        <p class="mb-0 cs_accent_color">Volunteer</p>
                                    </div>
                                </div>
                                <blockquote class="cs_fs_18 cs_mb_45">I love being part of a community that cares about the planet, and this website has been instrumental in connecting me with like-minded individuals. Thank you!</blockquote>
                                <div class="cs_rating cs_accent_color" data-rating="5">
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <div class="cs_rating_percentage">
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cs_slide">
                            <div class="cs_testimonial cs_style_1 cs_shadow_1 cs_white_bg">
                                <div class="cs_testimonial_avatar cs_mb_42">
                                    <img src="{{asset('frontOffice/img/nature/avatar_img_2.png')}} " alt="Avatar">
                                    <div class="cs_testimonial_avatar_right">
                                        <h3 class="cs_fs_21 cs_semibold cs_mb_2">Milisa Geui</h3>
                                        <p class="mb-0 cs_accent_color">Volunteer</p>
                                    </div>
                                </div>
                                <blockquote class="cs_fs_18 cs_mb_45">I particularly appreciate the emphasis on practical tips for sustainable living. It's refreshing to find a place that not only highlights the issues but also provides solutions.</blockquote>
                                <div class="cs_rating cs_accent_color" data-rating="5">
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <div class="cs_rating_percentage">
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cs_slider_arrows cs_style_3 cs_type_1 cs_show_lg">
                    <div class="cs_left_arrow rounded-circle cs_center">
                        <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.292892 7.29289C-0.0976315 7.68342 -0.0976315 8.31658 0.292892 8.70711L6.65685 15.0711C7.04738 15.4616 7.68054 15.4616 8.07107 15.0711C8.46159 14.6805 8.46159 14.0474 8.07107 13.6569L2.41421 8L8.07107 2.34315C8.46159 1.95262 8.46159 1.31946 8.07107 0.928932C7.68054 0.538408 7.04738 0.538408 6.65685 0.928932L0.292892 7.29289ZM22 7L1 7V9L22 9V7Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="cs_right_arrow rounded-circle cs_center">
                        <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.7071 8.70711C22.0976 8.31658 22.0976 7.68342 21.7071 7.29289L15.3431 0.928932C14.9526 0.538408 14.3195 0.538408 13.9289 0.928932C13.5384 1.31946 13.5384 1.95262 13.9289 2.34315L19.5858 8L13.9289 13.6569C13.5384 14.0474 13.5384 14.6805 13.9289 15.0711C14.3195 15.4616 14.9526 15.4616 15.3431 15.0711L21.7071 8.70711ZM0 9L21 9V7L0 7L0 9Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="cs_height_150 cs_height_lg_80"></div>
    </section>
    <!-- End Testimonial Section -->
    <!-- Start Team Section -->
    <section class="cs_shape_wrap">
        <div class="cs_height_145 cs_height_lg_75"></div>
        <div class="cs_shape cs_shape_position_2"><img src="{{asset('frontOffice/img/nature/about_shape_1.svg')}} " alt=""></div>
        <div class="cs_shape cs_shape_position_3"><img src="{{asset('frontOffice/img/nature/about_shape_2.svg')}} " alt=""></div>
        <div class="container">
            <div class="cs_section_heading cs_style_1 text-center">
                <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">Our Team</h3>
                <h2 class="cs_fs_51 mb-0 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.25s">Meet Our Dedicated Environmental <br>Advocates and Experts</h2>
            </div>
            <div class="cs_height_90 cs_height_lg_50"></div>
            <div class="row cs_gap_y_50 cs_row_gap_60">
                <div class="col-lg-6">
                    <div class="cs_team cs_style_1">
                        <div class="cs_team_thumb"><img src="{{asset('frontOffice/img/nature/team_member_1.jpg')}} " alt=""></div>
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
                        <div class="cs_team_thumb"><img src="{{asset('frontOffice/img/nature/team_member_2.jpg')}} " alt=""></div>
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
                        <div class="cs_team_thumb"><img src="{{asset('frontOffice/img/nature/team_member_3.jpg')}} " alt=""></div>
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
                        <div class="cs_team_thumb"><img src="{{asset('frontOffice/img/nature/team_member_4.jpg')}} " alt=""></div>
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
            </div>
        </div>
        <div class="cs_height_150 cs_height_lg_80"></div>
    </section>
    <!-- End Team Section -->
    <!-- Start CTA Section -->
    <section class="cs_bg_filed text-center" data-src="{{asset('frontOffice/img/nature/cta_bg.jpg')}} ">
        <div class="cs_height_140 cs_height_lg_75"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <h2 class="cs_white_color cs_fs_51 cs_mb_50 cs_mb_lg_40">Enter the Realm of Environmental Preservation Together, We Make a Difference</h2>
                    <a href="contact.html" class="cs_btn cs_style_1 wow fadeInDown" data-wow-duration="0.8s" data-wow-delay="0.25s">
                        Become A Volunteer
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
        <div class="cs_height_150 cs_height_lg_80"></div>
    </section>
    <!-- End CTA Section -->
    <!-- Start Blog Section -->
{{--    <section class="cs_shape_wrap">--}}
{{--        <div class="cs_height_145 cs_height_lg_75"></div>--}}
{{--        <div class="cs_shape cs_shape_position_4"><img src="{{asset('frontOffice/img/nature/blog_shape_1.png')}} " alt=""></div>--}}
{{--        <div class="cs_shape cs_shape_position_5"><img src="{{asset('frontOffice/img/nature/blog_shape_2.png')}} " alt=""></div>--}}
{{--        <div class="container">--}}
{{--            <div class="cs_section_heading cs_style_1 text-center">--}}
{{--                <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">Blog Post</h3>--}}
{{--                <h2 class="cs_fs_51 mb-0 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.25s">Our Latest News & Updates</h2>--}}
{{--            </div>--}}
{{--            <div class="cs_height_90 cs_height_lg_50"></div>--}}
{{--            <div class="row cs_gap_y_40">--}}
{{--                <div class="col-lg-4">--}}
{{--                    <div class="cs_post cs_style_1">--}}
{{--                        <a href="blog-details.html" class="cs_post_thumb">--}}
{{--                            <img src="{{asset('frontOffice/img/nature/post_img_1.jpg')}} " alt="Post">--}}
{{--                        </a>--}}
{{--                        <div class="cs_post_info cs_shadow_1">--}}
{{--                            <ul class="cs_post_meta cs_mp_0">--}}
{{--                                <li><i class="fa-solid fa-user-pen"></i>Bob marline</li>--}}
{{--                                <li><i class="fa-solid fa-tag"></i>Environment</li>--}}
{{--                            </ul>--}}
{{--                            <h2 class="cs_post_title cs_semibold cs_fs_28 cs_mb_22"><a href="blog-details.html">How Reforestation Can Save Our Planet</a></h2>--}}
{{--                            <p class="cs_post_subtitle cs_mb_16">Discover the incredible impact of reforest on our environment and the critical role trees play in mitigating climate...</p>--}}
{{--                            <a href="blog-details.html" class="cs_btn cs_style_2 cs_heading_color">--}}
{{--                                Learn More--}}
{{--                                <i>--}}
{{--                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                    </svg>--}}
{{--                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                    </svg>--}}
{{--                                </i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4">--}}
{{--                    <div class="cs_post cs_style_1">--}}
{{--                        <a href="blog-details.html" class="cs_post_thumb">--}}
{{--                            <img src="{{asset('frontOffice/img/nature/post_img_2.jpg')}} " alt="Post">--}}
{{--                        </a>--}}
{{--                        <div class="cs_post_info cs_shadow_1">--}}
{{--                            <ul class="cs_post_meta cs_mp_0">--}}
{{--                                <li><i class="fa-solid fa-user-pen"></i>Bob marline</li>--}}
{{--                                <li><i class="fa-solid fa-tag"></i>Environment</li>--}}
{{--                            </ul>--}}
{{--                            <h2 class="cs_post_title cs_semibold cs_fs_28 cs_mb_22"><a href="blog-details.html">Unmasking the Hidden Threat to Our Oceans</a></h2>--}}
{{--                            <p class="cs_post_subtitle cs_mb_16">Dive into the disturbing reality of plastic pollution in our oceans. This blog sheds light on the consequences of single...</p>--}}
{{--                            <a href="blog-details.html" class="cs_btn cs_style_2 cs_heading_color">--}}
{{--                                Learn More--}}
{{--                                <i>--}}
{{--                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                    </svg>--}}
{{--                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                    </svg>--}}
{{--                                </i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4">--}}
{{--                    <div class="cs_post cs_style_1">--}}
{{--                        <a href="blog-details.html" class="cs_post_thumb">--}}
{{--                            <img src="{{asset('frontOffice/img/nature/post_img_3.jpg')}} " alt="Post">--}}
{{--                        </a>--}}
{{--                        <div class="cs_post_info cs_shadow_1">--}}
{{--                            <ul class="cs_post_meta cs_mp_0">--}}
{{--                                <li><i class="fa-solid fa-user-pen"></i>Bob marline</li>--}}
{{--                                <li><i class="fa-solid fa-tag"></i>Environment</li>--}}
{{--                            </ul>--}}
{{--                            <h2 class="cs_post_title cs_semibold cs_fs_28 cs_mb_22"><a href="blog-details.html">Tips for Sustainable Green Spaces in Home</a></h2>--}}
{{--                            <p class="cs_post_subtitle cs_mb_16">Discover the incredible impact of reforest on our environment and the critical role trees play in mitigating climate...</p>--}}
{{--                            <a href="blog-details.html" class="cs_btn cs_style_2 cs_heading_color">--}}
{{--                                Learn More--}}
{{--                                <i>--}}
{{--                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                    </svg>--}}
{{--                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <path d="M1 9L9 1M9 1L1 1M9 1L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                    </svg>--}}
{{--                                </i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="cs_height_150 cs_height_lg_80"></div>--}}
{{--    </section>--}}
    <!-- End Blog Section -->
@endsection
