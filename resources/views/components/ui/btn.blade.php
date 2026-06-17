@props([
    'href'   => null,
    'type'   => 'primary',  // primary | outline | outline-white | ghost | gold
    'size'   => 'md',       // sm | md | lg
    'submit' => false,
    'full'   => false,
])

@php
    $sizeClass = match($size) {
        'sm'    => 'px-4 py-2 text-xs',
        'lg'    => 'px-7 py-3.5 text-base',
        default => 'px-5 py-2.5 text-sm',
    };

    $typeClass = match($type) {
        'outline'       => 'border-2 border-primary text-primary hover:bg-primary hover:text-white',
        'outline-white' => 'border-2 border-white text-white hover:bg-white hover:text-primary',
        'ghost'         => 'text-primary hover:bg-primary-100',
        'gold'          => 'bg-gold text-primary hover:bg-gold-600 shadow-sm hover:shadow',
        default         => 'bg-primary text-white hover:bg-primary-800 shadow-sm hover:shadow',
    };

    $base = 'inline-flex items-center justify-center gap-2 font-semibold rounded-xl
             transition-all duration-200 focus-visible:ring-2 focus-visible:ring-gold
             focus-visible:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed
             whitespace-nowrap';

    $fullClass = $full ? 'w-full' : '';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "{$base} {$sizeClass} {$typeClass} {$fullClass}"]) }}>
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $submit ? 'submit' : 'button' }}"
        {{ $attributes->merge(['class' => "{$base} {$sizeClass} {$typeClass} {$fullClass}"]) }}>
        {{ $slot }}
    </button>
@endif
