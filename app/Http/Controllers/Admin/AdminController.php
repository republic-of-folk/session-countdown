<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('Admin.dashboard')->with('foo', 'bar');
    }
}
