# Oxygen CMS package for use with Laravel Nova.

## Installation
Require `"oxygencms/oxy-nova": "^0.1.*"` in your own `composer.json` to get the package.
```
composer require oxygencms/oxy-nova
```


### Config
Publish the `oxygen.php` config file.
```
php artisan vendor:publish --provider='Oxygencms\OxyNova\ServiceProvider' --tag=config
```


### Translation Files
Use the `translations` tag to publish the language files for each locale in the config. (BG & NL available atm).
```
php artisan vendor:publish --provider='Oxygencms\OxyNova\ServiceProvider' --tag=translations
```


### Views
The views can be published with the `views` tag. 
```
php artisan vendor:publish --provider='Oxygencms\OxyNova\ServiceProvider' --tag=views
```


### Migrations, Seeds and Factories
To publish the migrations for this package you can use the `migrations` tag: 
```
php artisan vendor:publish --provider='Oxygencms\OxyNova\ServiceProvider' --tag=migrations
```

To publish the seeders for this package you can use the `seeds` tag: 
```
php artisan vendor:publish --provider='Oxygencms\OxyNova\ServiceProvider' --tag=seeds
```

To publish all of the above at once you can use the `database` tag: 
```
php artisan vendor:publish --provider='Oxygencms\OxyNova\ServiceProvider' --tag=database
```


### Console
There is an artisan command for quick setup using the default config.
```
php artisan oxy-nova:setup
```


### Tests
To run the tests include a `<testsuite>` tag in your project's `phpunit.php` file and point it to the tests dir.
```
<testsuite name="OxyNova">
    <directory suffix="Test.php">./vendor/oxygencms/oxy-nova/tests</directory>
</testsuite>
```


## Functionality
### Phrases
The phrases are neat way to store translations in the database so they can be edited. To utilize them we need to swap
 the default `TranslationServiceProvider` with the `PhraseServiceProvider` in `config/app.php`.
```
//        Illuminate\Translation\TranslationServiceProvider::class,
        Oxygencms\OxyNova\Providers\PhraseServiceProvider::class,
```
The phrase's caching requires cache driver that does support tagging! `predis/predis` is already required in the
 package's composer file so we also need to configure laravel to use it. Set it in the `.env` file.
```
CACHE_DRIVER=redis
```
Then phrases and translations are both accessed with the standard Laravel helpers `@lang()`, `__()`, `trans()` &
 `trans_choice()`. If a phrase exists in the database with the given group/key it will be returned and cached. If not 
 the one from the translation files will be returned instead. If both are present the one from DB will take precedence.