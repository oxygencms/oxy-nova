<?php

namespace Oxygencms\OxyNova\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the package routes.
     *
     * @return void
     */
    public function map()
    {
        Route::middleware('web')->group(function () {

            $this->mapSetLocaleRoute();

            //

        });
    }

    /**
     * Define the route used to set the app locale.
     *
     * @return void
     */
    protected function mapSetLocaleRoute()
    {
        Route::get('set-locale/{locale}', config('oxygen.locale_controller') . '@setLocale')
             ->name('setLocale');
    }
}
