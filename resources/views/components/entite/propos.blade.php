@props(['entreprise'])

@php $couleur = $entreprise->couleur_accent; @endphp

@if($entreprise->histoire)
<section class="py-20 lg:py-28 bg-white" aria-labelledby="propos-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Image placeholder --}}
            <div class="order-2 lg:order-1">
                <x-ui.placeholder-img
                    :label="__('entite.propos_img_alt')"
                    dimensions="1200×800 px"
                    ratio="3/2"
                    rounded="2xl"
                    class="w-full shadow-xl" />
            </div>

            {{-- Texte --}}
            <div class="order-1 lg:order-2">

                {{-- Ligne décorative colorée --}}
                <div class="w-12 h-1 rounded-full mb-6"
                     style="background-color: {{ $couleur }};"></div>

                <x-ui.section-heading
                    id="propos-heading"
                    :badge="__('entite.propos_badge')">
                    {{ $entreprise->nom }}
                </x-ui.section-heading>

                <div class="mt-6 prose prose-gray max-w-none text-gray-600 leading-relaxed">
                    {!! nl2br(e($entreprise->histoire)) !!}
                </div>

            </div>

        </div>
    </div>
</section>
@endif
