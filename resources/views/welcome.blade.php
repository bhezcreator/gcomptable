<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ComptaONG — Gestion comptable pour organisations humanitaires</title>
    <meta name="description" content="Plateforme de gestion comptable et financière conçue pour les ONG et organisations à but non lucratif.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 antialiased overflow-x-hidden">

    {{-- ============================================================ --}}
    {{-- NAVBAR --}}
    {{-- ============================================================ --}}
    <header x-data="{ open: false }" class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur border-b border-gray-100">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2 flex-shrink-0">
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

            {{-- Liens desktop --}}
            <div class="hidden md:flex items-center gap-6 lg:gap-8 text-sm font-medium text-gray-600">
                <a href="#features" class="hover:text-blue-600 transition">Fonctionnalités</a>
                <a href="#modules" class="hover:text-blue-600 transition">Modules</a>
                <a href="#avantages" class="hover:text-blue-600 transition">Avantages</a>
                <a href="#contact" class="hover:text-blue-600 transition">Contact</a>
            </div>

            {{-- Actions desktop --}}
            <div class="hidden md:flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                        Tableau de bord
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 text-sm font-semibold text-white bg-orange-500 rounded-lg hover:bg-orange-600 transition shadow-sm">
                        Commencer
                    </a>
                @endauth
            </div>

            {{-- Bouton burger (mobile) --}}
            <button @click="open = !open" type="button"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition"
                    aria-label="Menu">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </nav>

        {{-- Menu mobile --}}
        <div x-show="open" x-cloak x-transition
             class="md:hidden border-t border-gray-100 bg-white">
            <div class="px-4 sm:px-6 py-4 space-y-1">
                <a href="#features" @click="open = false"
                   class="block px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">
                    Fonctionnalités
                </a>
                <a href="#modules" @click="open = false"
                   class="block px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">
                    Modules
                </a>
                <a href="#avantages" @click="open = false"
                   class="block px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">
                    Avantages
                </a>
                <a href="#contact" @click="open = false"
                   class="block px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">
                    Contact
                </a>

                <div class="pt-3 mt-3 border-t border-gray-100 space-y-2">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="block w-full text-center px-4 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                            Tableau de bord
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="block w-full text-center px-4 py-2.5 text-sm font-semibold text-blue-600 border border-blue-200 rounded-lg hover:bg-blue-50 transition">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}"
                           class="block w-full text-center px-4 py-2.5 text-sm font-semibold text-white bg-orange-500 rounded-lg hover:bg-orange-600 transition">
                            Commencer
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    {{-- ============================================================ --}}
    {{-- HERO --}}
    {{-- ============================================================ --}}
    <section class="relative pt-24 sm:pt-28 lg:pt-32 pb-16 sm:pb-20 lg:pb-24 overflow-hidden">
        {{-- Formes décoratives --}}
        <div class="absolute -top-24 -right-24 w-64 sm:w-80 lg:w-96 h-64 sm:h-80 lg:h-96 bg-blue-50 rounded-full blur-3xl opacity-70 pointer-events-none"></div>
        <div class="absolute top-40 -left-32 w-56 sm:w-72 lg:w-80 h-56 sm:h-72 lg:h-80 bg-orange-50 rounded-full blur-3xl opacity-70 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- Texte --}}
            <div class="text-center lg:text-left">
                <span class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold text-orange-600 bg-orange-50 rounded-full mb-5 sm:mb-6">
                    <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                    Conçu pour les ONG et associations
                </span>

                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
                    Gérez la comptabilité de votre
                    <span class="text-blue-600">ONG</span>
                    en toute
                    <span class="text-orange-500">transparence</span>
                </h1>

                <p class="mt-5 sm:mt-6 text-base sm:text-lg text-gray-600 max-w-xl mx-auto lg:mx-0">
                    Centralisez vos projets, suivez vos budgets, produisez vos rapports financiers
                    et respectez les exigences de vos bailleurs — le tout dans une seule plateforme.
                </p>

                <div class="mt-7 sm:mt-8 flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center justify-center gap-2 px-5 sm:px-6 py-3 text-sm sm:text-base font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Se connecter
                    </a>
                    <a href="#features"
                       class="inline-flex items-center justify-center gap-2 px-5 sm:px-6 py-3 text-sm sm:text-base font-semibold text-gray-700 bg-white border border-gray-200 rounded-lg hover:border-blue-300 hover:text-blue-600 transition">
                        Découvrir les fonctionnalités
                    </a>
                </div>

                {{-- Statistiques --}}
                <div class="mt-10 sm:mt-12 grid grid-cols-3 gap-3 sm:gap-6 max-w-md mx-auto lg:mx-0">
                    <div>
                        <div class="text-xl sm:text-2xl font-bold text-gray-900">150+</div>
                        <div class="text-[11px] sm:text-xs text-gray-500 mt-1 leading-tight">ONG utilisatrices</div>
                    </div>
                    <div>
                        <div class="text-xl sm:text-2xl font-bold text-gray-900">2 400+</div>
                        <div class="text-[11px] sm:text-xs text-gray-500 mt-1 leading-tight">Projets gérés</div>
                    </div>
                    <div>
                        <div class="text-xl sm:text-2xl font-bold text-gray-900">99,9 %</div>
                        <div class="text-[11px] sm:text-xs text-gray-500 mt-1 leading-tight">Disponibilité</div>
                    </div>
                </div>
            </div>

            {{-- Aperçu dashboard (mockup) --}}
            <div class="relative max-w-md mx-auto lg:max-w-none w-full mt-4 lg:mt-0">
                <div class="absolute inset-0 bg-gradient-to-tr from-blue-600 to-orange-500 rounded-2xl rotate-3 opacity-10"></div>
                <div class="relative bg-white border border-gray-100 rounded-2xl shadow-2xl p-4 sm:p-6">

                    {{-- Header mockup --}}
                    <div class="flex items-center justify-between mb-5 sm:mb-6">
                        <div>
                            <div class="text-[11px] sm:text-xs text-gray-400">Tableau de bord</div>
                            <div class="text-base sm:text-lg font-bold text-gray-900">Exercice 2026</div>
                        </div>
                        <div class="flex gap-1.5">
                            <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-red-400"></span>
                            <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-orange-400"></span>
                            <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-green-400"></span>
                        </div>
                    </div>

                    {{-- KPI --}}
                    <div class="grid grid-cols-2 gap-3 mb-5 sm:mb-6">
                        <div class="p-3 sm:p-4 bg-blue-50 rounded-xl">
                            <div class="text-[11px] sm:text-xs text-blue-600 font-medium">Recettes</div>
                            <div class="text-base sm:text-xl font-bold text-blue-700 mt-1 leading-tight">45 200 000</div>
                            <div class="text-[10px] sm:text-xs text-blue-500 mt-1">FCFA</div>
                        </div>
                        <div class="p-3 sm:p-4 bg-orange-50 rounded-xl">
                            <div class="text-[11px] sm:text-xs text-orange-600 font-medium">Dépenses</div>
                            <div class="text-base sm:text-xl font-bold text-orange-700 mt-1 leading-tight">32 800 000</div>
                            <div class="text-[10px] sm:text-xs text-orange-500 mt-1">FCFA</div>
                        </div>
                    </div>

                    {{-- Graphique simulé --}}
                    <div class="mb-4">
                        <div class="flex items-end justify-between h-20 sm:h-24 gap-1.5 sm:gap-2">
                            <div class="w-full bg-blue-200 rounded-t" style="height: 40%"></div>
                            <div class="w-full bg-blue-300 rounded-t" style="height: 65%"></div>
                            <div class="w-full bg-blue-500 rounded-t" style="height: 85%"></div>
                            <div class="w-full bg-orange-300 rounded-t" style="height: 55%"></div>
                            <div class="w-full bg-blue-400 rounded-t" style="height: 75%"></div>
                            <div class="w-full bg-orange-500 rounded-t" style="height: 95%"></div>
                        </div>
                    </div>

                    {{-- Liste --}}
                    <div class="space-y-2">
                        <div class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 gap-2">
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="w-8 h-8 flex-shrink-0 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold">P1</div>
                                <div class="text-xs sm:text-sm font-medium text-gray-700 truncate">Projet Santé</div>
                            </div>
                            <span class="text-[10px] sm:text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded flex-shrink-0">Validé</span>
                        </div>
                        <div class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 gap-2">
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="w-8 h-8 flex-shrink-0 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600 text-xs font-bold">P2</div>
                                <div class="text-xs sm:text-sm font-medium text-gray-700 truncate">Projet Éducation</div>
                            </div>
                            <span class="text-[10px] sm:text-xs font-semibold text-orange-600 bg-orange-50 px-2 py-1 rounded flex-shrink-0">En cours</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- FONCTIONNALITÉS --}}
    {{-- ============================================================ --}}
    <section id="features" class="py-16 sm:py-20 lg:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
                <span class="text-xs sm:text-sm font-semibold text-orange-500 uppercase tracking-wider">Fonctionnalités</span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mt-3">
                    Tout ce dont votre ONG a besoin
                </h2>
                <p class="text-sm sm:text-base text-gray-600 mt-4">
                    Une plateforme pensée pour la gestion financière des projets humanitaires
                    et le reporting aux bailleurs.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @php
                    $features = [
                        [
                            'title' => 'Comptabilité par projet',
                            'desc' => 'Suivez les recettes et dépenses de chaque projet séparément, avec ventilation par bailleur et par ligne budgétaire.',
                            'color' => 'blue',
                            'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z',
                        ],
                        [
                            'title' => 'Budgets & suivi',
                            'desc' => 'Comparez le budget prévisionnel et les dépenses réelles, avec alertes automatiques en cas de dépassement.',
                            'color' => 'orange',
                            'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                        ],
                        [
                            'title' => 'Rapports bailleurs',
                            'desc' => 'Générez automatiquement vos rapports financiers (PDF, Excel) au format exigé par chaque bailleur.',
                            'color' => 'blue',
                            'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                        ],
                        [
                            'title' => 'Multi-utilisateurs',
                            'desc' => 'Gérez les rôles et permissions : comptable, chef de projet, coordonnateur, auditeur externe.',
                            'color' => 'orange',
                            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                        ],
                        [
                            'title' => 'Pièces justificatives',
                            'desc' => 'Attachez les factures, reçus et bordereaux à chaque écriture comptable. Traçabilité garantie.',
                            'color' => 'blue',
                            'icon' => 'M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13',
                        ],
                        [
                            'title' => 'Audit & conformité',
                            'desc' => 'Journal d\'audit complet, historisation des modifications et export des données pour les auditeurs.',
                            'color' => 'orange',
                            'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                        ],
                    ];
                @endphp

                @foreach ($features as $feature)
                    <div class="group bg-white p-5 sm:p-6 rounded-xl border border-gray-100 hover:border-{{ $feature['color'] }}-200 hover:shadow-lg transition">
                        <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-lg bg-{{ $feature['color'] }}-50 flex items-center justify-center mb-4 group-hover:bg-{{ $feature['color'] }}-100 transition">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-{{ $feature['color'] }}-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2">{{ $feature['title'] }}</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- MODULES --}}
    {{-- ============================================================ --}}
    <section id="modules" class="py-16 sm:py-20 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                <div>
                    <span class="text-xs sm:text-sm font-semibold text-orange-500 uppercase tracking-wider">Modules</span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mt-3 mb-5 sm:mb-6">
                        Une architecture modulaire adaptée à votre organisation
                    </h2>
                    <p class="text-sm sm:text-base text-gray-600 mb-6 sm:mb-8">
                        Activez uniquement les modules dont vous avez besoin. Notre plateforme s'adapte
                        à la taille de votre ONG, de la petite association locale à l'organisation internationale.
                    </p>

                    <div class="space-y-4">
                        @php
                            $modules = [
                                ['title' => 'Comptabilité générale', 'desc' => 'Plan comptable SYSCOHADA, journaux, grand livre, balance.'],
                                ['title' => 'Comptabilité analytique', 'desc' => 'Ventilation par projet, bailleur, axe et centre de coût.'],
                                ['title' => 'Gestion des bailleurs', 'desc' => 'Suivi des conventions, échéances et décaissements.'],
                                ['title' => 'Ressources humaines', 'desc' => 'Paie, contrats, suivi des prestataires et consultants.'],
                                ['title' => 'Immobilisations', 'desc' => 'Inventaire, amortissements et suivi des équipements.'],
                                ['title' => 'Reporting & BI', 'desc' => 'Tableaux de bord personnalisables et indicateurs clés.'],
                            ];
                        @endphp

                        @foreach ($modules as $module)
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm sm:text-base font-semibold text-gray-900">{{ $module['title'] }}</div>
                                    <div class="text-xs sm:text-sm text-gray-600">{{ $module['desc'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Bloc visuel --}}
                <div class="relative max-w-md mx-auto lg:max-w-none w-full">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-6 sm:p-8 text-white shadow-2xl">
                        <div class="text-xs sm:text-sm font-medium text-blue-200 mb-2">Exemple de rapport</div>
                        <div class="text-lg sm:text-2xl font-bold mb-5 sm:mb-6 leading-tight">
                            Rapport financier — Projet Santé 2026
                        </div>

                        <div class="space-y-3 sm:space-y-4">
                            <div class="flex items-center justify-between p-3 sm:p-4 bg-white/10 rounded-xl backdrop-blur gap-3">
                                <span class="text-xs sm:text-sm">Budget total</span>
                                <span class="text-sm sm:text-base font-bold text-right">50 000 000 FCFA</span>
                            </div>
                            <div class="flex items-center justify-between p-3 sm:p-4 bg-white/10 rounded-xl backdrop-blur gap-3">
                                <span class="text-xs sm:text-sm">Dépenses engagées</span>
                                <span class="text-sm sm:text-base font-bold text-right">32 800 000 FCFA</span>
                            </div>
                            <div class="flex items-center justify-between p-3 sm:p-4 bg-orange-500 rounded-xl gap-3">
                                <span class="text-xs sm:text-sm font-medium">Taux d'exécution</span>
                                <span class="text-sm sm:text-base font-bold">65,6 %</span>
                            </div>
                        </div>

                        <div class="mt-5 sm:mt-6 pt-5 sm:pt-6 border-t border-white/20">
                            <div class="flex items-center gap-2 text-xs sm:text-sm text-blue-100">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Conforme aux exigences SYSCOHADA
                            </div>
                        </div>
                    </div>

                    {{-- Badge flottant (caché sur très petit écran pour éviter le débordement) --}}
                    <div class="hidden sm:block absolute -bottom-4 -right-4 bg-white rounded-xl shadow-xl p-4 border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">Génération</div>
                                <div class="text-sm font-bold text-gray-900">&lt; 30 secondes</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- AVANTAGES --}}
    {{-- ============================================================ --}}
    <section id="avantages" class="py-16 sm:py-20 lg:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
                <span class="text-xs sm:text-sm font-semibold text-orange-500 uppercase tracking-wider">Avantages</span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mt-3">
                    Pourquoi choisir ComptaONG ?
                </h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                <div class="text-center">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto rounded-2xl bg-blue-100 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2">Réduction des coûts</h3>
                    <p class="text-sm text-gray-600 max-w-xs mx-auto">
                        Diminuez vos frais de gestion et libérez du temps pour vos missions de terrain.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto rounded-2xl bg-orange-100 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2">Conformité garantie</h3>
                    <p class="text-sm text-gray-600 max-w-xs mx-auto">
                        Respectez les normes SYSCOHADA et les exigences de vos bailleurs internationaux.
                    </p>
                </div>

                <div class="text-center sm:col-span-2 lg:col-span-1">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto rounded-2xl bg-blue-100 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2">Mise en œuvre rapide</h3>
                    <p class="text-sm text-gray-600 max-w-xs mx-auto">
                        Déployez votre comptabilité en quelques jours, avec un accompagnement personnalisé.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- CTA FINAL --}}
    {{-- ============================================================ --}}
    <section class="py-16 sm:py-20 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl sm:rounded-3xl p-8 sm:p-12 md:p-16 overflow-hidden">
                {{-- Formes décoratives --}}
                <div class="absolute top-0 right-0 w-48 sm:w-64 h-48 sm:h-64 bg-orange-500 rounded-full blur-3xl opacity-20 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-36 sm:w-48 h-36 sm:h-48 bg-white rounded-full blur-3xl opacity-10 pointer-events-none"></div>

                <div class="relative max-w-2xl">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">
                        Prêt à moderniser la comptabilité de votre ONG ?
                    </h2>
                    <p class="text-sm sm:text-base md:text-lg text-blue-100 mb-6 sm:mb-8">
                        Rejoignez les organisations qui ont déjà simplifié leur gestion financière
                        et gagné en transparence.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center justify-center gap-2 px-5 sm:px-6 py-3 text-sm sm:text-base font-semibold text-blue-700 bg-white rounded-lg hover:bg-gray-50 transition shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Se connecter
                        </a>
                        <a href="#contact"
                           class="inline-flex items-center justify-center gap-2 px-5 sm:px-6 py-3 text-sm sm:text-base font-semibold text-white bg-orange-500 rounded-lg hover:bg-orange-600 transition">
                            Demander une démo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- FOOTER --}}
    {{-- ============================================================ --}}
    <footer id="contact" class="bg-gray-900 text-gray-400 py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8 mb-10 sm:mb-12">
                <div class="sm:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 7h6M9 11h6M9 15h4M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                            </svg>
                        </div>
                        <span class="text-lg sm:text-xl font-bold text-white">
                            Compta<span class="text-blue-500">ONG</span>
                        </span>
                    </div>
                    <p class="text-sm max-w-md">
                        La plateforme de gestion comptable conçue par et pour les organisations
                        de la société civile et humanitaires.
                    </p>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm sm:text-base">Produit</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#features" class="hover:text-blue-400 transition">Fonctionnalités</a></li>
                        <li><a href="#modules" class="hover:text-blue-400 transition">Modules</a></li>
                        <li><a href="#avantages" class="hover:text-blue-400 transition">Avantages</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm sm:text-base">Contact</h4>
                    <ul class="space-y-2 text-sm break-words">
                        <li>contact@comptaong.org</li>
                        <li>+243 000 000 000</li>
                        <li>Kinshasa, RDC</li>
                    </ul>
                </div>
            </div>

            <div class="pt-6 sm:pt-8 border-t border-gray-800 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs sm:text-sm text-center sm:text-left">
                <div>© {{ date('Y') }} ComptaONG. Tous droits réservés.</div>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-blue-400 transition">Mentions légales</a>
                    <a href="#" class="hover:text-blue-400 transition">Confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>