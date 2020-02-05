<?php

namespace Oxygencms\OxyNova\Providers;

use Oxygencms\OxyNova\Models\Page;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var Page $page_model
     */
    protected $page_model;

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindPageSlug();

        parent::boot();
    }

    /**
     * Define the package routes.
     *
     * @return void
     */
    public function map()
    {
        Route::domain(config('app.url'))->group(function () {
            Route::get('/', config('oxygen.home_controller') . '@show')
                 ->name('home')
                 ->middleware('web');
        });

        App::booted(function () {
            // if the request is not the Laravel Nova path
            if ( ! request()->is(implode('/', array_filter(explode('/', config('nova.path')))))) {
                // register page.show as THE LAST route (match pages by slug)
                Route::get('{page_slug}', config('oxygen.page_controller') . '@show')
                     ->name('page.show')
                     ->middleware('web');
            }

            Route::get('set-locale/{locale}', config('oxygen.locale_controller') . '@setLocale')
                 ->name('setLocale')
                 ->middleware('web');
        });
    }

    /**
     * Bind the {page_slug} route param for the page.show route.
     *
     * @return void
     */
    protected function bindPageSlug()
    {
        $page_model_str = OXYGEN_PAGE;

        $this->page_model = new $page_model_str;

        // Explicitly bind the page_slug because of the translations (json)
        Route::bind('page_slug', function ($slug) {

            $locale = session('app_locale') ?: app()->getLocale();

            $page = $this->page_model::bySlug($slug, $locale)->first();

            if ($page) return $page;

            // search for this slug in the reset of the locales
            $locales = config('oxygen.locales');

            unset($locales[$locale]);

            foreach ($locales as $key => $name) {

                $page = $this->page_model::bySlug($slug, $key)->first();

                if ($page) {
                    session()->put('app_locale', $key);

                    return $page;
                }
            }

            return abort(404);
        });
    }
}
