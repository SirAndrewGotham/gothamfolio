<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Work;

class HomeController
{
    public function __invoke()
    {
        $works = Work::latest()->get();
        $customers = Customer::all();

        return view('frontend.'. config('blackie.frontend.theme') .'.home.index', compact('works', 'customers'));
    }
}
