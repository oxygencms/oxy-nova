<?php

$config = [

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
    | Nova Resources
    |--------------------------------------------------------------------------
    |
    | List of all Nova Resources used.
    |
    */

    'nova_resources' => [
        'phrase' => \Oxygencms\OxyNova\Nova\Phrase::class
    ],

];

// Set the translatable.locales value so the Translatable field type knows what locales are available.
// https://github.com/mrmonat/nova-translatable
Config::set('translatable.locales', $config['locales']);

return $config;