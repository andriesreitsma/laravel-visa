<?php

namespace AndriesReitsma\Visa;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class VisaServiceProvider extends ServiceProvider
{

    /**
     * Register application service
     *
     * @return void
     */
    public function register()
    {
        if (! app()->configurationIsCached()) {
            $this->mergeConfigFrom(__DIR__ . '/../config/visa.php', 'visa');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->routesAreCached()) {
            return;
        }

        Route::middleware('web')->group(__DIR__.'/../routes/web.php');

    }

}
