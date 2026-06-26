@props(['article', 'locale'])

<article class="group relative flex flex-col bg-white rounded-2xl border border-gray-100
                shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden">

    {{-- Visuel --}}
    <div class="relative overflow-hidden aspect-video flex-shrink-0 bg-gray-100">
        @if($article->image_couverture)
            <img src="{{ asset($article->image_couverture) }}"
                 alt="{{ $article->titre }}"
                 loading="lazy"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <x-ui.placeholder-img
                :label="$article->titre"
                dimensions="800×450 px"
                ratio="16/9"
                rounded=""
                class="w-full h-full"
            />
        @endif

        {{-- Badge catégorie principale --}}
        @if(!empty($article->categories))
            <span class="absolute top-3 left-3 inline-flex items-center px-2.5 py-1
                         rounded-full text-xs font-semibold bg-primary text-white shadow-sm">
                {{ $article->categories[0] }}
            </span>
        @endif
    </div>

    {{-- Contenu --}}
    <div class="flex flex-col flex-1 p-5">

        {{-- Date + temps de lecture --}}
        <div class="flex items-center gap-3 text-xs text-gray-400 mb-3">
            <time datetime="{{ $article->published_at->toDateString() }}">
                {{ $article->published_at->translatedFormat($locale === 'fr' ? 'j M Y' : 'M j, Y') }}
            </time>
            <span aria-hidden="true">·</span>
            <span>{{ $article->temps_lecture }}&nbsp;{{ __('blog.carte_min_lecture') }}</span>
        </div>

        {{-- Titre --}}
        <h3 class="font-bold text-primary text-sm leading-snug mb-3 line-clamp-3 flex-1">
            {{ $article->titre }}
        </h3>

        {{-- Tags --}}
        @if(!empty($article->tags))
            <div class="flex flex-wrap gap-1.5 mb-4"
                 aria-label="{{ __('blog.carte_tags_aria') }}">
                @foreach(array_slice($article->tags, 0, 3) as $tag)
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full
                                 text-[10px] font-medium bg-gray-100 text-gray-500">
                        #{{ $tag }}
                    </span>
                @endforeach
            </div>
        @endif

        {{-- Lien étiré sur toute la carte --}}
        <a href="{{ route('locale.article', ['locale' => $locale, 'slug' => $article->slugPourLocale($locale)]) }}"
           class="absolute inset-0 rounded-2xl focus:outline-none
                  focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2"
           aria-label="{{ __('blog.carte_lire') }} — {{ $article->titre }}">
        </a>

        {{-- Indicateur visuel --}}
        <span class="relative z-10 pointer-events-none inline-flex items-center gap-1.5
                     text-xs font-semibold text-gold"
              aria-hidden="true">
            {{ __('blog.carte_lire') }}
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </span>

    </div>

</article>
