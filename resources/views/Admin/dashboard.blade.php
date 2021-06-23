<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <script>
        window.Laravel = <?php /** @noinspection PhpUndefinedFieldInspection */
        echo json_encode([
            'token' => auth()->user()->api_token,
        ]); ?>
    </script>
    <script src="{{mix('js/admin.js')}}" defer></script>
</head>
<body>
<form action="{{ route('auth.logout') }}" method="post">
    <?php echo csrf_field(); ?>
    <button type="submit">
        {{ __('Logout') }}
    </button>
</form>
<div id="app">
    <game-session-list></game-session-list>
</div>
</body>
</html>
