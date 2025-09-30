<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Language;
use Illuminate\Http\RedirectResponse;

class LanguageController
{
    public function __invoke(string $locale): RedirectResponse
    {
        // Only allow switching to active languages
        $isActiveLanguage = Language::query()
            ->where('code', $locale)
            ->where('is_active', true)
            ->exists();

        if ($isActiveLanguage) {
            app()->setLocale($locale);
            session()->put('language', $locale);
        }

        return redirect()->back();
    }
}
