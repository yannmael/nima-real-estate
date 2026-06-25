<div>

  {{-- ====================================================
       ÉTAT : DÉJÀ INSCRIT
       ==================================================== --}}
  @if($statut === 'deja_inscrit')

  <div class="flex items-center gap-3 p-4 rounded-xl bg-blue-50 border border-blue-200"
       role="status" aria-live="polite">
    <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <p class="text-sm text-blue-700 font-medium">{{ __('contact.newsletter_deja_inscrit') }}</p>
  </div>

  {{-- ====================================================
       ÉTAT : EMAIL DE CONFIRMATION ENVOYÉ
       ==================================================== --}}
  @elseif($statut === 'confirmation_envoyee')

  <div class="flex items-start gap-3 p-4 rounded-xl bg-green-50 border border-green-200"
       role="status" aria-live="polite">
    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <div>
      <p class="text-sm font-semibold text-green-800">
        {{ __('contact.newsletter_confirmation_envoyee') }}
      </p>
      <p class="text-xs text-green-600 mt-0.5">
        {{ app()->getLocale() === 'fr'
          ? 'Cliquez sur le lien dans votre e-mail pour finaliser l\'inscription.'
          : 'Click the link in your email to complete your subscription.' }}
      </p>
    </div>
  </div>

  {{-- ====================================================
       FORMULAIRE NEWSLETTER
       ==================================================== --}}
  @else

  <form wire:submit.prevent="inscrire" novalidate>

    <div class="flex flex-col sm:flex-row gap-3">

      {{-- Prénom (optionnel) --}}
      <div class="sm:w-36 flex-shrink-0">
        <label for="newsletter-prenom" class="sr-only">
          {{ __('contact.newsletter_prenom') }}
        </label>
        <input wire:model="prenom"
               type="text"
               id="newsletter-prenom"
               name="prenom"
               autocomplete="given-name"
               placeholder="{{ __('contact.newsletter_prenom') }}"
               class="w-full rounded-xl border border-white/20 bg-white/10 text-white
                      placeholder-white/50 px-4 py-3 text-sm
                      focus:outline-none focus:ring-2 focus:ring-gold focus:border-transparent
                      transition-colors duration-150">
      </div>

      {{-- E-mail --}}
      <div class="flex-1">
        <label for="newsletter-email" class="sr-only">
          {{ __('contact.newsletter_email') }}
        </label>
        <input wire:model="email"
               type="email"
               id="newsletter-email"
               name="email"
               autocomplete="email"
               required
               placeholder="{{ __('contact.newsletter_email') }}"
               class="w-full rounded-xl border bg-white/10 text-white
                      placeholder-white/50 px-4 py-3 text-sm
                      focus:outline-none focus:ring-2 focus:ring-gold focus:border-transparent
                      transition-colors duration-150
                      @error('email') border-red-400 bg-red-900/20 @else border-white/20 @enderror"
               aria-required="true"
               aria-describedby="{{ $errors->has('email') ? 'err-nl-email' : '' }}">
        @error('email')
          <p id="err-nl-email" class="mt-1.5 text-xs text-red-300 flex items-center gap-1" role="alert">
            <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            {{ $message }}
          </p>
        @enderror
      </div>

      {{-- Bouton --}}
      <button type="submit"
              wire:loading.attr="disabled"
              class="flex-shrink-0 inline-flex items-center justify-center gap-2
                     bg-gold text-primary font-semibold rounded-xl px-6 py-3 text-sm
                     hover:bg-gold-600 transition-all duration-200
                     shadow-sm hover:shadow
                     focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2
                     focus-visible:ring-offset-primary
                     disabled:opacity-60 disabled:cursor-not-allowed
                     whitespace-nowrap">

        <span wire:loading.remove>{{ __('contact.newsletter_soumettre') }}</span>

        <span wire:loading class="flex items-center gap-1.5">
          <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24"
               stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
          </svg>
          {{ app()->getLocale() === 'fr' ? 'Envoi…' : 'Sending…' }}
        </span>

      </button>

    </div>

    {{-- Mention RGPD --}}
    <p class="mt-3 text-xs text-white/40 leading-relaxed">
      {{ __('contact.newsletter_mention_rgpd') }}
    </p>

  </form>

  @endif

</div>
