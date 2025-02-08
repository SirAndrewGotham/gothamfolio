<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ResumeController extends Controller
{
    public function __invoke()
    {
        return view('frontend.'. config('gothamfolio.frontend.theme') .'.resume.index');
    }
}
