<?php

namespace App\Http\Controllers\Admin;

use App\Models\GameSession;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $game_sessions = GameSession::all();

        return view('Admin.dashboard')->with('game_sessions', $game_sessions);
    }
}
