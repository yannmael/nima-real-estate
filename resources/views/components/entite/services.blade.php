@props(['entreprise'])

@php
    $couleur  = $entreprise->couleur_accent;
    $services = $entreprise->services_localises;
@endphp

@if(count($services))
<section class="py-20 lg:py-24 bg-gray-950" aria-labelledby="services-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-14">
            <x-ui.section-heading
                id="services-heading"
                :badge="__('entite.services_badge')"
                :sub="__('entite.services_sous_titre')"
                light>
                {{ __('entite.services_titre') }}
            </x-ui.section-heading>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
                <div class="group flex items-start gap-4 bg-white/5 border border-white/10
                            rounded-2xl p-6 hover:bg-white/10 transition-colors duration-200">

                    {{-- Puce colorée --}}
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background-color: {{ $couleur }}22; border: 1px solid {{ $couleur }}44;">
                        <span class="w-2.5 h-2.5 rounded-full"
                              style="background-color: {{ $couleur }};"></span>
                    </div>

                    <p class="text-white font-semibold text-sm leading-snug pt-2">
                        {{ $service }}
                    </p>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif
