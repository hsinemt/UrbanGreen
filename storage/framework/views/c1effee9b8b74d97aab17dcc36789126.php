<?php $__env->startSection('title', 'My Profile - UrbanGreen'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .cs_action_btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 12px;
            margin-bottom: 12px;
            transition: all 0.3s;
            text-decoration: none;
            color: #1a1a1a;
            width: 100%;
            box-sizing: border-box;
        }

        .cs_action_btn:hover {
            background: #4CAF50;
            color: #fff;
            transform: translateX(5px);
            box-shadow: 0 3px 15px rgba(76, 175, 80, 0.3);
        }

        .cs_action_btn:hover i {
            color: #fff !important;
        }

        .cs_action_btn span {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 500;
        }

        .cs_action_btn i {
            color: #4CAF50;
            font-size: 16px;
            min-width: 20px;
            transition: color 0.3s;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="cs_page_header" style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); padding: 80px 0 60px; position: relative;">
        <div class="container">
            <div class="cs_page_header_in" style="position: relative; z-index: 1;">
                <h1 class="cs_fs_72 cs_bold" style="color: #fff; margin-bottom: 15px;">My Profile</h1>
                <p style="color: rgba(255, 255, 255, 0.9); font-size: 16px;">
                    <?php if(Auth::user()->isAssociation()): ?>
                        <i class="fa-solid fa-building"></i> Association Account
                    <?php elseif(Auth::user()->isSupplier()): ?>
                        <i class="fa-solid fa-store"></i> Supplier Account
                    <?php elseif(Auth::user()->isPartner()): ?>
                        <i class="fa-solid fa-handshake"></i> Partner Account
                    <?php elseif(Auth::user()->isVolunteer()): ?>
                        <i class="fa-solid fa-hand-holding-heart"></i> Volunteer Account
                    <?php elseif(Auth::user()->isAdmin()): ?>
                        <i class="fa-solid fa-user-shield"></i> Admin Account
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </section>

    <div class="cs_height_100 cs_height_lg_70"></div>

    <!-- Success Message -->
    <?php if(session('success')): ?>
        <div class="container">
            <div class="alert alert-success" style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 20px; border-radius: 20px; display: flex; align-items: center; gap: 15px; margin-bottom: 30px;">
                <i class="fa-solid fa-check-circle" style="font-size: 24px; color: #28a745;"></i>
                <?php echo e(session('success')); ?>

            </div>
        </div>
    <?php endif; ?>

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
                                    <img src="<?php echo e(Auth::user()->avatar_url); ?>" alt="<?php echo e(Auth::user()->name); ?>"
                                         style="width: 140px; height: 140px; border-radius: 50%; object-fit: cover; border: 5px solid #4CAF50; box-shadow: 0 5px 20px rgba(76, 175, 80, 0.3);">
                                    <button type="button" class="cs_avatar_edit_btn" onclick="document.getElementById('avatarInput').click()"
                                            style="position: absolute; bottom: 5px; right: 5px; width: 40px; height: 40px; border-radius: 50%; background: #4CAF50; border: 3px solid #fff; color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);">
                                        <i class="fa-solid fa-camera"></i>
                                    </button>
                                </div>

                                <!-- Hidden Avatar Upload Form -->
                                <form id="avatarForm" action="<?php echo e(route('profile.avatar')); ?>" method="POST" enctype="multipart/form-data" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                    <input type="file" id="avatarInput" name="avatar" accept="image/*" onchange="document.getElementById('avatarForm').submit()">
                                </form>

                                <h3 class="cs_fs_24 cs_semibold cs_mt_20 cs_mb_5"><?php echo e(Auth::user()->display_name); ?></h3>
                                <p class="cs_profile_email cs_mb_15" style="color: #666; font-size: 15px;"><?php echo e(Auth::user()->email); ?></p>
                                <span class="cs_member_badge" style="display: inline-block; background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); color: #fff; padding: 8px 20px; border-radius: 50px; font-size: 13px; font-weight: 600;">
                                    <i class="fa-solid fa-leaf" style="margin-right: 5px;"></i> Member Since <?php echo e(Auth::user()->created_at->format('M Y')); ?>

                                </span>
                            </div>

                            <div class="cs_profile_stats" style="padding-top: 30px;">
                                <div class="cs_stat_item" style="display: flex; align-items: center; gap: 15px; padding: 20px 0; border-bottom: 1px solid #f5f5f5;">
                                    <div class="cs_stat_icon" style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); display: flex; align-items: center; justify-content: center; color: #4CAF50; font-size: 20px;">
                                        <i class="fa-solid fa-heart"></i>
                                    </div>
                                    <div class="cs_stat_content" style="flex: 1;">
                                        <h4 class="cs_fs_32 cs_semibold cs_accent_color" style="margin-bottom: 5px;"><?php echo e(Auth::user()->projets->count()); ?></h4>
                                        <p class="cs_fs_14" style="color: #666; margin: 0;">Projects</p>
                                    </div>
                                </div>
                                <?php if(Auth::user()->isVolunteer()): ?>
                                    <div class="cs_stat_item" style="display: flex; align-items: center; gap: 15px; padding: 20px 0; border-bottom: 1px solid #f5f5f5;">
                                        <div class="cs_stat_icon" style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); display: flex; align-items: center; justify-content: center; color: #4CAF50; font-size: 20px;">
                                            <i class="fa-solid fa-clock"></i>
                                        </div>
                                        <div class="cs_stat_content" style="flex: 1;">
                                            <h4 class="cs_fs_32 cs_semibold cs_accent_color" style="margin-bottom: 5px;"><?php echo e(Auth::user()->hours_contributed); ?></h4>
                                            <p class="cs_fs_14" style="color: #666; margin: 0;">Hours Contributed</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="cs_stat_item" style="display: flex; align-items: center; gap: 15px; padding: 20px 0;">
                                    <div class="cs_stat_icon" style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); display: flex; align-items: center; justify-content: center; color: #4CAF50; font-size: 20px;">
                                        <i class="fa-solid fa-calendar-check"></i>
                                    </div>
                                    <div class="cs_stat_content" style="flex: 1;">
                                        <h4 class="cs_fs_32 cs_semibold cs_accent_color" style="margin-bottom: 5px;">0</h4>
                                        <p class="cs_fs_14" style="color: #666; margin: 0;">Events</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="cs_profile_card cs_white_bg cs_radius_20" style="padding: 35px; box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08); border-radius: 20px; background: #fff;">
                            <h4 class="cs_fs_20 cs_semibold" style="margin-bottom: 20px;">Quick Actions</h4>
                            <div class="cs_quick_actions">
                                <a href="<?php echo e(route('projects.create')); ?>" class="cs_action_btn">
                                    <i class="fa-solid fa-plus"></i>
                                    <span>Create Project</span>
                                </a>
                                <a href="<?php echo e(route('donations.index')); ?>" class="cs_action_btn">
                                    <i class="fa-solid fa-hand-holding-heart"></i>
                                    <span>Make Donation</span>
                                </a>
                                <a href="<?php echo e(route('events.index')); ?>" class="cs_action_btn">
                                    <i class="fa-solid fa-calendar"></i>
                                    <span>Browse Events</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="cs_profile_main">
                        <!-- Basic Information -->
                        <div class="cs_profile_card cs_white_bg cs_radius_20" style="padding: 35px; box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08); border-radius: 20px; background: #fff; margin-bottom: 30px;">
                            <div class="cs_card_header" style="padding-bottom: 25px; border-bottom: 1px solid #e8e8e8; margin-bottom: 30px;">
                                <h3 class="cs_fs_24 cs_semibold" style="margin-bottom: 5px; color: #1a1a1a;">Basic Information</h3>
                                <p class="cs_fs_14 cs_heading_color" style="color: #666; margin: 0;">Update your personal details</p>
                            </div>

                            <form action="<?php echo e(route('profile.update')); ?>" method="POST" class="cs_profile_form">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="hidden" name="section" value="basic">

                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Full Name</label>
                                    <input type="text" name="full_name" class="cs_form_input <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           value="<?php echo e(old('full_name', $user->full_name)); ?>"
                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;" required>
                                    <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="cs_error_text" style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Email Address</label>
                                    <input type="email" name="email" class="cs_form_input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           value="<?php echo e(old('email', $user->email)); ?>"
                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;" required>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="cs_error_text" style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Phone Number</label>
                                    <input type="tel" name="phone" class="cs_form_input"
                                           value="<?php echo e(old('phone', $user->phone)); ?>"
                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                           placeholder="+216 XX XXX XXX">
                                </div>

                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Address</label>
                                    <input type="text" name="address" class="cs_form_input"
                                           value="<?php echo e(old('address', $user->address)); ?>"
                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                           placeholder="Your address">
                                </div>

                                <div class="cs_form_field cs_mb_30" style="margin-bottom: 30px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Bio</label>
                                    <textarea name="bio" class="cs_form_input" rows="4"
                                              style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                              placeholder="Tell us about yourself..."><?php echo e(old('bio', $user->bio)); ?></textarea>
                                </div>

                                <button type="submit" class="cs_btn cs_style_1">
                                    <span>Update Basic Info</span>
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

                        <!-- Role-Specific Information -->
                        <?php if(!Auth::user()->isAdmin()): ?>
                            <div class="cs_profile_card cs_white_bg cs_radius_20" style="padding: 35px; box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08); border-radius: 20px; background: #fff; margin-bottom: 30px;">
                                <div class="cs_card_header" style="padding-bottom: 25px; border-bottom: 1px solid #e8e8e8; margin-bottom: 30px;">
                                    <h3 class="cs_fs_24 cs_semibold" style="margin-bottom: 5px; color: #1a1a1a;">
                                        <?php if(Auth::user()->isAssociation()): ?>
                                            Association Information
                                        <?php elseif(Auth::user()->isSupplier()): ?>
                                            Supplier Information
                                        <?php elseif(Auth::user()->isPartner()): ?>
                                            Partner Information
                                        <?php elseif(Auth::user()->isVolunteer()): ?>
                                            Volunteer Information
                                        <?php endif; ?>
                                    </h3>
                                    <p class="cs_fs_14 cs_heading_color" style="color: #666; margin: 0;">Complete your profile with role-specific details</p>
                                </div>

                                <form action="<?php echo e(route('profile.update')); ?>" method="POST" class="cs_profile_form">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="hidden" name="section" value="role">

                                    <?php if(Auth::user()->isAssociation()): ?>
                                        <!-- Association Fields -->
                                        <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">
                                                Organization Name
                                            </label>
                                            <input type="text" name="organization_name" class="cs_form_input"
                                                   value="<?php echo e(old('organization_name', $user->association?->organization_name)); ?>"
                                                   style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Registration Number</label>
                                                    <input type="text" name="registration_number" class="cs_form_input"
                                                           value="<?php echo e(old('registration_number', $user->association?->registration_number)); ?>"
                                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Founded Year</label>
                                                    <input type="number" name="founded_year" class="cs_form_input" min="1800" max="<?php echo e(date('Y')); ?>"
                                                           value="<?php echo e(old('founded_year', $user->association?->founded_year)); ?>"
                                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Website</label>
                                                    <input type="url" name="website" class="cs_form_input"
                                                           value="<?php echo e(old('website', $user->association?->website)); ?>"
                                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                           placeholder="https://example.com">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Number of Members</label>
                                                    <input type="number" name="number_of_members" class="cs_form_input" min="0"
                                                           value="<?php echo e(old('number_of_members', $user->association?->number_of_members)); ?>"
                                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Organization Type</label>
                                            <input type="text" name="organization_type" class="cs_form_input"
                                                   value="<?php echo e(old('organization_type', $user->association?->organization_type)); ?>"
                                                   style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                   placeholder="NGO, Non-profit, Community group, etc.">
                                        </div>

                                        <div class="cs_form_field cs_mb_30" style="margin-bottom: 30px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Mission Statement</label>
                                            <textarea name="mission_statement" class="cs_form_input" rows="4"
                                                      style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                      placeholder="Describe your organization's mission..."><?php echo e(old('mission_statement', $user->association?->mission_statement)); ?></textarea>
                                        </div>

                                    <?php elseif(Auth::user()->isSupplier()): ?>
                                        <!-- Supplier Fields -->
                                        <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">
                                                Company Name
                                            </label>
                                            <input type="text" name="company_name" class="cs_form_input"
                                                   value="<?php echo e(old('company_name', $user->supplier?->company_name)); ?>"
                                                   style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Business Type</label>
                                                    <input type="text" name="business_type" class="cs_form_input"
                                                           value="<?php echo e(old('business_type', $user->supplier?->business_type)); ?>"
                                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                           placeholder="Food, Equipment, Materials, etc.">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Rating</label>
                                                    <input type="number" name="rating" class="cs_form_input" min="0" max="5" step="0.1"
                                                           value="<?php echo e(old('rating', $user->supplier?->rating)); ?>"
                                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                           placeholder="0.0 - 5.0">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Delivery Options</label>
                                            <input type="text" name="delivery_options" class="cs_form_input"
                                                   value="<?php echo e(old('delivery_options', $user->supplier?->delivery_options)); ?>"
                                                   style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                   placeholder="Standard, Express, Same-day, etc.">
                                        </div>

                                        <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Payment Terms</label>
                                            <input type="text" name="payment_terms" class="cs_form_input"
                                                   value="<?php echo e(old('payment_terms', $user->supplier?->payment_terms)); ?>"
                                                   style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                   placeholder="Net 30, COD, etc.">
                                        </div>

                                        <div class="cs_form_field cs_mb_30" style="margin-bottom: 30px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Product Catalog</label>
                                            <textarea name="product_catalog" class="cs_form_input" rows="4"
                                                      style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                      placeholder="List your products and services..."><?php echo e(old('product_catalog', $user->supplier?->product_catalog)); ?></textarea>
                                        </div>

                                    <?php elseif(Auth::user()->isPartner()): ?>
                                        <!-- Partner Fields -->
                                        <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">
                                                Organization Name
                                            </label>
                                            <input type="text" name="organization_name" class="cs_form_input"
                                                   value="<?php echo e(old('organization_name', $user->partner?->organization_name)); ?>"
                                                   style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Partnership Type</label>
                                                    <input type="text" name="partnership_type" class="cs_form_input"
                                                           value="<?php echo e(old('partnership_type', $user->partner?->partnership_type)); ?>"
                                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                           placeholder="Corporate, Institutional, Media, etc.">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Industry Sector</label>
                                                    <input type="text" name="industry_sector" class="cs_form_input"
                                                           value="<?php echo e(old('industry_sector', $user->partner?->industry_sector)); ?>"
                                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                           placeholder="Technology, Finance, etc.">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Partnership Start Date</label>
                                                    <input type="date" name="partnership_start_date" class="cs_form_input"
                                                           value="<?php echo e(old('partnership_start_date', $user->partner?->partnership_start_date?->format('Y-m-d'))); ?>"
                                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Contact Person</label>
                                                    <input type="text" name="contact_person" class="cs_form_input"
                                                           value="<?php echo e(old('contact_person', $user->partner?->contact_person)); ?>"
                                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cs_form_field cs_mb_30" style="margin-bottom: 30px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Contribution Type</label>
                                            <input type="text" name="contribution_type" class="cs_form_input"
                                                   value="<?php echo e(old('contribution_type', $user->partner?->contribution_type)); ?>"
                                                   style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                   placeholder="Financial, In-kind, Expertise, etc.">
                                        </div>

                                    <?php elseif(Auth::user()->isVolunteer()): ?>
                                        <!-- Volunteer Fields -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Date of Birth</label>
                                                    <input type="date" name="date_of_birth" class="cs_form_input"
                                                           value="<?php echo e(old('date_of_birth', $user->volunteer?->date_of_birth?->format('Y-m-d'))); ?>"
                                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Volunteer ID</label>
                                                    <input type="text" name="volunteer_id_number" class="cs_form_input"
                                                           value="<?php echo e(old('volunteer_id_number', $user->volunteer?->volunteer_id_number)); ?>"
                                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Availability</label>
                                            <input type="text" name="availability" class="cs_form_input"
                                                   value="<?php echo e(old('availability', $user->volunteer?->availability)); ?>"
                                                   style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                   placeholder="Weekdays, Weekends, Evenings, etc.">
                                        </div>

                                        <div class="cs_form_field cs_mb_30" style="margin-bottom: 30px;">
                                            <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Skills</label>
                                            <textarea name="skills" class="cs_form_input" rows="4"
                                                      style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                                      placeholder="List your skills (comma-separated): gardening, teaching, event planning..."><?php echo e(old('skills', $user->volunteer?->skills)); ?></textarea>
                                        </div>
                                    <?php endif; ?>

                                    <button type="submit" class="cs_btn cs_style_1">
                                        <span>Update Role Information</span>
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
                        <?php endif; ?>

                        <!-- Change Password -->
                        <div class="cs_profile_card cs_white_bg cs_radius_20" style="padding: 35px; box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08); border-radius: 20px; background: #fff;">
                            <div class="cs_card_header" style="padding-bottom: 25px; border-bottom: 1px solid #e8e8e8; margin-bottom: 30px;">
                                <h3 class="cs_fs_24 cs_semibold" style="margin-bottom: 5px; color: #1a1a1a;">Change Password</h3>
                                <p class="cs_fs_14 cs_heading_color" style="color: #666; margin: 0;">Ensure your account is secure</p>
                            </div>

                            <form action="<?php echo e(route('profile.update')); ?>" method="POST" class="cs_profile_form">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="hidden" name="section" value="password">

                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">Current Password</label>
                                    <input type="password" name="current_password" class="cs_form_input <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;">
                                    <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="cs_error_text" style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="cs_form_field cs_mb_25" style="margin-bottom: 25px;">
                                    <label class="cs_input_label cs_fs_16 cs_semibold" style="display: block; color: #1a1a1a; margin-bottom: 10px;">New Password</label>
                                    <input type="password" name="password" class="cs_form_input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           style="width: 100%; padding: 14px 20px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 15px; background: #fafafa;"
                                           placeholder="Minimum 8 characters">
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="cs_error_text" style="color: #dc3545; font-size: 13px; display: block; margin-top: 5px;"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontOffice.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/pages/profile.blade.php ENDPATH**/ ?>