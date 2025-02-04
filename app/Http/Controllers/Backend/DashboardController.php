<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Post;
use App\Models\User;
use App\Models\Work;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $postsCount = Post::all()->count();
        $worksCount = Work::all()->count();
        $customersCount = Customer::all()->count();
        $usersCount = User::all()->count();

        return view('backend.legacy.dashboard', compact('postsCount', 'worksCount', 'customersCount', 'usersCount'));
    }
}
