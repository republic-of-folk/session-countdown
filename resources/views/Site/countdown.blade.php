<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Countdown</title>
</head>
<body>
@if($current_game)
    <div class="current-game">
        <div class="game-name">
            Current game: {{ $current_game->name }}
        </div>
        <div class="game-date" data-date="{{ $current_game->event_date }}">
            {{ $current_game->event_date }}
        </div>
        <div class="game-countdown">
            in 0 days, 00 hours, 00 minutes, 00 seconds
        </div>
    </div>
    @if($next_game)
        <br>
        <div class="next-game">
            <div class="game-name">
                Next game: {{ $next_game->name }}
            </div>
            <div class="game-date" data-date="{{ $next_game->event_date }}">
                {{ $next_game->event_date }}
            </div>
            <div class="game-countdown">
                in 0 days, 00 hours, 00 minutes, 00 seconds
            </div>
        </div>
    @endif
@else
    No game planned
@endif

<script src="{{asset('js/site.js')}}"></script>
</body>
</html>
