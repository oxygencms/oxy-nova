<?php

namespace Oxygencms\OxyNova\Providers;

use Laravel\Nova\Nova;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerLaravelNovaFieldMacros();

        parent::boot();
    }

    /**
     * Register the package's Nova resources.
     *
     * @return void
     */
    protected function resources()
    {
        Nova::resources(config('oxygen.nova_resources'));
    }

    /**
     * Register some Nova field macros.
     */
    protected function registerLaravelNovaFieldMacros()
    {
        // Add a macro to make a field read only for update
        Field::macro('onUpdateReadOnly', function () {
            return request()->is('*/update-fields') && app()->environment() != 'local'
                ? $this->withMeta(['extraAttributes' => ['readonly' => true]])
                : $this;
        });
    }
}
