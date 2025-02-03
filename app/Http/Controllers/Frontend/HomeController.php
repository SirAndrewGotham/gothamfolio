<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Work;

class HomeController
{
    public function __invoke()
    {
        $works = Work::all();
        $customers = Customer::all();

        return view('frontend.legacy.home', compact('works', 'customers'));
    }
}
