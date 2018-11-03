<?php

namespace Oxygencms\OxyNova\Middleware;

use Closure;

class SetLocale
{
    /**
     * Keeps the desired app locale in session.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = session('app_locale');

        if (is_null($locale) || ! array_has(config('oxygen.locales'), $locale))
        {
            session()->put('app_locale', config('app.locale'));
        }

        app()->setLocale(session('app_locale'));

        return $next($request);
    }
}
