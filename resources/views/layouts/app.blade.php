{{-- resources/views/layouts/administrations.blade.php --}}
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Admin Panel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="antialiased bg-[#f4f5f7]">

<div x-data="{ sidebarOpen: true }" class="flex h-screen overflow-hidden">

    {{-- ─── Sidebar ─────────────────────────────────────── --}}
    <aside
        :class="sidebarOpen ? 'w-56' : 'w-0 overflow-hidden'"
        class="bg-[#0f1117] flex flex-col shrink-0 transition-all duration-300"
    >

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-4 py-[18px] border-b border-white/[0.07]">
            <div class="w-7 h-7 rounded-[7px] bg-indigo-500 flex items-center justify-center shrink-0">
                <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 14 14">
                    <path d="M2 7h10M7 2v10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <span class="text-[13px] font-semibold text-white tracking-wide capitalize">{{ auth()->user()->roles->pluck('name')->join(', ') }} Panel</span>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto px-2.5 py-3 space-y-0.5">

            {{-- Section: Main --}}
            <p class="text-[10px] font-semibold uppercase tracking-widest text-white/30 px-2 pt-2 pb-1.5">Main</p>

            <x-admin-nav-item href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                <x-slot name="icon">
                    <rect x="1" y="1" width="6" height="6" rx="1.5" fill="currentColor"/>
                    <rect x="9" y="1" width="6" height="6" rx="1.5" fill="currentColor"/>
                    <rect x="1" y="9" width="6" height="6" rx="1.5" fill="currentColor"/>
                    <rect x="9" y="9" width="6" height="6" rx="1.5" fill="currentColor"/>
                </x-slot>
                Dashboard
            </x-admin-nav-item>

            {{-- Section: Access Control --}}
            @can('admin_nav')
                <p class="text-[10px] font-semibold uppercase tracking-widest text-white/30 px-2 pt-4 pb-1.5">Access</p>
                <x-admin-nav-item :href="route('users.index')">
                    <x-slot name="icon">
                        <circle cx="8" cy="5" r="3" stroke="currentColor" stroke-width="1.4"/>
                        <path d="M2 13c0-2.5 2.7-4 6-4s6 1.5 6 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </x-slot>
                    Users
                </x-admin-nav-item>
            @endcan

            {{--            @can('admin_nav')--}}
            <x-admin-nav-item :href="route('roles.index')">
                <x-slot name="icon">
                    <path d="M8 1l2 4h4l-3 3 1 4-4-2.5L4 12l1-4L2 5h4z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                </x-slot>
                Roles
            </x-admin-nav-item>
            {{--            @endcan--}}
            @can('admin_nav')
                <x-admin-nav-item :href="route('permissions.index')">
                    <x-slot name="icon">
                        <rect x="2" y="5" width="12" height="9" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
                        <path d="M5 5V4a3 3 0 016 0v1" stroke="currentColor" stroke-width="1.4"/>
                    </x-slot>
                    Permissions
                </x-admin-nav-item>
            @endcan
            {{-- Section: Administration (Dropdown) --}}
            <p class="text-[10px] font-semibold uppercase tracking-widest text-white/30 px-2 pt-4 pb-1.5">Administration</p>

            <div>

                @can('nav_administration')
                    <button @click="open = !open"
                            class="w-full flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-[12.5px] font-medium
                           text-white/55 hover:text-white/85 hover:bg-white/[0.06] transition-all duration-150">
                        <svg class="w-[15px] h-[15px] shrink-0" fill="none" viewBox="0 0 16 16">
                            <path d="M8 2v3M8 11v3M2 8h3M11 8h3M4 4l2 2M10 10l2 2M4 12l2-2M10 6l2-2"
                                  stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                        </svg>
                        <span class="flex-1 text-left">Administration</span>
                        <svg class="w-3 h-3 opacity-40 transition-transform duration-200" :class="{ 'rotate-90': open }"
                             fill="none" viewBox="0 0 12 12">
                            <path d="M4 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                @endcan

                <div x-show="open" x-collapse class="ml-3 mt-1 space-y-0.5 border-l border-white/[0.08] pl-3">
                    {{--                    href="{{ route('administrations.index') }}" :active="request()->routeIs('administrations.*')"--}}
                    @can('nav_nav_administration')
                        <x-admin-nav-item size="sm" :href="route('administrations.index')">Admin</x-admin-nav-item>
                    @endcan
                    @can('nav_administration')
                        <x-admin-nav-item href="" size="sm">HR</x-admin-nav-item>
                        <x-admin-nav-item href="" size="sm">Employee</x-admin-nav-item>
                    @endcan
                </div>
            </div>

            <x-admin-nav-item>
                <x-slot name="icon">
                    <rect x="2" y="2" width="12" height="12" rx="2" stroke="currentColor" stroke-width="1.4"/>
                    <path d="M5 8h6M5 5h4M5 11h3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </x-slot>
                Leave Applications
            </x-admin-nav-item>
        </nav>

        {{-- Bottom: Sign Out --}}
        <div class="px-2.5 py-3 border-t border-white/[0.07]">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-[12.5px] font-medium
                           text-white/40 hover:text-white/70 hover:bg-white/[0.05] transition-all duration-150">
                    <svg class="w-[15px] h-[15px] shrink-0" fill="none" viewBox="0 0 16 16">
                        <path d="M6 2H3a1 1 0 00-1 1v10a1 1 0 001 1h3M10 11l4-4-4-4M14 7H6"
                              stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- ─── Main Area ───────────────────────────────────── --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Top Navigation Bar --}}
        <header class="h-[52px] bg-white border-b border-black/[0.08] flex items-center gap-2 md:gap-3 px-3 md:px-5">
            <button @click="sidebarOpen = !sidebarOpen"
                    class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 transition">

                <svg x-show="!sidebarOpen" class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>

                <svg x-show="sidebarOpen" class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                    <path d="M6 6l12 12M18 6L6 18"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>

            </button>
            {{-- Search --}}
            <div class="relative w-full max-w-[160px] sm:max-w-xs">
                <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none"
                     fill="none" viewBox="0 0 16 16">
                    <circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M10.5 10.5l2.5 2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <input type="search" placeholder="Search…"
                       class="w-full bg-[#f4f5f7] border border-black/10 rounded-lg pl-8 pr-3 py-1.5
                           text-[12.5px] text-gray-700 placeholder-gray-400 focus:outline-none
                           focus:ring-2 focus:ring-indigo-400/40 focus:border-indigo-400 transition">
            </div>

            {{-- Right side --}}
            <div class="ml-auto flex items-center gap-1 md:gap-2">

                {{-- Notifications --}}
                <button class="relative w-8 h-8 rounded-lg flex items-center justify-center text-gray-500
                               hover:bg-gray-100 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 16 16">
                        <path d="M8 1a5 5 0 015 5c0 3 1 4 1 4H2s1-1 1-4a5 5 0 015-5zM6.5 13a1.5 1.5 0 003 0"
                              stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                    <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-red-500 rounded-full ring-2 ring-white"></span>
                </button>

                <div class="w-px h-5 bg-black/10 mx-0.5 md:mx-1"></div>

                {{-- User Dropdown --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                            class="flex items-center gap-1.5 md:gap-2 hover:bg-gray-100 rounded-lg px-1.5 md:px-2 py-1 transition">
                        <div class="w-[30px] h-[30px] rounded-lg bg-gradient-to-br from-indigo-500 to-violet-500
                                    flex items-center justify-center text-[11px] font-semibold text-white shrink-0">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div class="text-left hidden sm:block">
                            <p class="text-[12px] font-semibold text-gray-800 leading-none">{{ auth()->user()->name }}</p>
                            <p class="text-[10.5px] text-gray-400 mt-0.5 leading-none">Administrator</p>
                        </div>
                        <svg class="w-3 h-3 text-gray-400 ml-0.5 md:ml-1" fill="none" viewBox="0 0 12 12">
                            <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div x-show="open" @click.outside="open = false" x-transition
                         class="absolute right-0 top-full mt-2 w-48 bg-white border border-black/[0.08]
                                rounded-xl shadow-lg shadow-black/5 py-1 z-50 text-[12.5px]">
                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center gap-2.5 px-3.5 py-2 text-gray-700 hover:bg-gray-50 transition">
                            Profile Settings
                        </a>
                        <div class="my-1 border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left flex items-center gap-2.5 px-3.5 py-2 text-red-500 hover:bg-red-50 transition">
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- Page Header --}}
        @isset($header)
            <div class="bg-white border-b border-black/[0.06] px-4 py-3 md:px-6 md:py-4">
                <h1 class="text-[15px] md:text-[17px] font-semibold text-gray-900">{{ $header }}</h1>
            </div>
        @endisset

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-3 sm:p-4 md:p-6">
            {{ $slot }}
        </main>
    </div>
</div>

<script src="//unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
