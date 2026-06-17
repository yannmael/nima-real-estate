@props([
    'titre'  => '',
    'desc'   => '',
    'cta'    => '',
    'href'   => '#',
    'icon'   => 'residentiel', // residentiel | tertiaire | public
    'accent' => 'primary',     // primary | gold | slate
])

@php
    $accentBg   = match($accent) {
        'gold'  => 'bg-gold/10 group-hover:bg-gold/20',
        'slate' => 'bg-slate-100 group-hover:bg-slate-200',
        default => 'bg-primary-100 group-hover:bg-primary/10',
    };
    $accentText = match($accent) {
        'gold'  => 'text-gold-600',
        'slate' => 'text-slate-600',
        default => 'text-primary',
    };
    $accentBorder = match($accent) {
        'gold'  => 'border-gold/30',
        'slate' => 'border-slate-200',
        default => 'border-primary/10',
    };
    $accentLine = match($accent) {
        'gold'  => 'bg-gold',
        'slate' => 'bg-slate-400',
        default => 'bg-primary',
    };
@endphp

<article class="group flex flex-col bg-white rounded-2xl border border-gray-100
                shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden
                hover:-translate-y-1">

    {{-- Barre d'accent colorée --}}
    <div class="h-1 {{ $accentLine }} w-full"></div>

    <div class="p-6 sm:p-8 flex flex-col flex-1">

        {{-- Icône --}}
        <div class="w-14 h-14 rounded-xl {{ $accentBg }} border {{ $accentBorder }}
                    flex items-center justify-center mb-6 transition-colors duration-300">
            @if($icon === 'residentiel')
                <svg class="w-7 h-7 {{ $accentText }}" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                </svg>
            @elseif($icon === 'tertiaire')
                <svg class="w-7 h-7 {{ $accentText }}" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
                </svg>
            @else
                <svg class="w-7 h-7 {{ $accentText }}" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
                </svg>
            @endif
        </div>

        {{-- Contenu --}}
        <h3 class="text-xl font-bold text-primary mb-3">{{ $titre }}</h3>
        <p class="text-gray-500 text-sm leading-relaxed flex-1">{{ $desc }}</p>

        {{-- Lien --}}
        <a href="{{ $href }}"
           class="mt-6 inline-flex items-center gap-2 text-sm font-semibold {{ $accentText }}
                  hover:gap-3 transition-all duration-200 group/link">
            {{ $cta }}
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>

    </div>
</article>
