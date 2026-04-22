@props([
'href' => '#',
'active' => false,
'size' => 'md',
])

@php
    $base = 'flex items-center gap-2.5 rounded-lg font-medium transition-all duration-150 w-full';
    $size = $size === 'sm'
        ? 'px-2.5 py-1.5 text-[12px]'
        : 'px-2.5 py-2 text-[12.5px]';
    $state = $active
        ? 'bg-indigo-500/[0.15] text-indigo-300'
        : 'text-white/55 hover:text-white/85 hover:bg-white/[0.06]';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => "$base $size $state"]) }}>
    @isset($icon)
        <svg class="w-[15px] h-[15px] shrink-0 opacity-80" fill="none" viewBox="0 0 16 16">
            {{ $icon }}
        </svg>
    @endisset
    {{ $slot }}
</a>
