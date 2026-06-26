@extends('admin.layout')
@section('title', 'Tableau de bord')

@section('content')
<div class="w-full max-w-3xl">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-primary">Tableau de bord</h1>
        <p class="text-sm text-gray-500 mt-1">
            Connecté en tant que <strong>{{ auth()->user()->name }}</strong>
            <span class="ml-2 inline-flex items-center gap-1 text-xs text-green-700 bg-green-50
                         border border-green-200 rounded-full px-2 py-0.5">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                          clip-rule="evenodd"/>
                </svg>
                2FA actif
            </span>
        </p>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-8">
        @foreach([
            ['label' => 'Projets',   'val' => $stats['projets'],  'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
            ['label' => 'Articles',  'val' => $stats['articles'], 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            ['label' => 'Leads',     'val' => $stats['leads'],    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
        ] as $stat)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center">
            <svg class="w-6 h-6 text-primary/40 mx-auto mb-3" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/>
            </svg>
            <p class="text-3xl font-black text-primary tabular-nums">{{ $stat['val'] }}</p>
            <p class="text-xs text-gray-400 uppercase tracking-wider mt-1">{{ $stat['label'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-sm text-amber-800">
        <strong>Interface d'administration complète à venir.</strong>
        Ce tableau de bord sera enrichi avec la gestion des projets, articles, leads et taux de change.
    </div>

</div>
@endsection
