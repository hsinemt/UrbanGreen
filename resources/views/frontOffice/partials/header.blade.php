<header class="cs_site_header cs_style_1 cs_sticky_header">
    <div class="cs_main_header">
        <div class="container">
            <div class="cs_main_header_in">
                <div class="cs_main_header_left">
                    <a class="cs_site_branding" href="{{ route('home') }}">
                        <img src="{{ asset('frontOffice/img/logo.svg') }}" alt="Logo">
                    </a>
                </div>
                <div class="cs_main_header_center">
                    <div class="cs_nav">
                        <ul class="cs_nav_list">
                            <li>
                                <a href="{{ route('home') }}">Home</a>
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
                                    <li><a href="{{ route('projects.index') }}">Projects</a></li>
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
                    <button class="cs_btn cs_style_1 cs_btn_sm" id="loginBtn">
                        <i class="fa-solid fa-user"></i> Login
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Login/Signup Modal -->
<div class="cs_auth_modal" id="authModal">
    <div class="cs_auth_modal_overlay" id="modalOverlay"></div>
    <div class="cs_auth_modal_content">
        <button class="cs_auth_modal_close" id="closeModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="cs_auth_forms">
            <!-- Login Form -->
            <div class="cs_auth_form" id="loginForm">
                <div class="cs_auth_header">
                    <h2 class="cs_fs_38 cs_semibold cs_mb_15">Welcome Back!</h2>
                    <p class="cs_mb_30">Sign in to continue your environmental journey</p>
                </div>

                <form action="#" method="POST">
                    <div class="cs_form_group cs_mb_20">
                        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Email Address</label>
                        <input type="email" class="cs_form_input" placeholder="your@email.com" required>
                    </div>

                    <div class="cs_form_group cs_mb_20">
                        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Password</label>
                        <input type="password" class="cs_form_input" placeholder="Enter your password" required>
                    </div>

                    <div class="cs_auth_options cs_mb_25">
                        <label class="cs_checkbox_label">
                            <input type="checkbox">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="cs_accent_color">Forgot Password?</a>
                    </div>

                    <button type="submit" class="cs_btn cs_style_1 w-100 cs_mb_20">
                        Sign In
                        <i>
                            <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </i>
                    </button>

                    <div class="cs_auth_divider cs_mb_20">
                        <span>or continue with</span>
                    </div>

                    <div class="cs_social_login cs_mb_25">
                        <button type="button" class="cs_social_btn">
                            <i class="fa-brands fa-google"></i>
                        </button>
                        <button type="button" class="cs_social_btn">
                            <i class="fa-brands fa-facebook-f"></i>
                        </button>
                        <button type="button" class="cs_social_btn">
                            <i class="fa-brands fa-twitter"></i>
                        </button>
                    </div>

                    <p class="cs_auth_switch text-center">
                        Don't have an account?
                        <a href="#" class="cs_accent_color cs_semibold" id="showSignup">Sign Up</a>
                    </p>
                </form>
            </div>

            <!-- Signup Form -->
            <div class="cs_auth_form cs_hidden" id="signupForm">
                <div class="cs_auth_header">
                    <h2 class="cs_fs_38 cs_semibold cs_mb_15">Join Our Community</h2>
                    <p class="cs_mb_30">Start making a difference for our planet today</p>
                </div>

                <form action="#" method="POST">
                    <div class="cs_form_group cs_mb_20">
                        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Full Name</label>
                        <input type="text" class="cs_form_input" placeholder="John Doe" required>
                    </div>

                    <div class="cs_form_group cs_mb_20">
                        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Email Address</label>
                        <input type="email" class="cs_form_input" placeholder="your@email.com" required>
                    </div>

                    <div class="cs_form_group cs_mb_20">
                        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Password</label>
                        <input type="password" class="cs_form_input" placeholder="Create a strong password" required>
                    </div>

                    <div class="cs_form_group cs_mb_25">
                        <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Confirm Password</label>
                        <input type="password" class="cs_form_input" placeholder="Confirm your password" required>
                    </div>

                    <div class="cs_auth_options cs_mb_25">
                        <label class="cs_checkbox_label">
                            <input type="checkbox" required>
                            <span>I agree to the <a href="#" class="cs_accent_color">Terms & Conditions</a></span>
                        </label>
                    </div>

                    <button type="submit" class="cs_btn cs_style_1 w-100 cs_mb_20">
                        Create Account
                        <i>
                            <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </i>
                    </button>

                    <div class="cs_auth_divider cs_mb_20">
                        <span>or sign up with</span>
                    </div>

                    <div class="cs_social_login cs_mb_25">
                        <button type="button" class="cs_social_btn">
                            <i class="fa-brands fa-google"></i>
                        </button>
                        <button type="button" class="cs_social_btn">
                            <i class="fa-brands fa-facebook-f"></i>
                        </button>
                        <button type="button" class="cs_social_btn">
                            <i class="fa-brands fa-twitter"></i>
                        </button>
                    </div>

                    <p class="cs_auth_switch text-center">
                        Already have an account?
                        <a href="#" class="cs_accent_color cs_semibold" id="showLogin">Sign In</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
