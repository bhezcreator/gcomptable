@extends('layouts.auth')

@section('title', 'Confirmation du mot de passe')

@section('content')

    {{-- Titre --}}
    <div class="mb-8">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-orange-100 mb-4">
            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>

        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
            Zone sécurisée 🔒
        </h1>
        <p class="text-sm text-gray-500 leading-relaxed">
            Cette action nécessite une confirmation. Veuillez saisir votre mot de passe
            pour continuer.
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
    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        {{-- Mot de passe --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                Mot de passe
            </label>
            <input id="password" type="password" name="password"
                   required autofocus autocomplete="current-password"
                   placeholder="••••••••"
                   class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
            @error('password')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Bouton --}}
        <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-200 focus:ring-offset-2 transition shadow-lg shadow-blue-600/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            Confirmer
        </button>
    </form>

    {{-- Lien retour --}}
    <p class="mt-8 text-sm text-center text-gray-500">
        <a href="{{ url()->previous() }}" class="font-semibold text-blue-600 hover:text-blue-700 transition">
            ← Retour
        </a>
    </p>

@endsection