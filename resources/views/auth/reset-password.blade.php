@extends('layouts.auth')

@section('title', 'Réinitialiser le mot de passe')

@section('content')

    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
            Nouveau mot de passe
        </h1>
        <p class="text-sm text-gray-500">
            Choisissez un nouveau mot de passe sécurisé pour votre compte.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-lg">
            <div class="text-sm text-red-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                Adresse email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                   required autofocus
                   class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                Nouveau mot de passe
            </label>
            <input id="password" type="password" name="password"
                   required
                   placeholder="••••••••"
                   class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">
                Confirmer le mot de passe
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   required
                   placeholder="••••••••"
                   class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
        </div>

        <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">
            Réinitialiser le mot de passe
        </button>
    </form>

@endsection