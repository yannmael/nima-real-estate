@props([
    'valeur' => '[XX]',
    'label'  => '',
    'unite'  => '',   // unité affichée à droite de la valeur (ex: m², %, +)
    'light'  => true, // true → textes blancs (section sombre)
])

@php
    $valColor   = $light ? 'text-white'       : 'text-primary';
    $uniteColor = $light ? 'text-gold'         : 'text-gold-600';
    $labelColor = $light ? 'text-primary-100/70' : 'text-gray-500';
@endphp

<div class="text-center">
    <p class="text-4xl xl:text-5xl font-bold {{ $valColor }} leading-none tabular-nums">
        {{ $valeur }}<span class="text-2xl {{ $uniteColor }}">{{ $unite }}</span>
    </p>
    <p class="mt-2 text-sm font-medium {{ $labelColor }} uppercase tracking-wide">
        {{ $label }}
    </p>
</div>
