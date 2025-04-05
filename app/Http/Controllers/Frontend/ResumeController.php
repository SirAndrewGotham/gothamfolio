<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ResumeController extends Controller
{
    public function __invoke(): View
    {
        return view('frontend.'.config('gothamfolio.frontend.theme').'.resume.index');
    }
}
