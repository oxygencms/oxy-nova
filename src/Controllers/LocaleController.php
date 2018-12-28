<?php

namespace Oxygencms\OxyNova\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Oxygencms\OxyNova\Models\Page;

class LocaleController extends Controller
{
    /**
     * @param         $locale
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLocale($locale, Request $request)
    {
        $locales = array_keys(config('oxygen.locales'));

        Validator::make(
            ['locale' => $locale],
            ['locale' => "required|string|in:". implode(',', $locales)]
        )->validate();

        $current_locale = session()->get('app_locale') ?: app()->getLocale();

        session()->put('app_locale', $locale);

        if (session()->has('_previous.url')) {
            $prefix = $request->getSchemeAndHttpHost() . '/';

            $slug = str_replace($prefix, '',  session()->get('_previous.url'));

            $page = Page::bySlug($slug, $current_locale)->first();
        }

        return isset($page)
            ? redirect()->to($page->getTranslation('slug', $locale))
            : redirect()->back();
    }
}
