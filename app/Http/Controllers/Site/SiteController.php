<?php

namespace App\Http\Controllers\Site;

use App\Models\GameSession;
use Illuminate\Routing\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $next_two_games = GameSession::where('event_date', '>', now())
                                     ->orderBy('event_date')
                                     ->limit(2)
                                     ->get();

        $current_game = count($next_two_games) > 0 ? $next_two_games[0] : NULL;
        $next_game = count($next_two_games) > 1 ? $next_two_games[1] : NULL;

        return view('Site.countdown')
            ->with('current_game', $current_game)
            ->with('next_game', $next_game);
    }
}
