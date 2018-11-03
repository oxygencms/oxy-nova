<?php

namespace Oxygencms\OxyNova;

use Illuminate\Routing\Router;
use Oxygencms\OxyNova\Middleware\SetLocale;
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

        $this->publishViews();

        $this->publishTranslations();

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
    }

    public function publishViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'oxygen');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/oxygen'),
        ], 'views');
    }

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

    public function registerConsoleCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Oxygencms\OxyNova\Commands\OxyNovaSetup::class,
            ]);
        }
    }
}
