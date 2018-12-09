<?php

namespace Oxygencms\OxyNova\Providers;

use Oxygencms\OxyNova\Models\Phrase;
use Oxygencms\OxyNova\Services\PhraseLoader;
use Oxygencms\OxyNova\Observers\PhraseObserver;
use Illuminate\Translation\TranslationServiceProvider;

class PhraseServiceProvider extends TranslationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Phrase::observe(PhraseObserver::class);
    }

    /**
     * Overwrite the default translation loader.
     *
     */
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new PhraseLoader($app['files'], $app['path.lang']);
        });
    }
}
