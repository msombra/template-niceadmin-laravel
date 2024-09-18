<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ControleAcordo;
use App\Observers\ControleAcordoObserver;
use App\Models\Contrato;
use App\Observers\ContratoObserver;

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
        ControleAcordo::observe(ControleAcordoObserver::class);
        Contrato::observe(ContratoObserver::class);
    }
}
