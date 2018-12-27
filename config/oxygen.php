<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Locales
    |--------------------------------------------------------------------------
    |
    | locales - Listing of locales in which the application will be available.
    | locale_controller - The controller used to switch between locales.
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
    | Phrases
    |--------------------------------------------------------------------------
    |
    | phrase_model - The phrases model.
    | phrase_groups - List of available groups to prefix phrases with.
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
    | page_model - The pages model.
    |
    */

    'page_model' => \Oxygencms\OxyNova\Models\Page::class,
    'page_section_model' => \Oxygencms\OxyNova\Models\PageSection::class,

    // layout
    'page_default_layout' => 'app',
    'page_layouts_path' => resource_path('views/vendor/oxygencms/layouts'),
    'page_layouts_package_path' => base_path('vendor/oxygencms/oxy-nova/resources/views/layouts'),

    // template
    'page_default_template' => 'default',
    'page_templates_path' => resource_path('views/vendor/oxygencms/pages'),
    'page_templates_package_path' => base_path('vendor/oxygencms/oxy-nova/resources/views/pages'),

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
];