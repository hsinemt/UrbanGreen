@extends('frontOffice.layouts.app')
@section('title', 'Gallery')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="assets/img/page_heading_bg.jpg">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Gallery</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Gallery</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Gallery Section -->
  <section>
    <div class="cs_height_145 cs_height_lg_75"></div>
    <div class="container">
      <div class="cs_section_heading cs_style_1 text-center">
        <h3 class="cs_fs_21 cs_semibold cs_accent_color cs_mb_13">Photo Gallery</h3>
        <h2 class="cs_fs_51 mb-0">A Visual Journey through Marine <br>Life Conservation</h2>
      </div>
      <div class="cs_height_90 cs_height_lg_50"></div>
    </div>
    <div class="container-fluid p-0">
      <div class="cs_gallery_list cs_style_1">
        <a href="assets/img/ocean-life/gallery_img_1.jpg" class="cs_gallery_item">
          <img src="assets/img/ocean-life/gallery_img_1.jpg" alt="">
          <div class="cs_gallery_hover cs_center">
            <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g>
              <path d="M55.5833 26.5833H31.4167V2.41667C31.4167 1.77573 31.1621 1.16104 30.7088 0.707825C30.2556 0.254612 29.6409 0 29 0C28.3591 0 27.7444 0.254612 27.2912 0.707825C26.8379 1.16104 26.5833 1.77573 26.5833 2.41667V26.5833H2.41667C1.77573 26.5833 1.16104 26.8379 0.707825 27.2912C0.254612 27.7444 0 28.3591 0 29C0 29.6409 0.254612 30.2556 0.707825 30.7088C1.16104 31.1621 1.77573 31.4167 2.41667 31.4167H26.5833V55.5833C26.5833 56.2243 26.8379 56.839 27.2912 57.2922C27.7444 57.7454 28.3591 58 29 58C29.6409 58 30.2556 57.7454 30.7088 57.2922C31.1621 56.839 31.4167 56.2243 31.4167 55.5833V31.4167H55.5833C56.2243 31.4167 56.839 31.1621 57.2922 30.7088C57.7454 30.2556 58 29.6409 58 29C58 28.3591 57.7454 27.7444 57.2922 27.2912C56.839 26.8379 56.2243 26.5833 55.5833 26.5833Z" fill="white"/>
              </g>
              <defs>
              <clipPath>
              <rect width="58" height="58" fill="white"/>
              </clipPath>
              </defs>
            </svg>
          </div>
        </a>
        <a href="assets/img/ocean-life/gallery_img_2.jpg" class="cs_gallery_item">
          <img src="assets/img/ocean-life/gallery_img_2.jpg" alt="">
          <div class="cs_gallery_hover cs_center">
            <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g>
              <path d="M55.5833 26.5833H31.4167V2.41667C31.4167 1.77573 31.1621 1.16104 30.7088 0.707825C30.2556 0.254612 29.6409 0 29 0C28.3591 0 27.7444 0.254612 27.2912 0.707825C26.8379 1.16104 26.5833 1.77573 26.5833 2.41667V26.5833H2.41667C1.77573 26.5833 1.16104 26.8379 0.707825 27.2912C0.254612 27.7444 0 28.3591 0 29C0 29.6409 0.254612 30.2556 0.707825 30.7088C1.16104 31.1621 1.77573 31.4167 2.41667 31.4167H26.5833V55.5833C26.5833 56.2243 26.8379 56.839 27.2912 57.2922C27.7444 57.7454 28.3591 58 29 58C29.6409 58 30.2556 57.7454 30.7088 57.2922C31.1621 56.839 31.4167 56.2243 31.4167 55.5833V31.4167H55.5833C56.2243 31.4167 56.839 31.1621 57.2922 30.7088C57.7454 30.2556 58 29.6409 58 29C58 28.3591 57.7454 27.7444 57.2922 27.2912C56.839 26.8379 56.2243 26.5833 55.5833 26.5833Z" fill="white"/>
              </g>
              <defs>
              <clipPath>
              <rect width="58" height="58" fill="white"/>
              </clipPath>
              </defs>
            </svg>
          </div>
        </a>
        <a href="assets/img/ocean-life/gallery_img_3.jpg" class="cs_gallery_item">
          <img src="assets/img/ocean-life/gallery_img_3.jpg" alt="">
          <div class="cs_gallery_hover cs_center">
            <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g>
              <path d="M55.5833 26.5833H31.4167V2.41667C31.4167 1.77573 31.1621 1.16104 30.7088 0.707825C30.2556 0.254612 29.6409 0 29 0C28.3591 0 27.7444 0.254612 27.2912 0.707825C26.8379 1.16104 26.5833 1.77573 26.5833 2.41667V26.5833H2.41667C1.77573 26.5833 1.16104 26.8379 0.707825 27.2912C0.254612 27.7444 0 28.3591 0 29C0 29.6409 0.254612 30.2556 0.707825 30.7088C1.16104 31.1621 1.77573 31.4167 2.41667 31.4167H26.5833V55.5833C26.5833 56.2243 26.8379 56.839 27.2912 57.2922C27.7444 57.7454 28.3591 58 29 58C29.6409 58 30.2556 57.7454 30.7088 57.2922C31.1621 56.839 31.4167 56.2243 31.4167 55.5833V31.4167H55.5833C56.2243 31.4167 56.839 31.1621 57.2922 30.7088C57.7454 30.2556 58 29.6409 58 29C58 28.3591 57.7454 27.7444 57.2922 27.2912C56.839 26.8379 56.2243 26.5833 55.5833 26.5833Z" fill="white"/>
              </g>
              <defs>
              <clipPath>
              <rect width="58" height="58" fill="white"/>
              </clipPath>
              </defs>
            </svg>
          </div>
        </a>
        <a href="assets/img/ocean-life/gallery_img_4.jpg" class="cs_gallery_item">
          <img src="assets/img/ocean-life/gallery_img_4.jpg" alt="">
          <div class="cs_gallery_hover cs_center">
            <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g>
              <path d="M55.5833 26.5833H31.4167V2.41667C31.4167 1.77573 31.1621 1.16104 30.7088 0.707825C30.2556 0.254612 29.6409 0 29 0C28.3591 0 27.7444 0.254612 27.2912 0.707825C26.8379 1.16104 26.5833 1.77573 26.5833 2.41667V26.5833H2.41667C1.77573 26.5833 1.16104 26.8379 0.707825 27.2912C0.254612 27.7444 0 28.3591 0 29C0 29.6409 0.254612 30.2556 0.707825 30.7088C1.16104 31.1621 1.77573 31.4167 2.41667 31.4167H26.5833V55.5833C26.5833 56.2243 26.8379 56.839 27.2912 57.2922C27.7444 57.7454 28.3591 58 29 58C29.6409 58 30.2556 57.7454 30.7088 57.2922C31.1621 56.839 31.4167 56.2243 31.4167 55.5833V31.4167H55.5833C56.2243 31.4167 56.839 31.1621 57.2922 30.7088C57.7454 30.2556 58 29.6409 58 29C58 28.3591 57.7454 27.7444 57.2922 27.2912C56.839 26.8379 56.2243 26.5833 55.5833 26.5833Z" fill="white"/>
              </g>
              <defs>
              <clipPath>
              <rect width="58" height="58" fill="white"/>
              </clipPath>
              </defs>
            </svg>
          </div>
        </a>
        <a href="assets/img/ocean-life/gallery_img_5.jpg" class="cs_gallery_item">
          <img src="assets/img/ocean-life/gallery_img_5.jpg" alt="">
          <div class="cs_gallery_hover cs_center">
            <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g>
              <path d="M55.5833 26.5833H31.4167V2.41667C31.4167 1.77573 31.1621 1.16104 30.7088 0.707825C30.2556 0.254612 29.6409 0 29 0C28.3591 0 27.7444 0.254612 27.2912 0.707825C26.8379 1.16104 26.5833 1.77573 26.5833 2.41667V26.5833H2.41667C1.77573 26.5833 1.16104 26.8379 0.707825 27.2912C0.254612 27.7444 0 28.3591 0 29C0 29.6409 0.254612 30.2556 0.707825 30.7088C1.16104 31.1621 1.77573 31.4167 2.41667 31.4167H26.5833V55.5833C26.5833 56.2243 26.8379 56.839 27.2912 57.2922C27.7444 57.7454 28.3591 58 29 58C29.6409 58 30.2556 57.7454 30.7088 57.2922C31.1621 56.839 31.4167 56.2243 31.4167 55.5833V31.4167H55.5833C56.2243 31.4167 56.839 31.1621 57.2922 30.7088C57.7454 30.2556 58 29.6409 58 29C58 28.3591 57.7454 27.7444 57.2922 27.2912C56.839 26.8379 56.2243 26.5833 55.5833 26.5833Z" fill="white"/>
              </g>
              <defs>
              <clipPath>
              <rect width="58" height="58" fill="white"/>
              </clipPath>
              </defs>
            </svg>
          </div>
        </a>
        <a href="assets/img/ocean-life/gallery_img_6.jpg" class="cs_gallery_item">
          <img src="assets/img/ocean-life/gallery_img_6.jpg" alt="">
          <div class="cs_gallery_hover cs_center">
            <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g>
              <path d="M55.5833 26.5833H31.4167V2.41667C31.4167 1.77573 31.1621 1.16104 30.7088 0.707825C30.2556 0.254612 29.6409 0 29 0C28.3591 0 27.7444 0.254612 27.2912 0.707825C26.8379 1.16104 26.5833 1.77573 26.5833 2.41667V26.5833H2.41667C1.77573 26.5833 1.16104 26.8379 0.707825 27.2912C0.254612 27.7444 0 28.3591 0 29C0 29.6409 0.254612 30.2556 0.707825 30.7088C1.16104 31.1621 1.77573 31.4167 2.41667 31.4167H26.5833V55.5833C26.5833 56.2243 26.8379 56.839 27.2912 57.2922C27.7444 57.7454 28.3591 58 29 58C29.6409 58 30.2556 57.7454 30.7088 57.2922C31.1621 56.839 31.4167 56.2243 31.4167 55.5833V31.4167H55.5833C56.2243 31.4167 56.839 31.1621 57.2922 30.7088C57.7454 30.2556 58 29.6409 58 29C58 28.3591 57.7454 27.7444 57.2922 27.2912C56.839 26.8379 56.2243 26.5833 55.5833 26.5833Z" fill="white"/>
              </g>
              <defs>
              <clipPath>
              <rect width="58" height="58" fill="white"/>
              </clipPath>
              </defs>
            </svg>
          </div>
        </a>
        <!-- Additional gallery items would continue here; keeping representative subset for brevity -->
      </div>
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
  </section>
  <!-- End Gallery Section -->
@endsection
