<?php

namespace Oxygencms\OxyNova;

use Config;
use Illuminate\Routing\Router;
use Oxygencms\OxyNova\Middleware\SetLocale;
use Oxygencms\OxyNova\Commands\OxyNovaSetup;
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
        $this->defineConstants();

        $this->mergeConfigFrom(__DIR__ . '/../config/oxygen.php', 'oxygen');

        $this->configureMediaLibrary();

        $this->app->register(config('oxygen.route_service_provider'));

        $this->app->register(config('oxygen.nova_service_provider'));
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

    /**
     * Define constants to use instead of hard coding models.
     *
     * @return void
     */
    protected function defineConstants(): void
    {
        if (!defined('OXYGEN_PHRASE')) define('OXYGEN_PHRASE', config('oxygen.phrase_model'));

        if (!defined('OXYGEN_PAGE')) define('OXYGEN_PAGE', config('oxygen.page_model'));

        if (!defined('OXYGEN_PAGE_SECTION')) define('OXYGEN_PAGE_SECTION', config('oxygen.page_section_model'));
    }

    /**
     * Configure few media library related options.
     *
     * @return void
     */
    protected function configureMediaLibrary()
    {
        Config::set('filesystems.disks.media', config('oxygen.media_disk'));

        Config::set('medialibrary.disk_name', config('oxygen.default_media_disk'));

        Config::set('medialibrary.image_driver', config('oxygen.image_driver'));
    }
}
