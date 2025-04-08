<?php

namespace App\Http\Controllers;

use App\Models\Language;

abstract class Controller
{
    public function getLanguages()
    {
        $languages[] = Language::where('code', app()->getLocale())->first()->id;
        if (auth()->check()) {
            $languages = Language::where('id', auth()->user()->language_id)->pluck('id');
            if (auth()->user()->languages) {
                $languages = auth()->user()->languages->pluck('id');
            }
        }
        return $languages;
    }
}
