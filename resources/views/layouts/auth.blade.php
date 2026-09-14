<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Connexion') — ComptaONG</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 antialiased overflow-x-hidden">

    <div class="min-h-screen flex">

        {{-- ============================================================ --}}
        {{-- COLONNE GAUCHE : FORMULAIRE --}}
        {{-- ============================================================ --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-6 sm:px-10 lg:px-16 xl:px-24 py-10">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2 mb-10 lg:mb-14">
                <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 7h6M9 11h6M9 15h4M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                    </svg>
                </div>
                <span class="text-lg sm:text-xl font-bold text-gray-900">
                    Compta<span class="text-blue-600">ONG</span>
                </span>
            </a>

            {{-- Contenu du formulaire --}}
            <div class="w-full max-w-md mx-auto lg:mx-0">
                @yield('content')
            </div>

            {{-- Footer --}}
            <div class="mt-10 lg:mt-14 text-xs text-gray-400 text-center lg:text-left">
                © {{ date('Y') }} ComptaONG. Tous droits réservés.
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- COLONNE DROITE : IMAGE / BRANDING --}}
        {{-- ============================================================ --}}
        <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-blue-600 to-blue-700 overflow-hidden">

            {{-- Formes décoratives --}}
            <div class="absolute top-0 right-0 w-96 h-96 bg-orange-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-white rounded-full blur-3xl opacity-10 pointer-events-none"></div>

            {{-- Image de fond optionnelle (décommente si tu as une image) --}}
            {{-- 
            <img src="{{ asset('images/auth-bg.jpg') }}" 
                 alt="" 
                 class="absolute inset-0 w-full h-full object-cover opacity-20">
            --}}

            {{-- Contenu --}}
            <div class="relative z-10 flex flex-col justify-between p-12 xl:p-16 w-full">

                {{-- Badge en haut --}}
                <div class="flex justify-end">
                    <span class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold text-white bg-white/10 backdrop-blur rounded-full border border-white/20">
                        <span class="w-2 h-2 bg-orange-400 rounded-full"></span>
                        Plateforme sécurisée
                    </span>
                </div>

                {{-- Texte principal au centre --}}
                <div class="max-w-md">
                    <h2 class="text-3xl xl:text-4xl font-bold text-white leading-tight mb-4">
                        Gérez la comptabilité de votre ONG en toute
                        <span class="text-orange-400">transparence</span>
                    </h2>
                    <p class="text-blue-100 text-base xl:text-lg leading-relaxed">
                        Centralisez vos projets, suivez vos budgets et produisez vos rapports
                        financiers dans une seule plateforme.
                    </p>

                    {{-- Points forts --}}
                    <div class="mt-8 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-500 flex items-center justify-center mt-0.5">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="text-sm text-blue-50">
                                Conforme aux normes SYSCOHADA
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-500 flex items-center justify-center mt-0.5">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="text-sm text-blue-50">
                                Rapports bailleurs en PDF et Excel
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-500 flex items-center justify-center mt-0.5">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="text-sm text-blue-50">
                                Gestion multi-projets et multi-utilisateurs
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Statistiques en bas --}}
                <div class="grid grid-cols-3 gap-4 pt-8 border-t border-white/20">
                    <div>
                        <div class="text-2xl font-bold text-white">150+</div>
                        <div class="text-xs text-blue-200 mt-1">ONG utilisatrices</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-white">2 400+</div>
                        <div class="text-xs text-blue-200 mt-1">Projets gérés</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-white">99,9 %</div>
                        <div class="text-xs text-blue-200 mt-1">Disponibilité</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>