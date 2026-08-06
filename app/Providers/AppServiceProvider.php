<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL; // ← ajoute cette ligne

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    //public function boot()
    // {
    //if ($this->app->environment('local')) {
    // URL::forceScheme('https');
    //}
    // }


    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
