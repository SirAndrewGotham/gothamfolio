<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // allow only enabled languages
        $active_languages = Language::query()->where('is_active', true)->pluck('code');

        if (session()->get('language') === null) {
            session()->put('language', Language::query()->where('default', true)->first()->code);
        }

        if ((request('change_language') && ! $active_languages->contains(request('change_language'))) || (session()->has('language') && ! $active_languages->contains(session()->get('language')))) {
            return $next($request);
        }

        if (request('change_language')) {
            session()->put('language', request('change_language'));
            $language = request('change_language');
        } elseif (session('language')) {
            $language = session('language');
        } elseif (Language::query()->where('default', true)->first()) {
            $language = Language::query()->where('default', true)->first()->code;
        }

        if (isset($language)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}
