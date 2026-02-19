<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Filament\Auth\Http\Responses\Contracts\LoginResponse as LoginResponseContract;
use App\Http\Responses\LoginResponse;

use Filament\Auth\Http\Responses\Contracts\LogoutResponse as LogoutResponseContract;
use App\Http\Responses\LogoutResponse;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Login binding (keep yours)
        $this->app->singleton(
            LoginResponseContract::class,
            LoginResponse::class
        );
        $this->app->singleton(
            LogoutResponseContract::class,
            LogoutResponse::class
        );
    }

    public function boot(): void
    {
        //
    }
}
