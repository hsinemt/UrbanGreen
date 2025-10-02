<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('back.home') }}" class="sidebar-logo">
            <img src="{{ asset('backOffice-assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('backOffice-assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('backOffice-assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
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
                        <a href="{{ route('back.home') }}" class="{{ request()->routeIs('back.home') ? 'active-page' : '' }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Home
                        </a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-menu-group-title">Application</li>

            <li>
                <a href="{{ route('back.users.index') }}" class="{{ request()->routeIs('back.users.*') ? 'active-page' : '' }}">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Users</span>
                </a>
            </li>

            <li>
                <a href="{{ route('resources.index') }}" class="{{ request()->routeIs('resources.*') ? 'active-page' : '' }}">
                    <iconify-icon icon="solar:box-outline" class="menu-icon"></iconify-icon>
                    <span>Resources</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
