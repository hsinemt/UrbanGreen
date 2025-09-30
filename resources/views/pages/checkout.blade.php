@extends('layouts.app')

@section('title', 'Checkout')

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

  <!-- Start Checkout Section -->
  <div class="cs_height_150 cs_height_lg_80"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-7">
        <p class="cs_checkout-alert m-0">Have a coupon? <a href="">Click here to enter your code</a></p>
        <div class="cs_height_40 cs_height_lg_40"></div>
        <h2 class="cs_checkout-title">Billing Details</h2>
        <div class="cs_height_45 cs_height_lg_40"></div>
        <div class="row">
          <div class="col-lg-6">
            <label class="cs_shop-label">First Name *</label>
            <input type="text" class="cs_shop-input">
          </div>
          <div class="col-lg-6">
            <label class="cs_shop-label">Last Name *</label>
            <input type="text" class="cs_shop-input">
          </div>
          <div class="col-lg-12">
            <label class="cs_shop-label">Company name (optional)</label>
            <input type="text" class="cs_shop-input">
          </div>
          <div class="col-lg-12">
            <label class="cs_shop-label">Country / Region *</label>
            <select class="cs_shop-input">
              <option value="States">United States (US)</option>
              <option value="Kingdom">United Kingdom</option>
              <option value="Kanada">Kanada</option>
            </select>
          </div>
          <div class="col-lg-12">
            <label class="cs_shop-label">Street address *</label>
            <input type="text" class="cs_shop-input" placeholder="House number and street name">
            <input type="text" class="cs_shop-input" placeholder="Apartment, suite, unit, etc (optional) ">
          </div>
          <div class="col-lg-12">
            <label class="cs_shop-label">Town / City *</label>
            <input type="text" class="cs_shop-input">
          </div>
          <div class="col-lg-12">
            <label class="cs_shop-label">State *</label>
            <select class="cs_shop-input">
              <option value="California">California</option>
              <option value="Gercy">New Gercy</option>
              <option value="Daiking">Daiking</option>
            </select>
          </div>
          <div class="col-lg-12">
            <label class="cs_shop-label">ZIP Code *</label>
            <input type="text" class="cs_shop-input">
          </div>
          <div class="col-lg-12">
            <label class="cs_shop-label">Phone *</label>
            <input type="text" class="cs_shop-input">
          </div>
          <div class="col-lg-12">
            <label class="cs_shop-label">Email address *</label>
            <input type="text" class="cs_shop-input">
          </div>
        </div>
        <div class="cs_height_45 cs_height_lg_45"></div>
        <h2 class="cs_checkout-title">Additional information</h2>
        <div class="cs_height_30 cs_height_lg_30"></div>
        <label class="cs_shop-label">Order notes (optional)</label>
        <textarea cols="30" rows="6" class="cs_shop-input mb-0"></textarea>
        <div class="cs_height_30 cs_height_lg_30"></div>
      </div>
      <div class="col-xl-5">
        <div class="cs_shop-side-spacing">
          <div class="cs_shop-card">
            <h2>Your order</h2>
            <table>
              <tbody>
                <tr class="cs_semi_bold">
                  <td>Products</td>
                  <td class="text-end">Amount</td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center cs_gap_15">
                      <img src="assets/img/shop/product-1.jpg" alt="">
                      <p class="mb-0 cs_medium">Hand wash</p>
                    </div>
                  </td>
                  <td class="text-end">$20.00</td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center cs_gap_15">
                      <img src="assets/img/shop/product-2.jpg" alt="">
                      <p class="mb-0 cs_medium">Half running set</p>
                    </div>
                  </td>
                  <td class="text-end">$20.00</td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center cs_gap_15">
                      <img src="assets/img/shop/product-3.jpg" alt="">
                      <p class="mb-0 cs_medium">Red Capsicum</p>
                    </div>
                  </td>
                  <td class="text-end">$20.00</td>
                </tr>
                <tr>
                  <td>Subtotal</td>
                  <td class="text-end">$45.00</td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td class="text-end">$45.00</td>
                </tr>
              </tbody>
            </table>
            <div class="cs_height_30 cs_height_lg_30"></div>
            <div class="accordion" id="accordionPanelsStayOpenExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    Direct bank transfer
                  </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                  <div class="accordion-body">
                    Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    Check payments
                  </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                  <div class="accordion-body">
                    Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                    Cash on delivery
                  </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                  <div class="accordion-body">
                    Pay with cash upon delivery.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                    PayPal
                  </button>
                </h2>
                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
                  <div class="accordion-body">
                    Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.
                  </div>
                </div>
              </div>
            </div>
            <div class="cs_height_25 cs_height_lg_25"></div>
            <a href="{{ route('order.received') }}" class="cs_btn cs_style_1 cs_color_1 w-100">Place Order</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
  <!-- End Checkout Section -->
@endsection
