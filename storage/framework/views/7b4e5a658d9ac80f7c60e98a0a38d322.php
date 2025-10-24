<header class="cs_site_header cs_style_1 cs_sticky_header">
    <div class="cs_main_header">
        <div class="container">
            <div class="cs_main_header_in">
                <div class="cs_main_header_left">
                    <a class="cs_site_branding" href="<?php echo e(route('home')); ?>">
                        <img src="<?php echo e(asset('frontOffice/img/logo.svg')); ?>" alt="Logo">
                    </a>
                </div>
                <div class="cs_main_header_center">
                    <div class="cs_nav">
                        <ul class="cs_nav_list">
                            <li>
                                <a href="<?php echo e(route('home')); ?>">Home</a>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#">Pages</a>
                                <ul>






                                    <li class="menu-item-has-children">
                                        <a href="<?php echo e(route('projects.index')); ?>">Projects</a>
                                        <ul>
                                            <li><a href="<?php echo e(route('projects.index')); ?>">My Projects</a></li>
                                            <li><a href="<?php echo e(route('projects.all')); ?>">All Projects</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo e(route('events.index')); ?>">Events</a></li>
                                    <li><a href="<?php echo e(route('activities.index')); ?>">Activities</a></li>
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if(Auth::user()->isPartner()): ?>
                                            <li><a href="<?php echo e(route('competitions.index')); ?>">Competitions</a></li>
                                        <?php endif; ?>
                                    <?php endif; ?>


                                    <li><a href="<?php echo e(route('greenspaces.page')); ?>">Green Spaces</a></li>
                                    <li><a href="<?php echo e(route('plants.page')); ?>">Plants</a></li>
                                </ul>
                            </li>

                            <li><a href="<?php echo e(route('currency.index')); ?>">Taux de Change</a></li>












                            <li><a href="<?php echo e(route('donations.index')); ?>">Donations</a></li>
                            <li><a href="<?php echo e(route('chatbot.front.index')); ?>">AI Assistant</a></li>

                        </ul>
                    </div>
                </div>
                <div class="cs_main_header_right">
                    <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isAssociation()): ?>
                        <!-- Notifications Bell -->
                        <div class="cs_notification_menu" style="margin-right: 15px;">
                            <button class="cs_btn cs_style_1 cs_btn_sm" id="notificationBtn" style="position: relative;">
                                <i class="fa-solid fa-bell"></i>
                                <span class="notification-badge" id="notificationBadge" style="display: none;">0</span>
                            </button>
                            <div class="cs_notification_dropdown" id="notificationDropdown" style="display: none;">
                                <div class="cs_notification_header">
                                    <h6>Notifications</h6>
                                    <span class="notification-count" id="notificationCount">0</span>
                                </div>
                                <div class="cs_notification_list" id="notificationList">
                                    <div class="text-center py-3">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="cs_notification_footer">
                                    <button type="button" class="btn btn-sm btn-primary" id="markAllRead" style="display: none;">Mark All as Read</button>
                                </div>
                                <div class="cs_debug_info" style="padding: 10px; background: #f8f9fa; border-top: 1px solid #dee2e6;">
                                    <small class="text-muted">Debug: <span id="debugInfo">Loading...</span></small>
                                </div>
                            </div>
                        </div>
                          <?php endif; ?>
                        <div class="cs_user_menu">
                            <button class="cs_btn cs_style_1 cs_btn_sm cs_user_btn" id="userMenuBtn">
                                <i class="fa-solid fa-user"></i>
                                <span><?php echo e(Auth::user()->full_name); ?></span>
                                <i class="fa-solid fa-chevron-down cs_dropdown_arrow"></i>
                            </button>
                            <div class="cs_user_dropdown" id="userDropdown">
                                <a href="<?php echo e(route('user.profile')); ?>" class="cs_dropdown_item">
                                    <i class="fa-solid fa-user-circle"></i> My Profile
                                </a>
                                <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin: 0;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="cs_dropdown_item cs_logout_btn">
                                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <button class="cs_btn cs_style_1 cs_btn_sm" id="loginBtn">
                            <i class="fa-solid fa-user"></i> Login
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Login/Signup Modal -->
<?php if(auth()->guard()->guest()): ?>
    <div class="cs_auth_modal <?php echo e(session('showLogin') || session('showSignup') || $errors->any() ? 'cs_active' : ''); ?>" id="authModal">
        <div class="cs_auth_modal_overlay" id="modalOverlay"></div>
        <div class="cs_auth_modal_content">
            <button class="cs_auth_modal_close" id="closeModal">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="cs_auth_forms">
                <!-- Login Form -->
                <div class="cs_auth_form <?php echo e(session('showSignup') ? 'cs_hidden' : ''); ?>" id="loginForm">
                    <div class="cs_auth_header">
                        <h2 class="cs_fs_38 cs_semibold cs_mb_15">Welcome Back!</h2>
                        <p class="cs_mb_30">Sign in to continue your environmental journey</p>
                    </div>

                    <?php if($errors->any() && session('showLogin')): ?>
                        <div class="cs_alert cs_alert_danger cs_mb_20">
                            <ul class="cs_mb_0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('login')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="cs_form_group cs_mb_20">
                            <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Email Address</label>
                            <input type="email" name="email" class="cs_form_input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="your@email.com" value="<?php echo e(old('email')); ?>" required>
                        </div>

                        <div class="cs_form_group cs_mb_20">
                            <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Password</label>
                            <input type="password" name="password" class="cs_form_input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="Enter your password" required>
                        </div>

                        <div class="cs_auth_options cs_mb_25">
                            <label class="cs_checkbox_label">
                                <input type="checkbox" name="remember">
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
                            <span>or sign in with</span>
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
                            <a href="#" class="cs_accent_color cs_semibold" id="showSignup">Create Account</a>
                        </p>
                    </form>
                </div>

                <!-- Signup Form -->
                <div class="cs_auth_form <?php echo e(session('showSignup') || $errors->any() ? '' : 'cs_hidden'); ?>" id="signupForm">
                    <div class="cs_auth_header">
                        <h2 class="cs_fs_38 cs_semibold cs_mb_15">Join Us Today!</h2>
                        <p class="cs_mb_30">Start making a difference for our planet</p>
                    </div>

                    <?php if($errors->any() && session('showSignup')): ?>
                        <div class="cs_alert cs_alert_danger cs_mb_20">
                            <ul class="cs_mb_0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('register')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="cs_form_group cs_mb_20">
                            <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Full Name</label>
                            <input type="text" name="full_name" class="cs_form_input <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="John Doe" value="<?php echo e(old('full_name')); ?>" required>
                        </div>

                        <div class="cs_form_group cs_mb_20">
                            <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Email Address</label>
                            <input type="email" name="email" class="cs_form_input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="your@email.com" value="<?php echo e(old('email')); ?>" required>
                        </div>

                        <div class="cs_form_group cs_mb_20">
                            <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">I am a...</label>
                            <select name="role" class="cs_form_input <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="" disabled <?php echo e(old('role') ? '' : 'selected'); ?>>Select your role</option>
                                <option value="volunteer" <?php echo e(old('role') === 'volunteer' ? 'selected' : ''); ?>>Volunteer</option>
                                <option value="association" <?php echo e(old('role') === 'association' ? 'selected' : ''); ?>>Association/NGO</option>
                                <option value="partner" <?php echo e(old('role') === 'partner' ? 'selected' : ''); ?>>Partner Organization</option>
                                <option value="supplier" <?php echo e(old('role') === 'supplier' ? 'selected' : ''); ?>>Supplier/Vendor</option>
                            </select>
                        </div>

                        <div class="cs_form_group cs_mb_20">
                            <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Password</label>
                            <input type="password" name="password" class="cs_form_input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="Create a strong password" required>
                        </div>

                        <div class="cs_form_group cs_mb_25">
                            <label class="cs_form_label cs_fs_18 cs_semibold cs_mb_10">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="cs_form_input"
                                   placeholder="Confirm your password" required>
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
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const authModal = document.getElementById('authModal');
        const loginBtn = document.getElementById('loginBtn');
        const closeModal = document.getElementById('closeModal');
        const modalOverlay = document.getElementById('modalOverlay');
        const showSignup = document.getElementById('showSignup');
        const showLogin = document.getElementById('showLogin');
        const loginForm = document.getElementById('loginForm');
        const signupForm = document.getElementById('signupForm');
        const userMenuBtn = document.getElementById('userMenuBtn');
        const userDropdown = document.getElementById('userDropdown');

        // Open modal
        if (loginBtn) {
            loginBtn.addEventListener('click', function() {
                authModal.classList.add('cs_active');
            });
        }

        // Close modal
        function closeAuthModal() {
            authModal.classList.remove('cs_active');
        }

        if (closeModal) {
            closeModal.addEventListener('click', closeAuthModal);
        }

        if (modalOverlay) {
            modalOverlay.addEventListener('click', closeAuthModal);
        }

        // Switch to signup
        if (showSignup) {
            showSignup.addEventListener('click', function(e) {
                e.preventDefault();
                loginForm.classList.add('cs_hidden');
                signupForm.classList.remove('cs_hidden');
            });
        }

        // Switch to login
        if (showLogin) {
            showLogin.addEventListener('click', function(e) {
                e.preventDefault();
                signupForm.classList.add('cs_hidden');
                loginForm.classList.remove('cs_hidden');
            });
        }

        // Notification system
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationDropdown = document.getElementById('notificationDropdown');

        if (notificationBtn) {
            notificationBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (notificationDropdown.style.display === 'none' || notificationDropdown.style.display === '') {
                    notificationDropdown.style.display = 'block';
                    loadNotifications();
                    loadNotificationCount();
                } else {
                    notificationDropdown.style.display = 'none';
                }
            });
        }

        // Close notification dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (notificationDropdown && !notificationBtn.contains(e.target) && !notificationDropdown.contains(e.target)) {
                notificationDropdown.style.display = 'none';
            }
        });

        // Load notifications every 30 seconds
        setInterval(function() {
            if (notificationDropdown.style.display === 'block') {
                loadNotifications();
                loadNotificationCount();
            }
        }, 30000);

        // Load notification count every 10 seconds
        setInterval(loadNotificationCount, 10000);

        // Mark all as read button
        const markAllRead = document.getElementById('markAllRead');
        if (markAllRead) {
            markAllRead.addEventListener('click', markAllAsRead);
        }

        // User menu dropdown
        if (userMenuBtn) {
            userMenuBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdown.classList.toggle('cs_show');
            });

            document.addEventListener('click', function(e) {
                if (!userMenuBtn.contains(e.target)) {
                    userDropdown.classList.remove('cs_show');
                }
            });
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && authModal && authModal.classList.contains('cs_active')) {
                closeAuthModal();
            }
        });

        // Notification functions
        function loadNotifications() {
            console.log('Loading notifications...');
            document.getElementById('debugInfo').textContent = 'Loading notifications...';

            fetch('<?php echo e(route("back.notifications.unread")); ?>')
                .then(response => response.json())
                .then(notifications => {
                    console.log('Notifications received:', notifications);
                    document.getElementById('debugInfo').textContent = 'Loaded ' + notifications.length + ' notifications';
                    displayNotifications(notifications);
                })
                .catch(error => {
                    console.error('Error loading notifications:', error);
                    document.getElementById('debugInfo').textContent = 'Notifications error: ' + error;
                    document.getElementById('notificationList').innerHTML = '<div class="text-center py-4 text-muted">Error loading notifications: ' + error + '</div>';
                });
        }

        function loadNotificationCount() {
            console.log('Loading notification count...');
            document.getElementById('debugInfo').textContent = 'Loading count...';

            fetch('<?php echo e(route("back.notifications.count")); ?>')
                .then(response => response.json())
                .then(response => {
                    console.log('Notification count received:', response);
                    const count = response.count;
                    document.getElementById('notificationCount').textContent = count;
                    document.getElementById('debugInfo').textContent = 'Count: ' + count;

                    if (count > 0) {
                        document.getElementById('notificationBadge').textContent = count;
                        document.getElementById('notificationBadge').style.display = 'inline';
                        document.getElementById('markAllRead').style.display = 'block';
                    } else {
                        document.getElementById('notificationBadge').style.display = 'none';
                        document.getElementById('markAllRead').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error loading notification count:', error);
                    document.getElementById('debugInfo').textContent = 'Count error: ' + error;
                });
        }

        function displayNotifications(notifications) {
            if (notifications.length === 0) {
                document.getElementById('notificationList').innerHTML = '<div class="text-center py-4 text-muted">No new notifications</div>';
                return;
            }

            let html = '';
            notifications.forEach(function(notification) {
                const data = notification.data;
                const timeAgo = getTimeAgo(notification.created_at);

                html += `
                    <div class="notification-item p-3 border-bottom" data-id="${notification.id}">
                        <div class="d-flex align-items-start gap-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-primary-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-trophy text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-semibold">Competition Invitation</h6>
                                <p class="mb-1 text-muted small">${data.message}</p>
                                <small class="text-muted">${timeAgo}</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary mark-read" data-id="${notification.id}">
                                Mark as read
                            </button>
                        </div>
                    </div>
                `;
            });

            document.getElementById('notificationList').innerHTML = html;

            // Add click handler for mark as read buttons
            document.querySelectorAll('.mark-read').forEach(button => {
                button.addEventListener('click', function() {
                    const notificationId = this.getAttribute('data-id');
                    markAsRead(notificationId);
                });
            });
        }

        function markAsRead(notificationId) {
            fetch(`<?php echo e(url('admin/notifications')); ?>/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(() => {
                document.querySelector(`.notification-item[data-id="${notificationId}"]`).style.display = 'none';
                loadNotificationCount();
            });
        }

        function markAllAsRead() {
            fetch('<?php echo e(route("back.notifications.read-all")); ?>', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(() => {
                document.getElementById('notificationList').innerHTML = '<div class="text-center py-4 text-muted">All notifications marked as read</div>';
                loadNotificationCount();
            });
        }

        function getTimeAgo(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffInSeconds = Math.floor((now - date) / 1000);

            if (diffInSeconds < 60) return 'Just now';
            if (diffInSeconds < 3600) return Math.floor(diffInSeconds / 60) + ' minutes ago';
            if (diffInSeconds < 86400) return Math.floor(diffInSeconds / 3600) + ' hours ago';
            return Math.floor(diffInSeconds / 86400) + ' days ago';
        }
    });
</script>

<style>
.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #dc3545;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cs_notification_dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    width: 350px;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    max-height: 400px;
    overflow-y: auto;
}

.cs_notification_header {
    padding: 15px;
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cs_notification_header h6 {
    margin: 0;
    font-weight: 600;
}

.notification-count {
    background: #007bff;
    color: white;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 600;
}

.cs_notification_list {
    max-height: 300px;
    overflow-y: auto;
}

.notification-item {
    transition: background-color 0.2s;
}

.notification-item:hover {
    background-color: #f8f9fa;
}

.cs_notification_footer {
    padding: 15px;
    text-align: center;
    border-top: 1px solid #dee2e6;
}

.cs_debug_info {
    font-size: 12px;
    color: #6c757d;
}
</style>
<?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/frontOffice/partials/header.blade.php ENDPATH**/ ?>