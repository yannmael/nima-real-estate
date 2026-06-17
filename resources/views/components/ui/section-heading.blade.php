@props([
    'badge'   => null,
    'center'  => false,
    'light'   => false,
    'tag'     => 'h2',
    'sub'     => null,
])

@php
    $alignClass = $center ? 'text-center mx-auto' : '';
    $titleColor = $light ? 'text-white' : 'text-primary';
    $subColor   = $light ? 'text-primary-100/80' : 'text-gray-500';
    $badgeColor = $light
        ? 'bg-white/10 text-gold border-gold/30'
        : 'bg-primary-100 text-primary border-primary/10';
    $titleClass = "text-3xl sm:text-4xl font-bold leading-tight {$titleColor}";
@endphp

<div class="max-w-2xl {{ $alignClass }}">

    @if($badge)
        <p class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-widest
                   border rounded-full px-3 py-1 mb-4 {{ $badgeColor }}">
            <span class="w-1.5 h-1.5 rounded-full bg-gold flex-shrink-0" aria-hidden="true"></span>
            {{ $badge }}
        </p>
    @endif

    @if($tag === 'h1')
        <h1 class="{{ $titleClass }}">{{ $slot }}</h1>
    @elseif($tag === 'h3')
        <h3 class="{{ $titleClass }}">{{ $slot }}</h3>
    @else
        <h2 class="{{ $titleClass }}">{{ $slot }}</h2>
    @endif

    @if($sub)
        <p class="mt-4 text-base sm:text-lg leading-relaxed {{ $subColor }}">{{ $sub }}</p>
    @endif

</div>
