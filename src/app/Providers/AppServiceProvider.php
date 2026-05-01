<?php

namespace App\Providers;

use App\Models\User;
use Carbon\CarbonImmutable;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
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
        FilamentAsset::register([
            Js::make('app-scripts', Vite::asset('resources/js/app.js'))->module(),
        ]);
        $this->configureDefaults();

        Gate::define('manage-instructors', function (User $user) {
            return $user->isRoot();
        });

        Gate::define('manage-students', function (User $user) {
            return $user->isRoot();
        });

        Gate::define('manage-tags', function (User $user) {
            return $user->isRoot();
        });

        Gate::define('manage-assigned-students', function (User $user) {
            return $user->isInstructor();
        });
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(
            fn(): ?Password => app()->isProduction()
                ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
                : null,
        );
    }
}
