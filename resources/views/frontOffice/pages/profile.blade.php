@extends('frontOffice.layouts.app')

@section('title', 'My Profile - UrbanGreen')

@section('content')
    <!-- Page Header -->
    <section class="cs_page_header" style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); padding: 80px 0 60px; position: relative;">
        <div class="container">
            <div class="cs_page_header_in" style="position: relative; z-index: 1;">
                <h1 class="cs_fs_72 cs_bold" style="color: #fff; margin-bottom: 15px;">My Profile</h1>
{{--                <ol class="breadcrumb text-uppercase" style="background: transparent; padding: 0; margin: 0; display: flex; gap: 15px; list-style: none;">--}}
{{--                    <li class="breadcrumb-item" style="color: rgba(255, 255, 255, 0.8); font-size: 14px;">--}}
{{--                        <a href="{{ route('home') }}" style="color: #fff; text-decoration: none;">Home</a>--}}
{{--                    </li>--}}
{{--                    <li class="breadcrumb-item active" style="color: rgba(255, 255, 255, 0.9);">/  Profile</li>--}}
{{--                </ol>--}}
            </div>
        </div>
    </section>

    <div class="cs_height_100 cs_height_lg_70"></div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="container">
            <div class="alert alert-success" style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 20px; border-radius: 20px; display: flex; align-items: center; gap: 15px; margin-bottom: 30px;">
                <i class="fa-solid fa-check-circle" style="font-size: 24px; color: #28a745;"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Profile Section -->
    <section class="cs_profile_section">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="cs_profile_sidebar">
                        <!-- Profile Avatar Card -->
                        <div class="cs_profile_card cs_white_bg cs_radius_20" style="padding: 35px; box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08); border-radius: 20px; background: #fff; margin-bottom: 25px;">
                            <div class="cs_profile_avatar_wrapper" style="text-align: center; padding-bottom: 30px; border-bottom: 1px solid #e8e8e8;">
                                <div class="cs_avatar_container" style="position: relative; display: inline-block;">
                                    <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}"
                                         style="width: 140px; height: 140px; border-radius: 50%; object-fit: cover; border: 5px solid #4CAF50; box-shadow: 0 5px 20px rgba(76, 175, 80, 0.3);">
                                    <button type="button" class="cs_avatar_edit_btn" onclick="document.getElementById('avatarInput').click()"
                                            style="position: absolute; bottom: 5px; right: 5px; width: 40px; height: 40px; border-radius: 50%; background: #4CAF50; border: 3px solid #fff; color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);">
                                        <i class="fa-solid fa-camera"></i>
                                    </button>
                                </div>

                                <!-- Hidden Avatar Upload Form -->
                                <form id="avatarForm" action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                                    @csrf
                                    <input type="file" id="avatarInput" name="avatar" accept="image/*" onchange="document.getElementById('avatarForm').submit()">
                                </form>

                                <h3 class="cs_fs_24 cs_semibold cs_mt_20 cs_mb_5">{{ Auth::user()->name }}</h3>
                                <p class="cs_profile_email cs_mb_15" style="color: #666; font-size: 15px;">{{ Auth::user()->email }}</p>
                                <span class="cs_member_badge" style="display: inline-block; background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); color: #fff; padding: 8px 20px; border-radius: 50px; font-size: 13px; font-weight: 600;">
                                    <i class="fa-solid fa-leaf" style="margin-right: 5px;"></i> Member Since {{ Auth::user()->created_at->format('M Y') }}
                                </span>
                            </div>

                            <div class="cs_profile_stats" style="padding-top: 30px;">
                                <div class="cs_stat_item" style="display: flex; align-items: center; gap: 15px; padding: 20px 0; border-bottom: 1px solid #f5f5f5;">
                                    <div class="cs_stat_icon" style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); display: flex; align-items: center; justify-content: center; color: #4CAF50; font-size: 20px;">
                                        <i class="fa-solid fa-heart"></i>
                                    </div>
                                    <div class="cs_stat_content" style="flex: 1;">
                                        <h4 class="cs_fs_32 cs_semibold cs_accent_color" style="margin-bottom: 5px;">0</h4>
                                        <p class="cs_fs_14" style="color: #666; margin: 0;">Campaigns</p>
                                    </div>
                                </div>
                                <div class="cs_stat_item" style="display: flex; align-items: center; gap: 15px; padding: 20px 0; border-bottom: 1px solid #f5f5f5;">
                                    <div class="cs_stat_icon" style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); display: flex; align-items: center; justify-content: center; color: #4CAF50; font-size: 20px;">
                                        <i class="fa-solid fa-calendar-check"></i>
                                    </div>
                                    <div class="cs_stat_content" style="flex: 1;">
                                        <h4 class="cs_fs_32 cs_semibold cs_accent_color" style="margin-bottom: 5px;">0</h4>
                                        <p class="cs_fs_14" style="color: #666; margin: 0;">Events</p>
                                    </div>
                                </div>
                                <div class="cs_stat_item" style="display: flex; align-items: center; gap: 15px; padding: 20px 0;">
                                    <div class="cs_stat_icon" style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); display: flex; align-items: center; justify-content: center; color: #4CAF50; font-size: 20px;">
                                        <i class="fa-solid fa-shopping-bag"></i>
                                    </div>
                                    <div class="cs_stat_content" style="flex: 1;">
                                        <h4 class="cs_fs_32 cs_semibold cs_accent_color" style="margin-bottom: 5px;">0</h4>
                                        <p class="cs_fs_14" style="color: #666; margin: 0;">Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="cs_profile_card cs_white_bg cs_radius_20" style="padding: 35px; box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08); border-radius: 20px; background: #fff;">
                            <h4 class="cs_fs_20 cs_semibold cs_mb_20">Quick Actions</h4>
                            <div class="cs_quick_actions" style="display: flex; flex-direction: column; gap: 10px;">
                                <a href="{{ route('campaigns.index') }}" class="cs_action_link" style="display: flex; align-items: center; gap: 15px; padding: 15px; border-radius: 12px; background: #f9f9f9; color: #333; text-decoration: none; transition: all 0.3s; font-size: 15px;">
                                    <i class="fa-solid fa-bullhorn" style="width: 24px; text-align: center; font-size: 18px;"></i>
                                    <span>Browse Campaigns</span>
                                </a>
                                <a href="{{ route('products.index') }}" class="cs_action_link" style="display: flex; align-items: center; gap: 15px; padding: 15px; border-radius: 12px; background: #f9f9f9; color: #333; text-decoration: none; transition: all 0.3s; font-size: 15px;">
                                    <i class="fa-solid fa-shopping-cart" style="width: 24px; text-align: center; font-size: 18px;"></i>
                                    <span>Shop Products</span>
                                </a>
                                <a href="{{ route('cart') }}" class="cs_action_link" style="display: flex; align-items: center; gap: 15px; padding: 15px; border-radius: 12px; background: #f9f9f9; color: #333; text-decoration: none; transition: all 0.3s; font-size: 15px;">
                                    <i class="fa-solid fa-bag-shopping" style="width: 24px; text-align: center; font-size: 18px;"></i>
                                    <span>My Cart</span>
                                </a>
                                <a href="{{ route('wishlist') }}" class="cs_action_link" style="display: flex; align-items: center; gap: 15px; padding: 15px; border-radius: 12px; background: #f9f9f9; color: #333; text-decoration: none; transition: all 0.3s; font-size: 15px;">
                                    <i class="fa-solid fa-heart" style="width: 24px; text-align: center; font-size: 18px;"></i>
                                    <span>My Wishlist</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="cs_profile_main">
                        <!-- Profile Information -->
                        <div class="cs_profile_card cs_white_bg cs_radius_20 cs_mb_25" style="padding: 35px; box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08); border-radius: 20px; background: #fff; margin-bottom: 25px;">
                            <div class="cs_card_header" style="padding-bottom: 25px; border-bottom: 1px solid #e8e8e8; margin-bottom: 30px;">
                                <h3 class="cs_fs_24 cs_semibold" style="margin-bottom: 5px; color: #1a1a1a;">Personal Information</h3>
                                <p class="cs_fs_14 cs_heading_color" style="color: #666; margin: 0;">Update your personal details</p>
                            </div>

                            @if($errors->any())
                                <div class="alert alert-danger cs_mb_20" style="background-color: #f8d7da; border: 1px solid #f5c2c7; color: #842029; padding: 15px 20px; border-radius: 12px; margin-bottom: 25px;">
                                    <ul class="cs_mb_0" style="list-style: none; padding-left: 0; margin: 0;">
                                        @foreach ($errors->all() as $error)
                                            <li style="padding: 5px 0;">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('profile.update') }}" method="POST" class="cs_profile_form">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">First Name</label>
                                            <input type="text" name="first_name" class="cs_form_input @error('first_name') is-invalid @enderror"
                                                   value="{{ old('first_name', Auth::user()->first_name) }}"
                                                   style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;" required>
                                            @error('first_name')
                                            <span class="cs_error_text" style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Last Name</label>
                                            <input type="text" name="last_name" class="cs_form_input @error('last_name') is-invalid @enderror"
                                                   value="{{ old('last_name', Auth::user()->last_name) }}"
                                                   style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;" required>
                                            @error('last_name')
                                            <span class="cs_error_text" style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Email Address</label>
                                    <input type="email" name="email" class="cs_form_input @error('email') is-invalid @enderror"
                                           value="{{ old('email', Auth::user()->email) }}"
                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;" required>
                                    @error('email')
                                    <span class="cs_error_text" style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Phone Number</label>
                                    <input type="tel" name="phone" class="cs_form_input"
                                           value="{{ old('phone', Auth::user()->phone) }}"
                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                           placeholder="+1 234 567 8900">
                                </div>

                                <div class="cs_form_field cs_mb_30" style="margin-bottom: 30px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Bio</label>
                                    <textarea name="bio" class="cs_form_input" rows="4"
                                              style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                              placeholder="Tell us about yourself and your passion for the environment...">{{ old('bio', Auth::user()->bio) }}</textarea>
                                </div>

                                <button type="submit" class="cs_btn cs_style_1">
                                    <span>Update Profile</span>
                                    <i>
                                        <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </i>
                                </button>
                            </form>
                        </div>

                        <!-- Change Password -->
                        <div class="cs_profile_card cs_white_bg cs_radius_20" style="padding: 35px; box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08); border-radius: 20px; background: #fff;">
                            <div class="cs_card_header" style="padding-bottom: 25px; border-bottom: 1px solid #e8e8e8; margin-bottom: 30px;">
                                <h3 class="cs_fs_24 cs_semibold" style="margin-bottom: 5px; color: #1a1a1a;">Change Password</h3>
                                <p class="cs_fs_14 cs_heading_color" style="color: #666; margin: 0;">Ensure your account is secure</p>
                            </div>

                            <form action="{{ route('profile.update') }}" method="POST" class="cs_profile_form">
                                @csrf
                                @method('PUT')

                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Current Password</label>
                                    <input type="password" name="current_password" class="cs_form_input @error('current_password') is-invalid @enderror"
                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;">
                                    @error('current_password')
                                    <span class="cs_error_text" style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">New Password</label>
                                    <input type="password" name="password" class="cs_form_input @error('password') is-invalid @enderror"
                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                           placeholder="Minimum 8 characters">
                                    @error('password')
                                    <span class="cs_error_text" style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="cs_form_field cs_mb_30" style="margin-bottom: 30px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" class="cs_form_input"
                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                           placeholder="Re-enter new password">
                                </div>

                                <button type="submit" class="cs_btn cs_style_1">
                                    <span>Update Password</span>
                                    <i>
                                        <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.5 9L8.5 1M8.5 1L0.5 1M8.5 1L8.5 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="cs_height_100 cs_height_lg_70"></div>

@endsection
