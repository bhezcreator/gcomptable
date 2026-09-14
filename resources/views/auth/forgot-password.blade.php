@extends('layouts.auth')

@section('title', 'Mot de passe oublié')

@section('content')

    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
            Mot de passe oublié ?
        </h1>
        <p class="text-sm text-gray-500">
            Entrez votre email et nous vous enverrons un lien de réinitialisation.
        </p>
    </div>

    @if (session('status'))
        <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-lg text-sm text-green-700">
            {{ session('status') }}
        </div>
    @endif

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

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                Adresse email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autofocus
                   placeholder="vous@organisation.org"
                   class="w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
        </div>

        <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">
            Envoyer le lien de réinitialisation
        </button>
    </form>

    <p class="mt-8 text-sm text-center text-gray-500">
        <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition">
            ← Retour à la connexion
        </a>
    </p>

@endsection