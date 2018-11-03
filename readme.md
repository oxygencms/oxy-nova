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


### Translations
Use the `translations` tag to publish the language files for each locale in the config. (BG & NL available atm).
```
php artisan vendor:publish --provider='Oxygencms\OxyNova\ServiceProvider' --tag=translations
```


### Views
The views can be published with the `views` tag. 
```
php artisan vendor:publish --provider='Oxygencms\OxyNova\ServiceProvider' --tag=views
```


### Tests
To run the tests include a `<testsuite>` tag in your project's `phpunit.php` file and point it to the tests dir.
 
```
<testsuite name="OxyNova">
    <directory suffix="Test.php">./vendor/oxygencms/oxy-nova/tests</directory>
</testsuite>
```
