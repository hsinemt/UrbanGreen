@extends('frontOffice.layouts.app')
@section('title', 'Products')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">All Products</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Products</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Product List -->
  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="cs_shop_sidebar">
          <div class="cs_shop_sidebar_widget">
            <form action="#" class="cs_shop_search">
              <input class="cs_shop_search_input" type="text" placeholder="Search Products...">
              <button class="cs_shop_search_btn">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.6939 10.3222C11.5282 10.1562 11.3033 10.0629 11.0688 10.0629H10.8189C10.7506 10.0629 10.6849 10.0364 10.6357 9.98894C10.535 9.89181 10.5281 9.73333 10.6148 9.62352C11.416 8.60899 11.8925 7.33012 11.8925 5.94625C11.8925 2.66209 9.23042 0 5.94625 0C2.66209 0 0 2.66209 0 5.94625C0 9.23042 2.66209 11.8925 5.94625 11.8925C7.33012 11.8925 8.60899 11.416 9.62352 10.6148C9.73333 10.5281 9.89181 10.535 9.98894 10.6357C10.0364 10.6849 10.0629 10.7506 10.0629 10.8189V11.0688C10.0629 11.3033 10.1562 11.5282 10.3222 11.6939L13.9547 15.3191C14.3316 15.6953 14.942 15.695 15.3185 15.3185C15.695 14.942 15.6953 14.3316 15.3191 13.9547L11.6939 10.3222ZM5.94625 10.0629C3.66838 10.0629 1.82962 8.22413 1.82962 5.94625C1.82962 3.66838 3.66838 1.82962 5.94625 1.82962C8.22413 1.82962 10.0629 3.66838 10.0629 5.94625C10.0629 8.22413 8.22413 10.0629 5.94625 10.0629Z" fill="currentColor"/>
                </svg>
              </button>
            </form>
          </div>
          <div class="cs_shop_sidebar_widget">
            <h3 class="cs_shop_sidebar_widget_title">Categories</h3>
            <ul class="cs_shop_sidebar_category_list">
              <li><a href="">Design (5)</a></li>
              <li><a href="">Creative (2)</a></li>
              <li><a href="">Illustration (3)</a></li>
            </ul>
          </div>
          <div class="cs_shop_sidebar_widget">
            <h3 class="cs_shop_sidebar_widget_title">Price Filter</h3>
            <div class="cs_range-slider-wrap">
              <div id="slider-range"></div>
              <div class="cs_amount-wrap">
                <input type="text" id="amount" readonly>
              </div>
            </div>
          </div>
          <div class="cs_shop_sidebar_widget">
            <h3 class="cs_shop_sidebar_widget_title">Tags</h3>
            <ul class="cs_shop_sidebar_tag_list">
              <li><a href="">Brand</a></li>
              <li><a href="">Marketing</a></li>
              <li><a href="">Creative</a></li>
              <li><a href="">Design</a></li>
              <li><a href="">Logo</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="cs_height_0 cs_height_lg_50"></div>
        <div class="cs_shop_filter_wrap">
          <div class="cs_number_of_product">Showing 1–9 of 12 results</div>
          <form action="#" class="cs_shop_filter_form">
            <select>
              <option value="latest">Sort by latest</option>
              <option value="high">Sort by low price</option>
              <option value="low">Sort by high price</option>
            </select>
          </form>
        </div>
        <div class="row cs_gap_y_50">
          <div class="col-lg-4 col-sm-6">
            <div class="cs_product_card cs_style_1">
              <div class="cs_product_thumb">
                <img src="{{ asset('assets/img/shop/product_1.jpg') }}" alt="Product">
                <div class="cs_product_overlay"></div>
                <div class="cs_card_btns">
                  <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                  <a href="#"><i class="fa-solid fa-heart"></i></a>
                  <a href="{{ route('products.show', ['slug' => 'product-details']) }}"><i class="fa-solid fa-eye"></i></a>
                </div>
              </div>
              <div class="cs_product_info">
                <h2 class="cs_product_title"><a href="{{ route('products.show', ['slug' => 'product-details']) }}">Natural wooden chair</a></h2>
                <p class="cs_product_price">Price: $550</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="cs_product_card cs_style_1">
              <div class="cs_product_thumb">
                <img src="{{ asset('assets/img/shop/product_2.jpg') }}" alt="Product">
                <div class="cs_product_overlay"></div>
                <div class="cs_card_btns">
                  <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                  <a href="#"><i class="fa-solid fa-heart"></i></a>
                  <a href="{{ route('products.show', ['slug' => 'product-details']) }}"><i class="fa-solid fa-eye"></i></a>
                </div>
              </div>
              <div class="cs_product_info">
                <h2 class="cs_product_title"><a href="{{ route('products.show', ['slug' => 'product-details']) }}">Eco water bottle</a></h2>
                <p class="cs_product_price">Price: $49</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="cs_product_card cs_style_1">
              <div class="cs_product_thumb">
                <img src="{{ asset('assets/img/shop/product_3.jpg') }}" alt="Product">
                <div class="cs_product_overlay"></div>
                <div class="cs_card_btns">
                  <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                  <a href="#"><i class="fa-solid fa-heart"></i></a>
                  <a href="{{ route('products.show', ['slug' => 'product-details']) }}"><i class="fa-solid fa-eye"></i></a>
                </div>
              </div>
              <div class="cs_product_info">
                <h2 class="cs_product_title"><a href="{{ route('products.show', ['slug' => 'product-details']) }}">Bamboo toothbrush</a></h2>
                <p class="cs_product_price">Price: $9</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
  <!-- End Product List -->
@endsection
