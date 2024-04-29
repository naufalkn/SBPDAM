<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        App::setLocale('id');

        Carbon::setLocale('id');
        
        Gate::define('unit', function (User $user) {
            return auth()->user()->role->nama === 'adminunit';
        });

        Gate::define('superadmin', function (User $user) {
            return auth()->user()->role->nama === 'superadmin';
        });

    }
}
