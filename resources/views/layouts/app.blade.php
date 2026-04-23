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

    <style>
        /* ── Reset & Base ─────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }

        :root {
            --sidebar-w: 230px;
            --header-h: 52px;
            --bg: #f0f2f5;
            --surface: #ffffff;
            --surface-2: #f7f8fa;
            --border: rgba(0,0,0,0.07);
            --text: #111827;
            --text-muted: #6b7280;
            --text-faint: #9ca3af;
            --accent: #4f46e5;
            --accent-light: #ede9fe;
            --accent-text: #4338ca;
            --danger: #ef4444;
            --danger-bg: #fef2f2;

            /* Sidebar tokens */
            --sb-bg: #0d0f14;
            --sb-border: rgba(255,255,255,0.06);
            --sb-text: rgba(255,255,255,0.45);
            --sb-text-hover: rgba(255,255,255,0.82);
            --sb-item-hover: rgba(255,255,255,0.05);
            --sb-item-active-bg: rgba(99,102,241,0.18);
            --sb-item-active-text: #a5b4fc;
            --sb-section: rgba(255,255,255,0.22);
        }

        body {
            font-family: 'Geist', 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            background: var(--bg);
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Prevent FOUC / jank ─────────────────────────── */
        [x-cloak] { display: none !important; }

        /* Page fade-in on load */
        body { animation: pageIn 180ms ease both; }
        @keyframes pageIn { from { opacity: 0; } to { opacity: 1; } }

        /* ── Layout Shell ────────────────────────────────── */
        .layout { display: flex; height: 100dvh; overflow: hidden; }

        /* ── Overlay (mobile) ────────────────────────────── */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 30;
            backdrop-filter: blur(2px);
        }
        @media (max-width: 767px) {
            .sidebar-overlay.active { display: block; }
        }

        /* ── Sidebar ─────────────────────────────────────── */
        .sidebar {
            position: relative;
            width: var(--sidebar-w);
            background: var(--sb-bg);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: width 260ms cubic-bezier(.4,0,.2,1),
            transform 260ms cubic-bezier(.4,0,.2,1);
            overflow: hidden;
            z-index: 40;
        }
        .sidebar.collapsed { width: 0; }

        @media (max-width: 767px) {
            .sidebar {
                position: fixed;
                left: 0; top: 0; bottom: 0;
                width: var(--sidebar-w) !important;
                transform: translateX(-100%);
            }
            .sidebar.mobile-open { transform: translateX(0); }
        }

        /* Brand / Logo */
        .sb-logo {
            display: flex; align-items: center; gap: 10px;
            padding: 16px 16px;
            border-bottom: 1px solid var(--sb-border);
            min-height: var(--header-h);
            white-space: nowrap;
        }
        .sb-logo-icon {
            width: 30px; height: 30px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(99,102,241,0.35);
        }
        .sb-logo-icon svg { width: 14px; height: 14px; color: #fff; }
        .sb-logo-label {
            font-size: 12.5px; font-weight: 600;
            color: rgba(255,255,255,0.88);
            letter-spacing: 0.01em;
            text-transform: capitalize;
        }

        /* Nav */
        .sb-nav { flex: 1; overflow-y: auto; overflow-x: hidden; padding: 10px 10px; }
        .sb-nav::-webkit-scrollbar { width: 3px; }
        .sb-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }

        .sb-section-label {
            font-size: 9.5px; font-weight: 600;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--sb-text);
            padding: 14px 10px 6px;
            white-space: nowrap;
            opacity: 0.55;
        }

        /* Nav Item */
        .sb-item {
            display: flex; align-items: center; gap: 9px;
            padding: 7.5px 10px;
            border-radius: 8px;
            font-size: 12.5px; font-weight: 500;
            color: var(--sb-text);
            text-decoration: none;
            transition: background 150ms, color 150ms;
            white-space: nowrap;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }
        .sb-item:hover { background: var(--sb-item-hover); color: var(--sb-text-hover); }
        .sb-item.active {
            background: var(--sb-item-active-bg);
            color: var(--sb-item-active-text);
        }
        .sb-item.active .sb-icon { color: var(--sb-item-active-text); }
        .sb-icon {
            width: 15px; height: 15px; flex-shrink: 0;
            color: rgba(255,255,255,0.35);
            transition: color 150ms;
        }
        .sb-item:hover .sb-icon { color: rgba(255,255,255,0.65); }
        .sb-item.sm-item { font-size: 12px; padding: 6px 10px; }

        /* Dropdown */
        .sb-dropdown { margin-left: 12px; margin-top: 2px; padding-left: 12px; border-left: 1px solid rgba(255,255,255,0.08); }
        .sb-chevron {
            margin-left: auto; width: 12px; height: 12px;
            opacity: 0.35; flex-shrink: 0;
            transition: transform 220ms ease;
        }
        .sb-chevron.rotated { transform: rotate(90deg); }

        /* Sidebar Footer */
        .sb-footer {
            padding: 10px 10px;
            border-top: 1px solid var(--sb-border);
        }

        /* ── Main Area ───────────────────────────────────── */
        .main { flex: 1; display: flex; flex-direction: column; min-width: 0; }

        /* ── Header ──────────────────────────────────────── */
        .topbar {
            height: var(--header-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: 8px;
            padding: 0 16px;
            flex-shrink: 0;
            position: sticky; top: 0; z-index: 20;
        }

        .topbar-toggle {
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px;
            border: none; background: transparent; cursor: pointer;
            color: var(--text-muted);
            transition: background 150ms, color 150ms;
            flex-shrink: 0;
        }
        .topbar-toggle:hover { background: var(--surface-2); color: var(--text); }

        /* Search */
        .topbar-search {
            position: relative;
            max-width: 200px;
            width: 100%;
        }
        .topbar-search svg {
            position: absolute; left: 10px; top: 50%; transform: translateY(-50%);
            width: 13px; height: 13px; color: var(--text-faint); pointer-events: none;
        }
        .topbar-search input {
            width: 100%;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 6px 12px 6px 32px;
            font-size: 12.5px; font-family: inherit;
            color: var(--text);
            outline: none;
            transition: border-color 150ms, box-shadow 150ms;
        }
        .topbar-search input::placeholder { color: var(--text-faint); }
        .topbar-search input:focus {
            border-color: rgba(99,102,241,0.45);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
        }

        /* Right side */
        .topbar-right { margin-left: auto; display: flex; align-items: center; gap: 4px; }

        .icon-btn {
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px; border: none; background: transparent; cursor: pointer;
            color: var(--text-muted); position: relative;
            transition: background 150ms, color 150ms;
        }
        .icon-btn:hover { background: var(--surface-2); color: var(--text); }
        .notif-dot {
            position: absolute; top: 6px; right: 6px;
            width: 6px; height: 6px;
            background: var(--danger); border-radius: 50%;
            border: 1.5px solid var(--surface);
        }

        .topbar-divider { width: 1px; height: 20px; background: var(--border); margin: 0 4px; }

        /* User menu */
        .user-btn {
            display: flex; align-items: center; gap: 8px;
            padding: 4px 8px 4px 4px;
            border-radius: 8px; border: none; background: transparent; cursor: pointer;
            transition: background 150ms;
        }
        .user-btn:hover { background: var(--surface-2); }
        .user-avatar {
            width: 28px; height: 28px; border-radius: 7px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            font-size: 10.5px; font-weight: 700; color: #fff; flex-shrink: 0;
        }
        .user-name { font-size: 12px; font-weight: 600; color: var(--text); line-height: 1; }
        .user-role { font-size: 10.5px; color: var(--text-faint); line-height: 1; margin-top: 2px; }

        /* Dropdown */
        .dropdown-menu {
            position: absolute; right: 0; top: calc(100% + 6px);
            width: 180px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.05);
            padding: 5px;
            z-index: 50;
            animation: dropIn 150ms ease both;
        }
        @keyframes dropIn {
            from { opacity: 0; transform: translateY(-6px) scale(0.98); }
            to   { opacity: 1; transform: translateY(0)  scale(1); }
        }
        .dropdown-item {
            display: flex; align-items: center; gap: 8px;
            padding: 8px 10px; border-radius: 7px;
            font-size: 12.5px; font-weight: 500; color: var(--text);
            text-decoration: none; cursor: pointer;
            transition: background 120ms;
            border: none; background: transparent; width: 100%; text-align: left;
        }
        .dropdown-item:hover { background: var(--surface-2); }
        .dropdown-item.danger { color: var(--danger); }
        .dropdown-item.danger:hover { background: var(--danger-bg); }
        .dropdown-divider { height: 1px; background: var(--border); margin: 4px 0; }

        /* ── Page Header ─────────────────────────────────── */
        .page-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 14px 20px;
            display: flex; align-items: center; gap: 12px;
        }
        .page-header h1 {
            font-size: 15px; font-weight: 600;
            color: var(--text); margin: 0;
        }

        /* ── Content ─────────────────────────────────────── */
        .page-content {
            flex: 1; overflow-y: auto;
            padding: 20px;
        }

        /* ── Responsive ──────────────────────────────────── */
        @media (max-width: 640px) {
            .topbar-search { max-width: 130px; }
            .user-name, .user-role { display: none; }
            .page-content { padding: 14px; }
        }
        @media (max-width: 767px) {
            .topbar-search { max-width: 150px; }
        }
    </style>
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
            @endcan

            <a href="{{ route('roles.index') }}"
               class="sb-item {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <svg class="sb-icon" viewBox="0 0 16 16" fill="none">
                    <path d="M8 1l2 4h4l-3 3 1 4-4-2.5L4 12l1-4L2 5h4z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                </svg>
                Roles
            </a>

            @can('admin_nav')
                <a href="{{ route('permissions.index') }}"
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
                            Admin
                        </a>
                    @endcan
                    @can('nav_administration')
                        <a href="#" class="sb-item sm-item">HR</a>
                        <a href="#" class="sb-item sm-item">Employee</a>
                    @endcan
                </div>
            @endcan

            <a href="#" class="sb-item">
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
