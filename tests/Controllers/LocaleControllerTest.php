<?php

namespace Oxygencms\OxyNova\Tests\Controllers;

use Tests\TestCase;

class LocaleControllerTest extends TestCase
{
    public function testLocaleValidation()
    {
        $this->startSession()
             ->get(route('setLocale', 'wrong'))
             ->assertSessionHas('errors')
             ->assertRedirect();
    }

    public function testSettingValidLocale()
    {
        $valid_locale = last(array_keys(config('oxygen.locales')));

        $this->startSession()
             ->get(route('setLocale', $valid_locale))
             ->assertSessionHas(['app_locale' => $valid_locale])
             ->assertRedirect();

        $this->assertEquals($valid_locale, $this->app->getLocale());
    }
}
