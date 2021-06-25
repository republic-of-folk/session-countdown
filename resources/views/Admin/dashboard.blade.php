<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>

    <link rel="stylesheet" href="{{ mix('css/admin.min.css') }}">

    <script>
        window.Laravel = <?php /** @noinspection PhpUndefinedFieldInspection */
        echo json_encode([
            'token' => auth()->user()->api_token,
        ]); ?>
    </script>
    <script src="{{mix('js/admin.js')}}" async></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="ms-auto"
                      action="{{ route('auth.logout') }}" method="post">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-outline-primary"
                            type="submit">
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <game-session-list></game-session-list>
            </div>
        </div>
    </div>
</div>
</body>
</html>
