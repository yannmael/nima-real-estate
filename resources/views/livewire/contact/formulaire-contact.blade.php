<div>

  {{-- ============================================================
       ÉTAT : FORMULAIRE ENVOYÉ AVEC SUCCÈS
       ============================================================ --}}
  @if($envoye)

  <div class="flex flex-col items-center justify-center py-16 text-center"
       role="alert"
       aria-live="polite">

    {{-- Icône check --}}
    <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mb-6">
      <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24"
           stroke="currentColor" stroke-width="2" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
      </svg>
    </div>

    <h2 class="text-2xl font-bold text-primary mb-3">
      {{ __('contact.form_envoi_ok') }}
    </h2>
    <p class="text-gray-500 mb-8 max-w-sm">
      {{ __('contact.form_envoi_ok_detail') }}
    </p>

    <button wire:click="recommencer"
            class="inline-flex items-center gap-2 text-sm font-semibold text-primary
                   hover:text-gold transition-colors duration-150">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
           stroke-width="2" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      {{ __('contact.form_nouvelle_demande') }}
    </button>

  </div>

  @else

  {{-- ============================================================
       FORMULAIRE QUALIFIÉ
       ============================================================ --}}
  <form wire:submit.prevent="soumettre"
        aria-labelledby="form-contact-heading"
        novalidate>

    {{-- Indicateur de chargement Livewire --}}
    <div wire:loading.flex
         class="items-center gap-2 text-sm text-gray-400 mb-4"
         aria-live="polite">
      <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"
           stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
      </svg>
      {{ app()->getLocale() === 'fr' ? 'Envoi en cours…' : 'Sending…' }}
    </div>

    {{-- Ligne 1 : Prénom + Nom --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

      <div>
        <label for="prenom"
               class="block text-sm font-medium text-gray-700 mb-1.5">
          {{ __('contact.form_prenom') }}
          <span class="text-red-500 ml-0.5" aria-hidden="true">*</span>
        </label>
        <input wire:model="prenom"
               type="text"
               id="prenom"
               name="prenom"
               autocomplete="given-name"
               :placeholder="'{{ __('contact.form_prenom') }}'"
               class="w-full rounded-xl border px-4 py-3 text-sm text-gray-900
                      focus:outline-none focus:ring-2 focus:ring-gold/50 focus:border-gold
                      transition-colors duration-150
                      @error('prenom') border-red-400 bg-red-50 @else border-gray-200 @enderror"
               aria-required="true"
               aria-describedby="{{ $errors->has('prenom') ? 'err-prenom' : '' }}">
        @error('prenom')
          <p id="err-prenom" class="mt-1.5 text-xs text-red-600 flex items-center gap-1" role="alert">
            <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            {{ $message }}
          </p>
        @enderror
      </div>

      <div>
        <label for="nom_contact"
               class="block text-sm font-medium text-gray-700 mb-1.5">
          {{ __('contact.form_nom') }}
          <span class="text-red-500 ml-0.5" aria-hidden="true">*</span>
        </label>
        <input wire:model="nom_contact"
               type="text"
               id="nom_contact"
               name="nom_contact"
               autocomplete="family-name"
               class="w-full rounded-xl border px-4 py-3 text-sm text-gray-900
                      focus:outline-none focus:ring-2 focus:ring-gold/50 focus:border-gold
                      transition-colors duration-150
                      @error('nom_contact') border-red-400 bg-red-50 @else border-gray-200 @enderror"
               aria-required="true"
               aria-describedby="{{ $errors->has('nom_contact') ? 'err-nom' : '' }}">
        @error('nom_contact')
          <p id="err-nom" class="mt-1.5 text-xs text-red-600 flex items-center gap-1" role="alert">
            <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            {{ $message }}
          </p>
        @enderror
      </div>

    </div>

    {{-- Ligne 2 : E-mail + Téléphone --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

      <div>
        <label for="email"
               class="block text-sm font-medium text-gray-700 mb-1.5">
          {{ __('contact.form_email') }}
          <span class="text-red-500 ml-0.5" aria-hidden="true">*</span>
        </label>
        <input wire:model="email"
               type="email"
               id="email"
               name="email"
               autocomplete="email"
               class="w-full rounded-xl border px-4 py-3 text-sm text-gray-900
                      focus:outline-none focus:ring-2 focus:ring-gold/50 focus:border-gold
                      transition-colors duration-150
                      @error('email') border-red-400 bg-red-50 @else border-gray-200 @enderror"
               aria-required="true"
               aria-describedby="{{ $errors->has('email') ? 'err-email' : '' }}">
        @error('email')
          <p id="err-email" class="mt-1.5 text-xs text-red-600 flex items-center gap-1" role="alert">
            <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            {{ $message }}
          </p>
        @enderror
      </div>

      <div>
        <label for="telephone"
               class="block text-sm font-medium text-gray-700 mb-1.5">
          {{ __('contact.form_telephone') }}
        </label>
        <input wire:model="telephone"
               type="tel"
               id="telephone"
               name="telephone"
               autocomplete="tel"
               placeholder="+237 6XX XXX XXX"
               class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-gray-900
                      focus:outline-none focus:ring-2 focus:ring-gold/50 focus:border-gold
                      transition-colors duration-150">
      </div>

    </div>

    {{-- Type de projet --}}
    <div class="mb-4">
      <label for="type_projet"
             class="block text-sm font-medium text-gray-700 mb-1.5">
        {{ __('contact.form_type_projet') }}
        <span class="text-red-500 ml-0.5" aria-hidden="true">*</span>
      </label>
      <select wire:model.live="type_projet"
              id="type_projet"
              name="type_projet"
              class="w-full rounded-xl border px-4 py-3 text-sm text-gray-900 bg-white
                     focus:outline-none focus:ring-2 focus:ring-gold/50 focus:border-gold
                     transition-colors duration-150
                     @error('type_projet') border-red-400 bg-red-50 @else border-gray-200 @enderror"
              aria-required="true"
              aria-describedby="{{ $errors->has('type_projet') ? 'err-type' : '' }}">
        <option value="">{{ __('contact.form_type_choisir') }}</option>
        <option value="achat">{{ __('contact.form_type_achat') }}</option>
        <option value="location">{{ __('contact.form_type_location') }}</option>
        <option value="investissement">{{ __('contact.form_type_investissement') }}</option>
        <option value="construction">{{ __('contact.form_type_construction') }}</option>
        <option value="conseil">{{ __('contact.form_type_conseil') }}</option>
        <option value="autre">{{ __('contact.form_type_autre') }}</option>
      </select>
      @error('type_projet')
        <p id="err-type" class="mt-1.5 text-xs text-red-600 flex items-center gap-1" role="alert">
          <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
          </svg>
          {{ $message }}
        </p>
      @enderror
    </div>

    {{-- Champs conditionnels : Surface + Budget --}}
    @if($this->afficherSurface || $this->afficherBudget)
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4
                p-4 rounded-2xl bg-primary/5 border border-primary/10">

      @if($this->afficherSurface)
      <div>
        <label for="surface"
               class="block text-sm font-medium text-gray-700 mb-1.5">
          {{ __('contact.form_surface') }}
          <span class="text-red-500 ml-0.5" aria-hidden="true">*</span>
        </label>
        <div class="relative">
          <input wire:model="surface"
                 type="number"
                 id="surface"
                 name="surface"
                 min="10"
                 max="100000"
                 step="1"
                 placeholder="{{ __('contact.form_surface_hint') }}"
                 class="w-full rounded-xl border px-4 py-3 pr-12 text-sm text-gray-900
                        focus:outline-none focus:ring-2 focus:ring-gold/50 focus:border-gold
                        transition-colors duration-150
                        @error('surface') border-red-400 bg-red-50 @else border-gray-200 @enderror"
                 aria-required="true"
                 aria-describedby="{{ $errors->has('surface') ? 'err-surface' : '' }}">
          <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-medium pointer-events-none"
                aria-hidden="true">m²</span>
        </div>
        @error('surface')
          <p id="err-surface" class="mt-1.5 text-xs text-red-600 flex items-center gap-1" role="alert">
            <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            {{ $message }}
          </p>
        @enderror
      </div>
      @endif

      @if($this->afficherBudget)
      <div>
        <label for="budget"
               class="block text-sm font-medium text-gray-700 mb-1.5">
          {{ __('contact.form_budget') }}
          <span class="text-red-500 ml-0.5" aria-hidden="true">*</span>
        </label>
        <input wire:model="budget"
               type="text"
               id="budget"
               name="budget"
               placeholder="{{ __('contact.form_budget_hint') }}"
               class="w-full rounded-xl border px-4 py-3 text-sm text-gray-900
                      focus:outline-none focus:ring-2 focus:ring-gold/50 focus:border-gold
                      transition-colors duration-150
                      @error('budget') border-red-400 bg-red-50 @else border-gray-200 @enderror"
               aria-required="true"
               aria-describedby="{{ $errors->has('budget') ? 'err-budget' : '' }}">
        @error('budget')
          <p id="err-budget" class="mt-1.5 text-xs text-red-600 flex items-center gap-1" role="alert">
            <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            {{ $message }}
          </p>
        @enderror
      </div>
      @endif

    </div>
    @endif

    {{-- Lieu --}}
    <div class="mb-4">
      <label for="lieu"
             class="block text-sm font-medium text-gray-700 mb-1.5">
        {{ __('contact.form_lieu') }}
      </label>
      <input wire:model="lieu"
             type="text"
             id="lieu"
             name="lieu"
             placeholder="{{ __('contact.form_lieu_hint') }}"
             class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-gray-900
                    focus:outline-none focus:ring-2 focus:ring-gold/50 focus:border-gold
                    transition-colors duration-150">
    </div>

    {{-- Message --}}
    <div class="mb-6">
      <label for="message"
             class="block text-sm font-medium text-gray-700 mb-1.5">
        {{ __('contact.form_message') }}
        <span class="text-red-500 ml-0.5" aria-hidden="true">*</span>
      </label>
      <textarea wire:model="message"
                id="message"
                name="message"
                rows="5"
                placeholder="{{ __('contact.form_message_hint') }}"
                class="w-full rounded-xl border px-4 py-3 text-sm text-gray-900 resize-y
                       focus:outline-none focus:ring-2 focus:ring-gold/50 focus:border-gold
                       transition-colors duration-150
                       @error('message') border-red-400 bg-red-50 @else border-gray-200 @enderror"
                aria-required="true"
                aria-describedby="{{ $errors->has('message') ? 'err-message' : '' }}"></textarea>
      <div class="flex items-center justify-between mt-1.5">
        <span></span>
        <span class="text-xs text-gray-400">{{ mb_strlen($message ?? '') }} / 2000</span>
      </div>
      @error('message')
        <p id="err-message" class="mt-1 text-xs text-red-600 flex items-center gap-1" role="alert">
          <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
          </svg>
          {{ $message }}
        </p>
      @enderror
    </div>

    {{-- Bouton envoi --}}
    <button type="submit"
            wire:loading.attr="disabled"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2
                   bg-primary text-white font-semibold rounded-xl px-8 py-3.5 text-sm
                   hover:bg-primary-800 transition-all duration-200
                   shadow-sm hover:shadow
                   focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2
                   disabled:opacity-60 disabled:cursor-not-allowed">

      <span wire:loading.remove>
        {{ __('contact.form_soumettre') }}
        <svg class="w-4 h-4 inline-block ml-1" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
        </svg>
      </span>

      <span wire:loading class="flex items-center gap-2">
        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        {{ app()->getLocale() === 'fr' ? 'Envoi…' : 'Sending…' }}
      </span>

    </button>

    {{-- Note champs obligatoires --}}
    <p class="mt-3 text-xs text-gray-400">
      <span aria-hidden="true">* </span>{{ __('contact.form_champ_requis') }}
    </p>

  </form>

  @endif

</div>
