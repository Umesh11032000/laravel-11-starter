<aside class="app-sidebar sticky" id="sidebar">
    <div class="main-sidebar-header">
        <a href="index.html" class="header-logo">
            <img src="{{ asset('assets/images/brand-logos/desktop-logo.png') }}" alt="logo" class="desktop-logo">
            <img src="{{ asset('assets/images/brand-logos/toggle-logo.png') }}" alt="logo" class="toggle-logo">
            <img src="{{ asset('assets/images/brand-logos/desktop-dark.png') }}" alt="logo" class="desktop-dark">
            <img src="{{ asset('assets/images/brand-logos/toggle-dark.png') }}" alt="logo" class="toggle-dark">
            <img src="{{ asset('assets/images/brand-logos/desktop-white.png') }}" alt="logo" class="desktop-white">
            <img src="{{ asset('assets/images/brand-logos/toggle-white.png') }}" alt="logo" class="toggle-white">
        </a>
    </div>
    <div class="main-sidebar" id="sidebar-scroll" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: -8px 0px -80px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                        style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 8px 0px 80px;">
                            <nav class="main-menu-container nav nav-pills flex-column sub-open open active">
                                <div class="slide-left active d-none" id="slide-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                                        </path>
                                    </svg>
                                </div>
                                <ul class="main-menu">
                                    <li
                                        class="slide has-sub {{ request()->routeIs('admin.dashboard.index') ? 'active open' : '' }}">
                                        <a href="javascript:void(0);"
                                            class="side-menu__item {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
                                            <i class="bx bx-home side-menu__icon"></i>
                                            <span class="side-menu__label">
                                                {{ __('menu.dashboard') }}
                                            </span>
                                            <i class="fe fe-chevron-right side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child1 {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}"
                                            data-popper-placement="bottom">
                                            <li class="slide side-menu__label1">
                                                <a href="javascript:void(0)">
                                                    {{ __('menu.dashboard') }}
                                                </a>
                                            </li>
                                            <li
                                                class="slide {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
                                                <a href="{{ route('admin.dashboard.index') }}"
                                                    class="side-menu__item {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
                                                    {{ __('menu.analytics') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>


                                    @if (auth()->user()->hasPermissionTo('view-all-users'))
                                        <li
                                            class="slide has-sub {{ request()->routeIs('admin.users.index') ? 'active open' : '' }}">
                                            <a href="javascript:void(0);"
                                                class="side-menu__item {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                                <i class="bx bx-user side-menu__icon"></i>
                                                <span class="side-menu__label">
                                                    {{ __('menu.users') }}
                                                </span>
                                                <i class="fe fe-chevron-right side-menu__angle"></i>
                                            </a>
                                            <ul class="slide-menu child1 {{ request()->routeIs('admin.users.index') ? 'active' : '' }}"
                                                data-popper-placement="bottom">
                                                <li class="slide side-menu__label1">
                                                    <a href="javascript:void(0)">
                                                        {{ __('menu.users') }}
                                                    </a>
                                                </li>
                                                <li
                                                    class="slide {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                                    <a href="{{ route('admin.users.index') }}"
                                                        class="side-menu__item {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                                        {{ __('menu.users') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif

                                    @if (auth()->user()->hasRole('Super Admin'))
                                        <li class="slide">
                                            <a href="{{ route('admin.roles.index') }}"
                                                class="side-menu__item {{ request()->routeIs('admin.roles.index') ? 'active' : '' }}">
                                                <i class="bx bx-shield side-menu__icon"></i>
                                                <span class="side-menu__label">
                                                    {{ __('menu.roles') }}
                                                </span>
                                            </a>
                                        </li>

                                        <li class="slide">
                                            <a href="{{ route('admin.activities.index') }}"
                                                class="side-menu__item {{ request()->routeIs('admin.activities.index') ? 'active' : '' }}">
                                                <i class="bx bx-bell side-menu__icon"></i>
                                                <span class="side-menu__label">
                                                    {{ __('menu.activities') }}
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>

                                <div class="slide-right d-none" id="slide-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                        </path>
                                    </svg>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 1522px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                style="height: 570px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div>
    </div>
</aside>
