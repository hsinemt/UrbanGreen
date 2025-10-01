<div class="navbar-header">
    <div class="row align-items-center justify-content-between">
        <div class="col-auto">
            <div class="d-flex flex-wrap align-items-center gap-4">
                <button type="button" class="sidebar-toggle">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
                    <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
                </button>
                <button type="button" class="sidebar-mobile-toggle">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                </button>
                <form class="navbar-search">
                    <input type="text" name="search" placeholder="Search">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </form>
            </div>
        </div>
        <div class="col-auto">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <!-- Theme Toggle -->
                <button type="button" data-theme-toggle
                        class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center">
                </button>

                <!-- Language Dropdown -->
                <div class="dropdown d-none d-sm-inline-block">
                    <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                            type="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('backOffice-assets/images/lang-flag.png') }}" alt="image" class="w-24 h-24 object-fit-cover rounded-circle">
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-sm">
                        <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <h6 class="text-lg text-primary-light fw-semibold mb-0">Choose Your Language</h6>
                        </div>
                        <div class="max-h-400-px overflow-y-auto scroll-sm pe-8">
                            <div class="form-check style-check d-flex align-items-center justify-content-between mb-16">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="english">
                                    <span class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                        <img src="{{ asset('backOffice-assets/images/flags/flag1.png') }}" alt="" class="w-36-px h-36-px rounded-circle flex-shrink-0">
                                        <span class="text-md fw-semibold mb-0">English</span>
                                    </span>
                                </label>
                                <input class="form-check-input" type="radio" name="language" id="english" checked>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Messages Dropdown -->
                <div class="dropdown">
                    <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                            type="button" data-bs-toggle="dropdown">
                        <iconify-icon icon="mage:email" class="text-primary-light text-xl"></iconify-icon>
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-lg p-0">
                        <div class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <h6 class="text-lg text-primary-light fw-semibold mb-0">Message</h6>
                            <span class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center">05</span>
                        </div>
                        <div class="max-h-400-px overflow-y-auto scroll-sm pe-4">
                            <!-- Message items here -->
                        </div>
                        <div class="text-center py-12 px-16">
                            <a href="javascript:void(0)" class="text-primary-600 fw-semibold text-md">See All Message</a>
                        </div>
                    </div>
                </div>

                <!-- Notifications Dropdown -->
                <div class="dropdown">
                    <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"
                            type="button" data-bs-toggle="dropdown">
                        <iconify-icon icon="iconoir:bell" class="text-primary-light text-xl"></iconify-icon>
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-lg p-0">
                        <div class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <h6 class="text-lg text-primary-light fw-semibold mb-0">Notifications</h6>
                            <span class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center">05</span>
                        </div>
                        <div class="max-h-400-px overflow-y-auto scroll-sm pe-4">
                            <!-- Notification items here -->
                        </div>
                        <div class="text-center py-12 px-16">
                            <a href="javascript:void(0)" class="text-primary-600 fw-semibold text-md">See All Notification</a>
                        </div>
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <div class="dropdown">
                    <button class="d-flex justify-content-center align-items-center rounded-circle" type="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('backOffice-assets/images/user.png') }}" alt="image" class="w-40-px h-40-px object-fit-cover rounded-circle">
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-sm">
                        <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <h6 class="text-lg text-primary-light fw-semibold mb-2">{{ auth()->user()->name ?? 'User Name' }}</h6>
                                <span class="text-secondary-light fw-medium text-sm">Admin</span>
                            </div>
                            <button type="button" class="hover-text-danger">
                                <iconify-icon icon="radix-icons:cross-1" class="icon text-xl"></iconify-icon>
                            </button>
                        </div>
                        <ul class="to-top-list">
                            <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                                   href="{{ url('view-profile.html') }}">
                                    <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon> My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                                   href="{{ url('email.html') }}">
                                    <iconify-icon icon="tabler:message-check" class="icon text-xl"></iconify-icon> Inbox
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                                   href="{{ url('company.html') }}">
                                    <iconify-icon icon="icon-park-outline:setting-two" class="icon text-xl"></iconify-icon> Setting
                                </a>
                            </li>
{{--                            <li>--}}
{{--                                <form method="POST" action="{{ route('logout') }}">--}}
{{--                                    @csrf--}}
{{--                                    <button type="submit" class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3 border-0 bg-transparent w-100 text-start">--}}
{{--                                        <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon> Log Out--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
