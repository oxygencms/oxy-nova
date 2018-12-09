<?php

namespace Oxygencms\OxyNova\Controllers;

use Illuminate\Support\Facades\Validator;

class LocaleController extends Controller
{
    /**
     * @param $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLocale($locale)
    {
        $locales = array_keys(config('oxygen.locales'));

        Validator::make(
            ['locale' => $locale],
            ['locale' => "required|string|in:". implode(',', $locales)]
        )->validate();

        session()->put('app_locale', $locale);

        app()->setLocale($locale);

        return redirect()->back();
    }
}
