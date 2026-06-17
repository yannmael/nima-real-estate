@props([
    'label'      => 'Image placeholder',
    'dimensions' => null,   // ex: '1920×1080 px'
    'format'     => 'WebP/AVIF',
    'ratio'      => '16/9', // classe aspect-* Tailwind ou valeur CSS
    'rounded'    => 'xl',
    'class'      => '',
])

@php
    // Ratio → classe Tailwind ou style inline
    $ratioClass = match($ratio) {
        '1/1'   => 'aspect-square',
        '4/3'   => 'aspect-[4/3]',
        '3/2'   => 'aspect-[3/2]',
        '16/9'  => 'aspect-video',
        '21/9'  => 'aspect-[21/9]',
        default => "aspect-[{$ratio}]",
    };
    $roundedClass = $rounded ? "rounded-{$rounded}" : '';
@endphp

<div role="img"
     aria-label="{{ $label }}"
     class="relative overflow-hidden bg-primary-100 placeholder-hatch
            {{ $ratioClass }} {{ $roundedClass }} {{ $class }}">

    {{-- Motif centré --}}
    <div class="absolute inset-0 flex flex-col items-center justify-center gap-3 p-4">

        {{-- Icône image --}}
        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-primary/40" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v13.5a1.5 1.5 0 001.5 1.5zM9.75 9.75a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
            </svg>
        </div>

        {{-- Étiquette --}}
        <div class="text-center space-y-1">
            <p class="text-xs font-mono font-medium text-primary/50 leading-snug">
                {{ $label }}
            </p>
            @if($dimensions)
                <p class="text-xs font-mono text-primary/35">
                    {{ $dimensions }} · {{ $format }}
                </p>
            @endif
        </div>

    </div>
</div>
