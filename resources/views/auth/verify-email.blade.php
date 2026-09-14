@extends('layouts.auth')

@section('title', 'Vérification de l\'email')

@section('content')

    {{-- Titre + icône --}}
    <div class="mb-8">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-blue-100 mb-4">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>

        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
            Vérifiez votre email 📬
        </h1>
        <p class="text-sm text-gray-500 leading-relaxed">
            Merci pour votre inscription ! Avant de commencer, veuillez confirmer votre
            adresse email en cliquant sur le lien que nous venons de vous envoyer.
        </p>
    </div>

    {{-- Message de succès (lien renvoyé) --}}
    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-lg">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-green-700">
                    Un nouveau lien de vérification a été envoyé à votre adresse email.
                </p>
            </div>
        </div>
    @endif

    {{-- Bloc d'information --}}
    <div class="mb-6 p-4 bg-blue-50 border border-blue-100 rounded-lg">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="text-sm text-blue-700 leading-relaxed">
                <p class="font-medium mb-1">Vous n'avez pas reçu l'email ?</p>
                <ul class="list-disc list-inside space-y-0.5 text-blue-600">
                    <li>Vérifiez votre dossier spam ou courrier indésirable</li>
                    <li>Assurez-vous que l'adresse saisie est correcte</li>
                    <li>Le lien peut prendre quelques minutes à arriver</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Actions --}}
    <div class="space-y-4">

        {{-- Renvoyer l'email --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-200 focus:ring-offset-2 transition shadow-lg shadow-blue-600/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Renvoyer l'email de vérification
            </button>
        </form>

        {{-- Déconnexion --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-lg hover:border-orange-300 hover:text-orange-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Se déconnecter
            </button>
        </form>
    </div>

    {{-- Note de bas de page --}}
    <p class="mt-8 text-xs text-center text-gray-400 leading-relaxed">
        Une fois votre email vérifié, vous serez automatiquement redirigé vers votre tableau de bord.
    </p>

@endsection