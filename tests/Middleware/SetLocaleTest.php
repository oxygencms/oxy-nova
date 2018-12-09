<?php

namespace Oxygencms\OxyNova\Tests\Middleware;

use Tests\TestCase;

class SetLocaleTest extends TestCase
{
    public $default_locale;

    public function setUp()
    {
        parent::setUp();

        $this->default_locale = config('app.locale');

        $this->startSession();
    }

    /**
     * @test
     */
    public function testSetDefaultLocale()
    {
        $this->get('/')
             ->assertSessionHas(['app_locale' => $this->default_locale]);

        $this->assertEquals($this->default_locale, $this->app->getLocale());
    }

    /**
     * @test
     */
    public function testInvalidLocaleCantBeSet()
    {
        $this->session(['app_locale' => 'wrong'])
             ->get('/')
             ->assertSessionHas(['app_locale' => $this->default_locale]);

        $this->assertEquals($this->default_locale, $this->app->getLocale());
    }

    /**
     * @test
     */
    public function testSetLocale()
    {
        $valid_locale = last(array_keys(config('oxygen.locales')));

        $this->session(['app_locale' => $valid_locale])
             ->get('/')
             ->assertSessionHas(['app_locale' => $valid_locale]);

        $this->assertEquals($valid_locale, $this->app->getLocale());
    }
}
