@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Product Details</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Product Details</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Product Details -->
  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="cs_single_product_thumb">
          <div class="cs_single_product_thumb_item">
            <img src="{{ asset('assets/img/shop/product_thumb_lg_1.jpg') }}" alt="Thumb">
          </div>
          <div class="cs_single_product_thumb_item">
            <img src="{{ asset('assets/img/shop/product_thumb_lg_2.jpg') }}" alt="Thumb">
          </div>
          <div class="cs_single_product_thumb_item">
            <img src="{{ asset('assets/img/shop/product_thumb_lg_3.jpg') }}" alt="Thumb">
          </div>
          <div class="cs_single_product_thumb_item">
            <img src="{{ asset('assets/img/shop/product_thumb_lg_4.jpg') }}" alt="Thumb">
          </div>
          <div class="cs_single_product_thumb_item">
            <img src="{{ asset('assets/img/shop/product_thumb_lg_5.jpg') }}" alt="Thumb">
          </div>
        </div>
        <div class="cs_single_product_nav">
          <div class="cs_single_product_thumb_mini">
            <img src="{{ asset('assets/img/shop/product_thumb_sm_1.jpg') }}" alt="Thumb">
          </div>
          <div class="cs_single_product_thumb_mini">
            <img src="{{ asset('assets/img/shop/product_thumb_sm_2.jpg') }}" alt="Thumb">
          </div>
          <div class="cs_single_product_thumb_mini">
            <img src="{{ asset('assets/img/shop/product_thumb_sm_3.jpg') }}" alt="Thumb">
          </div>
          <div class="cs_single_product_thumb_mini">
            <img src="{{ asset('assets/img/shop/product_thumb_sm_4.jpg') }}" alt="Thumb">
          </div>
          <div class="cs_single_product_thumb_mini">
            <img src="{{ asset('assets/img/shop/product_thumb_sm_5.jpg') }}" alt="Thumb">
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="cs_single-product-details">
          <h2>Awesome men t-shirt</h2>
          <div class="cs_single_product-price_review cs_mb_26">
            <div class="cs_single_product_price cs_accent_color cs_primary_font cs_semi_bold">$20.00</div>
            <div class="cs_rating cs_type_2 cs_size_sm cs_accent_color" data-rating="4">
              <div class="cs_rating_bg">
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
              </div>
              <div class="cs_rating_percentage">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
            </div>
          </div>
          <div class="cs_single-product-details-text cs_mb_35">
            <p>Our t-shirt features a classic design with a crew neckline and short sleeves, making it a versatile piece that can be dressed up or down. The relaxed fit is perfect for all body types, providing ample room for movement and ensuring a flattering silhouette.</p>
            <p>Available in a range of colors, our men's t-shirt is the perfect choice for any occasion. Wear it with jeans and sneakers for a casual look or dress it up with slacks and a blazer for a more formal event. No matter how you style it, you're sure to look and feel your best. So why wait? Add our men's t-shirt to your wardrobe today and experience.</p>
          </div>
          <div class="cs_quantity_and_btn cs_mb_35 cs_mb_lg_30">
            <div class="cs_quantity">
              <button class="cs_quantity_button cs_increment"><i class="fa-solid fa-angle-up"></i></button>
              <span class="cs_quantity_input">1</span>
              <button class="cs_quantity_button cs_decrement"><i class="fa-solid fa-angle-down"></i></button>
            </div>
            <a href="#" class="cs_product_btn cs_semi_bold">Add to cart</a>
          </div>
          <ul class="cs_single_product_info">
            <li><b>SKU: </b>0215552</li>
            <li><b>Categories: </b>Graphics</li>
            <li><b>Tags: </b>Design, Brand, Clothing</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="cs_height_100 cs_height_lg_60"></div>
    <div class="cs_product_meta_info">
      <div class="cs_tabs cs_style1">
        <ul class="cs_tab_links cs_product_tab cs_primary_font cs_semi_bold">
          <li><a href="#tab_1">Description</a></li>
          <li><a href="#tab_2">Additional information</a></li>
          <li class="active"><a href="#tab_3">Review (1)</a></li>
        </ul>
        <div class="cs_height_40 cs_height_lg_40"></div>
        <div class="cs_tab_body">
          <div class="cs_tab" id="tab_1">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis orci ac odio dictum tincidunt. Donec ut metus leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed luctus, dui eu sagittis sodales, nulla nibh sagittis augue, vel porttitor diam enim non metus. Vestibulum aliquam augue neque. Phasellus tincidunt odio eget ullamcorper efficitur. Cras placerat ut turpis pellentesque vulputate. Nam sed consequat tortor. Curabitur finibus sapien dolor. Ut eleifend tellus nec erat pulvinar dignissim. Nam non arcu purus. Vivamus et massa massa.
          </div>
          <div class="cs_tab" id="tab_2">
            Cras placerat ut turpis pellentesque vulputate. Nam sed consequat tortor. Curabitur finibus sapien dolor. Ut eleifend tellus nec erat pulvinar dignissim. Nam non arcu purus. Vivamus et massa massa.
          </div>
          <div class="cs_tab active" id="tab_3">
            <div class="cs_shop_reviews">
              <h2 class="cs_shop_reviews_title">1 review for
                <span>Simple Wooden Chair</span>
              </h2>
              <ol class="commentlist">
                <li class="review">
                  <div class="comment_container">
                    <img class="avatar" src="{{ asset('assets/img/shop/review_thumb_1.jpg') }}" alt="Review">
                    <div class="cs_comment_text">
                      <div class="cs_rating cs_type_2 cs_size_sm cs_accent_color" data-rating="4">
                        <div class="cs_rating_bg">
                          <i class="fa-regular fa-star"></i>
                          <i class="fa-regular fa-star"></i>
                          <i class="fa-regular fa-star"></i>
                          <i class="fa-regular fa-star"></i>
                          <i class="fa-regular fa-star"></i>
                        </div>
                        <div class="cs_rating_percentage">
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                        </div>
                      </div>
                      <h4 class="cs_comment_meta">
                        <span class="cs_comment_author">John</span> –
                        <span class="cs_comment_date">June 23, 2023</span>
                      </h4>
                      <div class="description">
                        <p>Integer id dolor pretium characterized an erne. Nulla scelerisque volutpat neque.</p>
                      </div>
                    </div>
                  </div>
                </li>
              </ol>
              <div id="review_form_wrapper">
                <div id="review_form">
                  <div class="comment-respond">
                    <span class="cs_comment-reply-title">Add a review</span>
                    <form action="#" method="post" class="comment-form">
                      <p class="comment-form-cookies-consent">
                        <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes">
                        <label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label>
                      </p>
                      <div class="cs_rating cs_type_2 cs_size_sm cs_accent_color" data-rating="4">
                        <div class="cs_rating_bg">
                          <i class="fa-regular fa-star"></i>
                          <i class="fa-regular fa-star"></i>
                          <i class="fa-regular fa-star"></i>
                          <i class="fa-regular fa-star"></i>
                          <i class="fa-regular fa-star"></i>
                        </div>
                        <div class="cs_rating_percentage">
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                        </div>
                      </div>
                      <p class="comment-form-comment">
                        <label>Your review</label>
                        <textarea id="comment" name="comment" cols="45" rows="8" required="required"></textarea>
                      </p>
                      <div class="row">
                        <div class="col-md-6">
                          <p class="comment-form-author">
                            <label>Name <span class="required">*</span></label>
                            <input id="author" name="author" type="text" value="" size="30" required="">
                          </p>
                        </div>
                        <div class="col-md-6">
                          <p class="comment-form-email">
                            <label>Email <span class="required">*</span></label>
                            <input id="email" name="email" type="email" value="" size="30" required="">
                          </p>
                        </div>
                      </div>
                      <p class="form-submit">
                        <input name="submit" type="submit" id="submit" class="submit cs_btn cs_style_1" value="Submit">
                      </p>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
  <!-- End Product Details -->
@endsection
