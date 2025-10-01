@extends('frontOffice.layouts.app')
@section('title', 'Order Received')

@section('content')
  <!-- Start Hero Section -->
  <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="assets/img/page_heading_bg.jpg">
    <div class="container">
      <h1 class="cs_fs_51 cs_white_color cs_mb_11">Checkout</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Checkout</li>
      </ol>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start Order Received Section -->
  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <p class="m-0 text-center">Thank you! Your order has been received.</p>
    <div class="cs_height_95 cs_height_lg_50"></div>
    <ul class="cs_order-summery">
      <li>
        <p>Order Number:</p>
        <h3>251501</h3>
      </li>
      <li>
        <p>Date:</p>
        <h3>September 11, 2023</h3>
      </li>
      <li>
        <p>Total:</p>
        <h3>$605.00</h3>
      </li>
      <li>
        <p>Payment method:</p>
        <h3>COD</h3>
      </li>
    </ul>
    <div class="cs_height_50 cs_height_lg_30"></div>
    <div class="cs_shop-card">
      <h2>Order details</h2>
      <table class="border-bottom-0">
        <tbody>
          <tr class="cs_semi_bold">
            <td>Products</td>
            <td class="text-end">Amount</td>
          </tr>
          <tr>
            <td>Awesome men T-shirt x 1</td>
            <td class="text-end">$20.00</td>
          </tr>
          <tr>
            <td>Future AI robot toy x 1</td>
            <td class="text-end">$550.00</td>
          </tr>
          <tr>
            <td>Hemp seed shampoo x 1</td>
            <td class="text-end">$35.00</td>
          </tr>
          <tr>
            <td class="cs_semi_bold">Subtotal</td>
            <td class="text-end">$605.00</td>
          </tr>
          <tr>
            <td class="cs_semi_bold">Payment method</td>
            <td class="text-end">Cash on delivery</td>
          </tr>
          <tr class="cs_semi_bold">
            <td class="pb-0">Total</td>
            <td class="text-end pb-0">$605.00</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
  <!-- End Order Received Section -->
@endsection
