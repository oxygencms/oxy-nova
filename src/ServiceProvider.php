<?php

namespace Oxygencms\OxyNova;

use Illuminate\Routing\Router;
use Oxygencms\OxyNova\Middleware\SetLocale;
use Oxygencms\OxyNova\Commands\OxyNovaSetup;
use Oxygencms\OxyNova\Providers\NovaServiceProvider;
use Oxygencms\OxyNova\Providers\RouteServiceProvider;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @param Router $router
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->pushMiddlewareToGroup('web', SetLocale::class);

        $this->publishes([
            __DIR__ . '/../config/oxygen.php' => config_path('oxygen.php')
        ], 'config');

        $this->publishTranslations();

        $this->publishViews();

        $this->publishDatabase();

        $this->registerConsoleCommands();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/oxygen.php', 'oxygen');

        $this->app->register(RouteServiceProvider::class);

        $this->app->register(NovaServiceProvider::class);
    }

    /**
     * Publishes all available translation files depending on the locales configured.
     *
     */
    public function publishTranslations()
    {
        $path = __DIR__ . '/../resources/lang';

        $translations = [];

        foreach (array_keys(config('oxygen.locales')) as $locale) {
            if (file_exists("$path/$locale")) {
                $translations["$path/$locale"] = resource_path("lang/$locale");
            }
        }

        $this->publishes($translations, 'translations');
    }

    /**
     * Publishes all available views.
     *
     */
    public function publishViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'oxygen');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/oxygen'),
        ], 'views');
    }

    /**
     * Publishes all database related publishers.
     * The 'database' tag will publish them all.
     *
     */
    public function publishDatabase()
    {
        $this->publishes([
            __DIR__ . '/../database/factories' => database_path('factories'),
        ], 'factories');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../database/seeds' => database_path('seeds'),
        ], 'seeds');

        $this->publishes(array_filter([
            __DIR__ . '/../database/factories' => database_path('factories'),
            __DIR__ . '/../database/migrations' => database_path('migrations'),
            __DIR__ . '/../database/seeds' => database_path('seeds'),
        ]), 'database');
    }

    /**
     * Register the console commands for the package.
     *
     */
    public function registerConsoleCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                OxyNovaSetup::class,
            ]);
        }
    }
}
