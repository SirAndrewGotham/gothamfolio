<?php

namespace App\Http\Controllers\Frontend;

class LanguageController
{
    public function __invoke($locale)
    {
        // Set current locale to the one requested
        app()->setLocale($locale);

        // Store language into the session
        session()->put('language', $locale);

        return redirect()->back();
    }
}
