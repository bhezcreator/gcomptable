@extends('layouts.auth')

@section('title', 'Connexion')

@section('content')

    {{-- Titre --}}
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
            Bon retour parmi nous
        </h1>
        <p class="text-sm text-gray-500">
            Connectez-vous pour accéder à votre espace comptable.
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
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                Adresse email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autofocus autocomplete="username"
                   placeholder="vous@organisation.org"
                   class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
            @error('email')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Mot de passe --}}
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Mot de passe
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-xs font-medium text-blue-600 hover:text-blue-700 transition">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password"
                   required autocomplete="current-password"
                   placeholder="••••••••"
                   class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
            @error('password')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Se souvenir --}}
        <div class="flex items-center">
            <input id="remember" type="checkbox" name="remember"
                   class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <label for="remember" class="ml-2 text-sm text-gray-600">
                Se souvenir de moi
            </label>
        </div>

        {{-- Bouton --}}
        <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-200 focus:ring-offset-2 transition shadow-lg shadow-blue-600/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Se connecter
        </button>
    </form>

    {{-- Lien inscription --}}
    @if (Route::has('register'))
        <p class="mt-8 text-sm text-center text-gray-500">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition">
                Créer un compte
            </a>
        </p>
    @endif

@endsection