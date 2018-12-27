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
        // Set the translatable.locales value so the Translatable Nova field type knows what locales are available.
        // https://github.com/mrmonat/nova-translatable
        \Config::set('translatable.locales', config('oxygen.locales'));

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
