<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Customer;
use App\Models\Work;

class HomeController
{
    public function __invoke()
    {
        session()->put('language', config('app.locale'));
        $works = Work::latest()->get();
        $customers = Customer::all();

        return view('frontend.'.config('gothamfolio.frontend.theme').'.home.index', compact('works', 'customers'));
    }
}
