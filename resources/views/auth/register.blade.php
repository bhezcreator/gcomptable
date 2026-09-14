@extends('layouts.auth')

@section('title', 'Inscription')

@section('content')

    {{-- Titre --}}
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
            Créez votre compte
        </h1>
        <p class="text-sm text-gray-500">
            Rejoignez les organisations qui simplifient leur gestion comptable.
        </p>
    </div>

    {{-- Erreurs globales --}}
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
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- Nom --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">
                Nom complet
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   required autofocus autocomplete="name"
                   placeholder="Jean Dupont"
                   class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
            @error('name')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                Adresse email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autocomplete="username"
                   placeholder="vous@organisation.org"
                   class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
            @error('email')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Mot de passe --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                Mot de passe
            </label>
            <input id="password" type="password" name="password"
                   required autocomplete="new-password"
                   placeholder="••••••••"
                   class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
            @error('password')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirmation --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">
                Confirmer le mot de passe
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   required autocomplete="new-password"
                   placeholder="••••••••"
                   class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
        </div>

        {{-- Bouton --}}
        <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-semibold text-white bg-orange-500 rounded-lg hover:bg-orange-600 focus:ring-2 focus:ring-orange-200 focus:ring-offset-2 transition shadow-lg shadow-orange-500/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Créer mon compte
        </button>
    </form>

    {{-- Lien connexion --}}
    <p class="mt-8 text-sm text-center text-gray-500">
        Vous avez déjà un compte ?
        <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition">
            Se connecter
        </a>
    </p>

@endsection