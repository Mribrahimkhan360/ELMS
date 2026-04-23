{{-- resources/views/layouts/administrations.blade.php --}}
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Admin Panel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=geist:300,400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

{{-- Alpine Wrapper --}}
<div
    x-data="{
        sidebarOpen: window.innerWidth >= 768,
        mobileOpen: false,
        dropdownOpen: false,
        adminOpen: false,
        get isMobile() { return window.innerWidth < 768; },
        toggleSidebar() {
            if (this.isMobile) {
                this.mobileOpen = !this.mobileOpen;
            } else {
                this.sidebarOpen = !this.sidebarOpen;
            }
        }
    }"
    x-cloak
    class="layout"
>

    {{-- ─── Mobile Overlay ──────────────────────────── --}}
    <div
        class="sidebar-overlay"
        :class="{ 'active': mobileOpen }"
        @click="mobileOpen = false"
    ></div>

    {{-- ─── Sidebar ─────────────────────────────────── --}}
    <aside
        class="sidebar"
        :class="{
            'collapsed': !sidebarOpen && !isMobile,
            'mobile-open': mobileOpen
        }"
    >
        {{-- Logo --}}
        <div class="sb-logo">
            <div class="sb-logo-icon">
                <svg fill="none" viewBox="0 0 14 14">
                    <path d="M2 7h10M7 2v10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <span class="sb-logo-label">{{ auth()->user()->roles->pluck('name')->join(', ') }} Panel</span>
        </div>

        {{-- Navigation --}}
        <nav class="sb-nav">

            {{-- Section: Main --}}
            <p class="sb-section-label">Main</p>

            <a href="{{ route('dashboard') }}"
               class="sb-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="sb-icon" viewBox="0 0 16 16" fill="none">
                    <rect x="1" y="1" width="6" height="6" rx="1.5" fill="currentColor"/>
                    <rect x="9" y="1" width="6" height="6" rx="1.5" fill="currentColor"/>
                    <rect x="1" y="9" width="6" height="6" rx="1.5" fill="currentColor"/>
                    <rect x="9" y="9" width="6" height="6" rx="1.5" fill="currentColor"/>
                </svg>
                Dashboard
            </a>

            {{-- Section: Access --}}
            @can('admin_nav')
                <p class="sb-section-label">Access Control</p>

                <a href="{{ route('users.index') }}"
                   class="sb-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 16 16" fill="none">
                        <circle cx="8" cy="5" r="3" stroke="currentColor" stroke-width="1.4"/>
                        <path d="M2 13c0-2.5 2.7-4 6-4s6 1.5 6 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                    Users
                </a>


            <a href="{{ route('roles.index') }}"
               class="sb-item {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <svg class="sb-icon" viewBox="0 0 16 16" fill="none">
                    <path d="M8 1l2 4h4l-3 3 1 4-4-2.5L4 12l1-4L2 5h4z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                </svg>
                Roles
            </a>
            @endcan
            @can('admin_nav')
                <a href="{{ route('permissions.create') }}"
                   class="sb-item {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                    <svg class="sb-icon" viewBox="0 0 16 16" fill="none">
                        <rect x="2" y="5" width="12" height="9" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
                        <path d="M5 5V4a3 3 0 016 0v1" stroke="currentColor" stroke-width="1.4"/>
                    </svg>
                    Permissions
                </a>
            @endcan

            {{-- Section: Administration --}}
            <p class="sb-section-label">Administration</p>

            @can('nav_administration')
                <button
                    class="sb-item"
                    @click="adminOpen = !adminOpen"
                    :class="{ 'active': adminOpen }"
                >
                    <svg class="sb-icon" viewBox="0 0 16 16" fill="none">
                        <path d="M8 2v3M8 11v3M2 8h3M11 8h3M4 4l2 2M10 10l2 2M4 12l2-2M10 6l2-2"
                              stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                    </svg>
                    Administration
                    <svg class="sb-chevron" :class="{ 'rotated': adminOpen }" fill="none" viewBox="0 0 12 12">
                        <path d="M4 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <div x-show="adminOpen" x-collapse class="sb-dropdown">
                    @can('nav_nav_administration')
                        <a href="{{ route('administrations.index') }}"
                           class="sb-item sm-item {{ request()->routeIs('administrations.*') ? 'active' : '' }}">
                            {{ auth()->user()->roles->pluck('name')->join(', ') }}
                        </a>
                    @endcan
                </div>
            @endcan

            <a href="{{ route('leave.index') }}" class="sb-item">
                <svg class="sb-icon" viewBox="0 0 16 16" fill="none">
                    <rect x="2" y="2" width="12" height="12" rx="2" stroke="currentColor" stroke-width="1.4"/>
                    <path d="M5 8h6M5 5h4M5 11h3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
                Leave Applications
            </a>

        </nav>

        {{-- Sign Out --}}
        <div class="sb-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sb-item" style="color: rgba(255,255,255,0.3);">
                    <svg class="sb-icon" viewBox="0 0 16 16" fill="none">
                        <path d="M6 2H3a1 1 0 00-1 1v10a1 1 0 001 1h3M10 11l4-4-4-4M14 7H6"
                              stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- ─── Main Area ───────────────────────────────── --}}
    <div class="main">

        {{-- Topbar --}}
        <header class="topbar">

            {{-- Toggle Button --}}
            <button class="topbar-toggle" @click="toggleSidebar()">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M2 4h12M2 8h12M2 12h12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </button>

            {{-- Search --}}
            <div class="topbar-search">
                <svg viewBox="0 0 16 16" fill="none">
                    <circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M10.5 10.5l2.5 2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <input type="search" placeholder="Search…">
            </div>

            {{-- Right --}}
            <div class="topbar-right">

                {{-- Notifications --}}
                <button class="icon-btn">
                    <svg width="15" height="15" fill="none" viewBox="0 0 16 16">
                        <path d="M8 1a5 5 0 015 5c0 3 1 4 1 4H2s1-1 1-4a5 5 0 015-5zM6.5 13a1.5 1.5 0 003 0"
                              stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                    <span class="notif-dot"></span>
                </button>

                <div class="topbar-divider"></div>

                {{-- User Dropdown --}}
                <div x-data="{ open: false }" style="position:relative;">
                    <button class="user-btn" @click="open = !open">
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div class="hidden sm:block" style="text-align:left;">
                            <div class="user-name">{{ auth()->user()->name }}</div>
                            <div class="user-role">Administrator</div>
                        </div>
                        <svg width="10" height="10" fill="none" viewBox="0 0 12 12" style="color:#9ca3af;margin-left:2px;">
                            <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div x-show="open" @click.outside="open = false" x-transition.opacity class="dropdown-menu">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <svg width="13" height="13" fill="none" viewBox="0 0 16 16">
                                <circle cx="8" cy="5" r="3" stroke="currentColor" stroke-width="1.4"/>
                                <path d="M2 13c0-2.5 2.7-4 6-4s6 1.5 6 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                            </svg>
                            Profile Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item danger">
                                <svg width="13" height="13" fill="none" viewBox="0 0 16 16">
                                    <path d="M6 2H3a1 1 0 00-1 1v10a1 1 0 001 1h3M10 11l4-4-4-4M14 7H6"
                                          stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </header>

        {{-- Page Header --}}
        @isset($header)
            <div class="page-header">
                <h1>{{ $header }}</h1>
            </div>
        @endisset

        {{-- Page Content --}}
        <main class="page-content">
            {{ $slot }}
        </main>
    </div>

</div>

{{-- Alpine.js (load before DOM ready to avoid FOUC) --}}
<script src="//unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
