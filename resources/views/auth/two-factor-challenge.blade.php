@extends('layouts.auth')

@section('title', 'Vérification en deux étapes')

@section('content')

    <div x-data="{ recovery: false }">

        {{-- Titre + icône --}}
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-orange-100 mb-4">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                Vérification en deux étapes
            </h1>

            {{-- Texte mode code TOTP --}}
            <p x-show="!recovery" class="text-sm text-gray-500 leading-relaxed">
                Ouvrez votre application d'authentification et saisissez le code à 6 chiffres
                généré pour votre compte.
            </p>

            {{-- Texte mode code de récupération --}}
            <p x-show="recovery" x-cloak class="text-sm text-gray-500 leading-relaxed">
                Saisissez l'un de vos codes de récupération d'urgence pour accéder à votre compte.
            </p>
        </div>

        {{-- Erreurs --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-lg">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Formulaire --}}
        <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-5">
            @csrf

            {{-- ============================================ --}}
            {{-- MODE 1 : Code TOTP (par défaut) --}}
            {{-- ============================================ --}}
            <div x-show="!recovery">
                <label for="code" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Code d'authentification
                </label>
                <input id="code" type="text" name="code"
                       inputmode="numeric" autocomplete="one-time-code"
                       autofocus
                       placeholder="123456"
                       maxlength="6"
                       class="w-full px-4 py-3 text-center text-lg font-mono tracking-[0.5em] border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                @error('code')
                    <p class="mt-1.5 text-xs text-red-600 text-center">{{ $message }}</p>
                @enderror
            </div>

            {{-- ============================================ --}}
            {{-- MODE 2 : Code de récupération --}}
            {{-- ============================================ --}}
            <div x-show="recovery" x-cloak>
                <label for="recovery_code" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Code de récupération
                </label>
                <input id="recovery_code" type="text" name="recovery_code"
                       autocomplete="one-time-code"
                       x-bind:required="recovery"
                       placeholder="xxxx-xxxx-xxxx"
                       class="w-full px-4 py-3 text-center text-sm font-mono tracking-wider border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
                @error('recovery_code')
                    <p class="mt-1.5 text-xs text-red-600 text-center">{{ $message }}</p>
                @enderror
            </div>

            {{-- Basculement entre les deux modes --}}
            <div class="text-center text-sm">
                <button type="button"
                        x-show="!recovery"
                        @click="recovery = true; $nextTick(() => $refs.recoveryInput?.focus())"
                        class="font-medium text-blue-600 hover:text-blue-700 transition">
                    Utiliser un code de récupération
                </button>
                <button type="button"
                        x-show="recovery" x-cloak
                        @click="recovery = false"
                        class="font-medium text-blue-600 hover:text-blue-700 transition">
                    Utiliser un code d'authentification
                </button>
            </div>

            {{-- Bouton --}}
            <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-200 focus:ring-offset-2 transition shadow-lg shadow-blue-600/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Vérifier
            </button>
        </form>

        {{-- Lien déconnexion --}}
        <p class="mt-8 text-sm text-center text-gray-500">
            Un problème ?
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="font-semibold text-orange-500 hover:text-orange-600 transition">
                    Se déconnecter
                </button>
            </form>
        </p>
    </div>

@endsection