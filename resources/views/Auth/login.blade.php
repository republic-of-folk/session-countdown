<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>
    <style>
        body {
            min-height: 100vh;
        }
    </style>
    <link rel="stylesheet" href="{{ mix('css/admin.min.css') }}">
</head>
<body class="d-flex">
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4 pt-md-5">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-floating mb-3">
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="email"
                           required
                    >
                    <label>
                        {{ __('Email') }}
                    </label>
                    <div class="invalid-feedback">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="password"
                           required
                    >
                    <label>
                        {{ __('Password') }}
                    </label>
                    <div class="invalid-feedback">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <button type="submit"
                        class="btn btn-primary"
                >
                    {{ __('Login') }}
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
