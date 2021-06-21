<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<form action="" method="post">
    <?php echo csrf_field(); ?>
    <label>
        {{ __('Email') }}
        <input type="email"
               name="email"
               value="{{ old('email') }}"
               required
        >
    </label>
    <label>
        {{ __('Password') }}
        <input type="password"
               name="password"
               required
        >
    </label>
    <button type="submit">
        {{ __('Login') }}
    </button>
    @error('email')
    {{ $message }}
    @enderror
</form>
</body>
</html>
