@extends('layouts.app')

@section('title', 'Wishlist')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="assets/img/page_heading_bg.jpg">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Wishlist</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Wishlist</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Wishlist Section -->
  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <div class="table-responsive">
      <table class="cs_cart_table cs_size1">
        <thead>
          <tr>
            <th>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkAll">
              </div>
            </th>
            <th>Product</th>
            <th>Price</th>
            <th>Stock Status</th>
            <th>Subtotal</th>
            <th>Remove</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="form-check">
                <input class="form-check-input" type="checkbox">
              </div>
            </td>
            <td>
              <div class="cs_cart_table_media">
                <img src="assets/img/shop/cart-product-1.jpg" alt="Thumb">
                <h3>Awesome men T-shirt</h3>
              </div>
            </td>
            <td>$300.00</td>
            <td>In stock</td>
            <td>
              $20.00
            </td>
            <td class="text-center">
              <button class="cs_cart-table-close"><i class="fa-solid fa-xmark"></i></button>
            </td>
            <td class="text-end"><a href="#" class="cs_product_btn cs_semi_bold">Add to Cart</a></td>
          </tr>
          <tr>
            <td>
              <div class="form-check">
                <input class="form-check-input" type="checkbox">
              </div>
            </td>
            <td>
              <div class="cs_cart_table_media">
                <img src="assets/img/shop/cart-product-2.jpg" alt="Thumb">
                <h3>Fuyure AI robot toy</h3>
              </div>
            </td>
            <td>$300.00</td>
            <td>In stock</td>
            <td>
              $20.00
            </td>
            <td class="text-center">
              <button class="cs_cart-table-close"><i class="fa-solid fa-xmark"></i></button>
            </td>
            <td class="text-end"><a href="#" class="cs_product_btn cs_semi_bold">Add to Cart</a></td>
          </tr>
          <tr>
            <td>
              <div class="form-check">
                <input class="form-check-input" type="checkbox">
              </div>
            </td>
            <td>
              <div class="cs_cart_table_media">
                <img src="assets/img/shop/cart-product-3.jpg" alt="Thumb">
                <h3>Hemp seed shampoo</h3>
              </div>
            </td>
            <td>$300.00</td>
            <td>In stock</td>
            <td>
              $20.00
            </td>
            <td class="text-center">
              <button class="cs_cart-table-close"><i class="fa-solid fa-xmark"></i></button>
            </td>
            <td class="text-end"><a href="#" class="cs_product_btn cs_semi_bold">Add to Cart</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="cs_height_5 cs_height_lg_5"></div>
    <div class="cs_cart-offer">
      <div class="cs_cart-offer-col">
        <form action="#" class="cs_coupon-doce-form">
          <select class="cs_shop-input m-0">
            <option value="States">Actions</option>
            <option value="Netherlands">Move to cart</option>
            <option value="UK">Remove from List</option>
            <option value="Australia">Clear List</option>
          </select>
          <button class="cs_btn cs_style_1">Apply</button>
        </form>
      </div>
      <div class="cs_cart-offer-col text-end">
        <button class="cs_btn cs_style_1">Clear Wishlist</button>
        <a href="{{ route('cart') }}" class="cs_btn cs_style_1 cs_color_1">Add Selected to Cart</a>
      </div>
    </div>
    <div class="cs_height_140 cs_height_lg_70"></div>
  </div>
  <!-- End Wishlist Section -->
@endsection
