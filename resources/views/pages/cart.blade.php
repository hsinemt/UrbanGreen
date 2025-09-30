@extends('layouts.app')

@section('title', 'Cart')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="assets/img/page_heading_bg.jpg">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Cart</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Cart</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Cart Section -->
  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-8">
        <div class="table-responsive">
          <table class="cs_cart_table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="cs_cart_table_media">
                    <img src="assets/img/shop/cart-product-1.jpg" alt="Thumb">
                    <h3>Natural wooden chair</h3>
                  </div>
                </td>
                <td>$300.00</td>
                <td>
                  <div class="cs_quantity">
                    <button class="cs_quantity_button cs_increment"><i class="fa-solid fa-angle-up"></i></button>
                    <span class="cs_quantity_input">1</span>
                    <button class="cs_quantity_button cs_decrement"><i class="fa-solid fa-angle-down"></i></button>
                  </div>
                </td>
                <td>
                  $20.00
                </td>
                <td class="text-center">
                  <button class="cs_cart-table-close"><i class="fa-solid fa-xmark"></i></button>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="cs_cart_table_media">
                    <img src="assets/img/shop/cart-product-2.jpg" alt="Thumb">
                    <h3>Bamboo made pen</h3>
                  </div>
                </td>
                <td>$300.00</td>
                <td>
                  <div class="cs_quantity">
                    <button class="cs_quantity_button cs_increment"><i class="fa-solid fa-angle-up"></i></button>
                    <span class="cs_quantity_input">1</span>
                    <button class="cs_quantity_button cs_decrement"><i class="fa-solid fa-angle-down"></i></button>
                  </div>
                </td>
                <td>$20.00</td>
                <td class="text-center">
                  <button class="cs_cart-table-close"><i class="fa-solid fa-xmark"></i></button>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="cs_cart_table_media">
                    <img src="assets/img/shop/cart-product-3.jpg" alt="Thumb">
                    <h3>Natural toothbrush</h3>
                  </div>
                </td>
                <td>$300.00</td>
                <td>
                  <div class="cs_quantity">
                    <button class="cs_quantity_button cs_increment"><i class="fa-solid fa-angle-up"></i></button>
                    <span class="cs_quantity_input">1</span>
                    <button class="cs_quantity_button cs_decrement"><i class="fa-solid fa-angle-down"></i></button>
                  </div>
                </td>
                <td>
                  $20.00
                </td>
                <td class="text-center">
                  <button class="cs_cart-table-close"><i class="fa-solid fa-xmark"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="d-flex align-items-center justify-content-between cs_gap_10 flex-wrap">
          <a href="{{ route('products.index') }}" class="cs_btn cs_style_1">
            Continue Shopping
            <i>
              <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </i>
          </a>
          <a href="{{ route('checkout') }}" class="cs_btn cs_style_1 cs_color_1">
            Proceed to checkout
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
      <div class="col-xl-4">
        <div class="cs_cart_total_widget">
          <h4 class="cs_fs_21 cs_semibold cs_mb_24">Cart Totals</h4>
          <ul class="cs_list cs_style_2 cs_mp_0">
            <li>
              <span>Sub Total:</span>
              <b>$120.00</b>
            </li>
            <li>
              <span>Tax</span>
              <b>$15.00</b>
            </li>
            <li>
              <span>Delivery</span>
              <b>Free</b>
            </li>
          </ul>
          <div class="d-flex align-items-center justify-content-between cs_gap_10 cs_pt_18">
            <h4 class="cs_fs_21 cs_semibold">Total</h4>
            <h4 class="cs_fs_21 cs_semibold">$135.00</h4>
          </div>
        </div>
        <div class="cs_shop_widget">
          <h3 class="cs_shop_widget_title">Price Range</h3>
          <div class="cs_shop_price_range">
            <input type="hidden" id="min_price" value="150">
            <input type="hidden" id="max_price" value="1300">
            <div id="price_slider"></div>
            <div class="d-flex flex-wrap align-items-center justify-content-between cs_gap_10">
              <button class="cs_btn cs_style_1">Filter</button>
              <p class="mb-0">Price: <span id="price_range">$12 - $900</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
  <!-- End Cart Section -->
@endsection
