<?php

namespace App\Http\Controllers\Site;

use Illuminate\Routing\Controller;

class SiteController extends Controller
{
    public function home()
    {
        return view('Site.countdown')->with('foo', 'bar');
    }
}
