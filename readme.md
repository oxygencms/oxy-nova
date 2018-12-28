# Oxygen CMS package for use with Laravel Nova.

## Installation
Require `"oxygencms/oxy-nova": "^0.1.*"` in your own `composer.json` to get the package.
```
composer require oxygencms/oxy-nova
```

Since this package requires [spatie/laravel-medialibrary](https://docs.spatie.be/laravel-medialibrary/) to deal with
uploads and media make sure you have it's migration published and run.
```
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
```  

By default file conversions will be queued. It is recommended to set the `QUEUE_CONNECTION=redis` in your `.env` file.
If you do so also make sure to create the `failed_jobs` table. Then just run the queue worker as usual.
```
php artisan queue:failed-table
```


### Config
Publish the `oxygen.php` config file.
```
php artisan vendor:publish --provider='Oxygencms\OxyNova\ServiceProvider' --tag=config
```

Define the 'media' disk for the media library in the `config/filesystem.php` file.
```
    'media_disk' => [
        'driver' => 'local',
        'root' => storage_path('app/public/media'),
        'url' => env('APP_URL').'/media',
        'visibility' => 'public',
    ]
```

Publish the config for the media library it self.
```
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag=config
```

In `config/medialibrary.php` set the default `disk_name` and *optionally* the `image_driver`  
```
'disk_name' => 'media',

'image_driver' => 'imagick'
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
To publish the factories for this package you can use the `factories` tag: 
```
php artisan vendor:publish --provider='Oxygencms\OxyNova\ServiceProvider' --tag=factories
```

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

To include some dummy data for the packages entities add the `SEED_TEST_DATA=true` to the
`.env` file and seed your database with `php artisan migrate:fresh --seed` command.


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
 
 
### Pages
Using pages allows for easier management of the applications content and SEO. If a page has different slug for a given
locale, visiting that slug will change the application locale. While on a page changing the application locale by
hitting the `setLocale` route will redirect to the the slug of the page in the selected locale. Pages can have many
sections via the `$page->sections(): HasMany` relationship. On `$page->delete()` all sections that belong to the page
will be soft deleted and on `$page->resotre()` they will be restored automatically.

### Page Sections
Page sections provide a simple way for adding additional content to a page. The owning page can be accessed via the
`$pageSection->page(): BelongsTo` relationship. When updating a page section if `APP_ENV=production` the name will no
longer be editable field because it may be in use in a view or controller to access a given section for a page.