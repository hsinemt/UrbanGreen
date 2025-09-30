<header class="cs_site_header cs_style_1 cs_sticky_header">
  <div class="cs_main_header">
    <div class="container">
      <div class="cs_main_header_in">
        <div class="cs_main_header_left">
          <a class="cs_site_branding" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.svg') }}" alt="Logo">
          </a>
        </div>
        <div class="cs_main_header_center">
          <div class="cs_nav">
            <ul class="cs_nav_list">
              <li class="menu-item-has-children cs_mega_menu">
                <a href="{{ route('home') }}">Home</a>
                <ul class="cs_mega_wrapper cs_with_thumb">
                  <li>
                    <a href="{{ route('home') }}">
                      <img src="{{ asset('img/demo/home-1.jpg') }}" alt="">Nature
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('causes.animal') }}">
                      <img src="{{ asset('img/demo/home-2.jpg') }}" alt="">Animal
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('causes.recycling') }}">
                      <img src="{{ asset('img/demo/home-3.jpg') }}" alt="">Recycling
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('causes.agriculture') }}">
                      <img src="{{ asset('img/demo/home-4.jpg') }}" alt="">Agriculture
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('causes.ocean-life') }}">
                      <img src="{{ asset('img/demo/home-5.jpg') }}" alt="">Ocean Life
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('causes.charity') }}">
                      <img src="{{ asset('img/demo/home-6.jpg') }}" alt="">Charity
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('causes.climate-change') }}">
                      <img src="{{ asset('img/demo/home-7.jpg') }}" alt="">Climate Change
                    </a>
                  </li>
                </ul>
              </li>
              <li><a href="{{ route('about') }}">About</a></li>
              <li class="menu-item-has-children">
                <a href="#">Pages</a>
                <ul>
                  <li><a href="{{ route('services.index') }}">Services</a></li>
                  <li><a href="{{ route('services.show', ['slug' => 'service-details']) }}">Service Details</a></li>
                  <li><a href="{{ route('team') }}">Team</a></li>
                  <li><a href="{{ route('campaigns.index') }}">Campaigns</a></li>
                  <li><a href="{{ route('campaigns.show', ['slug' => 'campaign-details']) }}">Campaign Details</a></li>
                  <li><a href="{{ route('events.show', ['slug' => 'event-details']) }}">Event Details</a></li>
                  <li><a href="{{ route('projects.show', ['slug' => 'project-details']) }}">Project Details</a></li>
                  <li><a href="{{ route('gallery') }}">Gallery</a></li>
                </ul>
              </li>
              <li><a href="{{ route('campaigns.index') }}">Campaigns</a></li>
              <li class="menu-item-has-children">
                <a href="{{ route('products.index') }}">Shop</a>
                <ul>
                  <li><a href="{{ route('products.index') }}">Shop</a></li>
                  <li><a href="{{ route('products.show', ['slug' => 'product-details']) }}">Product Details</a></li>
                  <li><a href="{{ route('cart') }}">Cart</a></li>
                  <li><a href="{{ route('checkout') }}">Checkout</a></li>
                  <li><a href="{{ route('order.received') }}">Order Received</a></li>
                  <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                </ul>
              </li>
              <li><a href="{{ route('blog.index') }}">Blog</a></li>
              <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="cs_main_header_right">
          <!-- Placeholder for header right widgets (search/cart/buttons) if needed -->
        </div>
      </div>
    </div>
  </div>
</header>
