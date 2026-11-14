<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Dashboard as PagesDashboard;
use App\Filament\Pages\InstructorDashboard;
use App\Filament\Pages\RootDashboard;
use Filament\Auth\MultiFactor\Email\EmailAuthentication;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets\Js;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Vite;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Rmsramos\Activitylog\ActivitylogPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->brandName(config('app.name'))
            ->path('admin')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->darkMode(false)
            ->globalSearch(false)
            ->login()
            // ->registration()
            ->passwordReset()
            ->profile()
            ->emailVerification()
            ->emailChangeVerification()
            ->multiFactorAuthentication([
                EmailAuthentication::make(),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->homeUrl(fn() => match (auth()->user()?->role) {
                'root' => RootDashboard::getUrl(),
                'instructor' => InstructorDashboard::getUrl(),
                default => '/',
            })
            ->pages([
                // Dashboard::class,
                RootDashboard::class,
                InstructorDashboard::class,
            ])
            // ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                // AccountWidget::class,
                // FilamentInfoWidget::class,
            ])
            ->plugins([
                ActivitylogPlugin::make()->navigationGroup('System Management'),
            ])
            ->navigationGroups([
                NavigationGroup::make('Subject Management'),
                // ->icon('heroicon-o-book-open')
                // ->collapsed(false),
                NavigationGroup::make('System Management'),
                // ->icon('heroicon-o-cog-6-tooth')
                // ->collapsed(false),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->login(Login::class)
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
