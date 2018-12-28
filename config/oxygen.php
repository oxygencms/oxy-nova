<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Locales
    |--------------------------------------------------------------------------
    |
    | Configure the locales for the application.
    |
    */

    'locales' => [
        'en' => 'English',
        'bg' => 'Бъларски',
        //        'nl' => 'Dutch',
    ],

    'locale_controller' => \Oxygencms\OxyNova\Controllers\LocaleController::class,

    /*
    |--------------------------------------------------------------------------
    | Service Providers
    |--------------------------------------------------------------------------
    |
    | Configure the service providers for the package.
    |
    */

    'route_service_provider' => \Oxygencms\OxyNova\Providers\RouteServiceProvider::class,
    'nova_service_provider' => \Oxygencms\OxyNova\Providers\NovaServiceProvider::class,

    /*
    |--------------------------------------------------------------------------
    | Nova Resources
    |--------------------------------------------------------------------------
    |
    | List of all Nova Resources used.
    |
    */

    'nova_resources' => [
        \Oxygencms\OxyNova\Nova\Phrase::class,
        \Oxygencms\OxyNova\Nova\Page::class,
        \Oxygencms\OxyNova\Nova\PageSection::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Phrases
    |--------------------------------------------------------------------------
    |
    | Phrases configuration.
    |
    */

    'phrase_model' => \Oxygencms\OxyNova\Models\Phrase::class,

    'phrase_groups' => [
        'db', 'labels', 'placeholders', 'links', 'headings', 'buttons',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pages & Page Sections
    |--------------------------------------------------------------------------
    |
    | Various options for the pages and their sections.
    |
    */

    'page_model' => \Oxygencms\OxyNova\Models\Page::class,
    'page_section_model' => \Oxygencms\OxyNova\Models\PageSection::class,

    'home_controller' => \Oxygencms\OxyNova\Controllers\HomeController::class,
    'page_controller' => \Oxygencms\OxyNova\Controllers\PageController::class,
];