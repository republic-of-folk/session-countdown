<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        table {
            border: 1px solid black;
        }

        table th {
            border-bottom: 1px solid black;
        }

        table th:not(:last-child),
        table td:not(:last-child) {
            border-right: 1px solid black;
        }
    </style>
</head>
<body>
<form action="{{ route('auth.logout') }}" method="post">
    <?php echo csrf_field(); ?>
    <button type="submit">
        {{ __('Logout') }}
    </button>
</form>
@if(!empty($game_sessions))
    <table>
        <tr>
            <th>Name</th>
            <th>Date</th>
        </tr>
        @foreach($game_sessions as $game_session)
            <tr>
                <td>{{$game_session->name}}</td>
                <td>{{$game_session->event_date}}</td>
            </tr>
        @endforeach
    </table>
@else
    No game sessions
@endif
</body>
</html>
