<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->getLocaleFromBrowser($request);

        app()->setLocale(in_array($locale, config('app.supported_locales'))
            ? $locale
            : config('app.locale'));

        return $next($request);
    }

    protected function getLocaleFromBrowser(Request $request): ?string
    {
        return $request->getLanguages()[0] ?? null;
    }
}
