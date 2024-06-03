<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
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
            return auth()->user()->role->nama === 'unit';
        });

        Gate::define('superadmin', function (User $user) {
            return auth()->user()->role->nama === 'superadmin';
        });

        Gate::define('pegawai', function (User $user) {
            return auth()->user()->role->nama === 'pegawai';
        });

        if(config('app.env') === 'local') {
            URL::forceScheme('http');
        }

    }
}
