<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="<?php echo e(route('back.home')); ?>" class="sidebar-logo">
            <img src="<?php echo e(asset('backOffice-assets/images/logo.png')); ?>" alt="site logo" class="light-logo">
            <img src="<?php echo e(asset('backOffice-assets/images/logo-light.png')); ?>" alt="site logo" class="dark-logo">
            <img src="<?php echo e(asset('backOffice-assets/images/logo-icon.png')); ?>" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?php echo e(route('back.home')); ?>" class="<?php echo e(request()->routeIs('back.home') ? 'active-page' : ''); ?>">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Home
                        </a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-menu-group-title">Application</li>

            <li>
                <a href="<?php echo e(route('back.users.index')); ?>" class="<?php echo e(request()->routeIs('back.users.*') ? 'active-page' : ''); ?>">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Users</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('resource.index')); ?>" class="<?php echo e(request()->routeIs('resource.*') ? 'active-page' : ''); ?>">
                    <iconify-icon icon="solar:box-outline" class="menu-icon"></iconify-icon>
                    <span>Resources</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('back.feedback.index')); ?>" class="<?php echo e(request()->routeIs('back.feedback.*') ? 'active-page' : ''); ?>">
                    <iconify-icon icon="solar:chat-round-line-outline" class="menu-icon"></iconify-icon>
                    <span>Feedback</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.wallets.index')); ?>" class="<?php echo e(request()->routeIs('admin.wallets.*') ? 'active-page' : ''); ?>">
                    <iconify-icon icon="solar:wallet-money-outline" class="menu-icon"></iconify-icon>
                    <span>Wallets</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.green-spaces.index')); ?>" class="<?php echo e(request()->routeIs('admin.green-spaces.*') ? 'active-page' : ''); ?>">
                    <iconify-icon icon="solar:leaf-outline" class="menu-icon"></iconify-icon>
                    <span>Green Spaces</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.plants.index')); ?>" class="<?php echo e(request()->routeIs('admin.plants.*') ? 'active-page' : ''); ?>">
                    <iconify-icon icon="solar:plant-outline" class="menu-icon"></iconify-icon>
                    <span>Plants</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.chatbot.index')); ?>" class="<?php echo e(request()->routeIs('admin.chatbot.*') ? 'active-page' : ''); ?>">
                    <iconify-icon icon="solar:chat-round-outline" class="menu-icon"></iconify-icon>
                    <span>AI Assistant</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('back.activities.index')); ?>" class="<?php echo e(request()->routeIs('back.activities.*') ? 'active-page' : ''); ?>">
                    <iconify-icon icon="solar:activity-outline" class="menu-icon"></iconify-icon>
                    <span>Activities</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('back.events.index')); ?>" class="<?php echo e(request()->routeIs('back.events.*') ? 'active-page' : ''); ?>">
                    <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
                    <span>Events</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('back.projects.index')); ?>" class="<?php echo e(request()->routeIs('back.projects.*') ? 'active-page' : ''); ?>">
                    <iconify-icon icon="solar:folder-outline" class="menu-icon"></iconify-icon>
                    <span>Projects</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('back.competitions.index')); ?>" class="<?php echo e(request()->routeIs('back.competitions.*') ? 'active-page' : ''); ?>">
                    <iconify-icon icon="solar:trophy-outline" class="menu-icon"></iconify-icon>
                    <span>Competitions</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<?php /**PATH E:\Education\Laravel\project\UrbanGreen\resources\views/dashboard/partials/sidebar.blade.php ENDPATH**/ ?>