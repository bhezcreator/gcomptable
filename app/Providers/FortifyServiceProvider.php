<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ============================================================
        // 1. ACTIONS PAR DÉFAUT
        // ============================================================
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        // ============================================================
        // 2. VUES (c'est ce qui manquait et causait ton erreur)
        // ============================================================

        // Vue de connexion
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // Vue d'inscription
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // Vue "mot de passe oublié"
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        // Vue "réinitialiser le mot de passe"
        Fortify::resetPasswordView(function (Request $request) {
            return view('auth.reset-password', ['request' => $request]);
        });

        // Vue de vérification d'email
        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        // Vue de confirmation de mot de passe
        Fortify::confirmPasswordView(function () {
            return view('auth.confirm-password');
        });

        // Vue de défi 2FA (si tu actives la 2FA)
        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge');
        });

        // ============================================================
        // 3. PERSONNALISATION DE L'AUTHENTIFICATION (optionnel)
        // ============================================================
        // Exemple : autoriser la connexion par email OU nom d'utilisateur
        
        Fortify::authenticateUsing(function (Request $request) {
            $user = \App\Models\User::where('email', $request->email)
                ->orWhere('name', $request->email)
                ->first();

            if ($user && \Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

        // ============================================================
        // 4. RATE LIMITING
        // ============================================================
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('passkeys', function (Request $request) {
            $credentialId = $request->input('credential.id');

            return Limit::perMinute(10)->by(
                ($credentialId ?: $request->session()->getId()).'|'.$request->ip()
            );
        });
    }
}