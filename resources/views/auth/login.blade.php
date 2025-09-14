
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - CampuSave</title>
          <!-- Favicons -->

        <link rel="icon" href="{{ asset('user/landing/img/toga.jpg') }}">
        <link rel="apple-touch-icon" href="{{ asset('user/landing/img/toga.jpg') }}">
        <link rel="stylesheet" href="{{ asset('user/landing/css/login.css') }}">
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="login-box">

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('status') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

            <h2>Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="user-box">
                    <input type="email" id="email" name="email" required="" value="{{ old('email') }}" autocomplete="username">
                    <label>Email</label>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="user-box">
                    <input type="password" id="password" name="password" required="" autocomplete="current-password">
                    <label>Password</label>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
                <br>
                <div>
                    <button type="submit" class="btn-login">Sign in</button>
                </div>
                <p class="Belum">Belum punya akun? <a class="Daftar" href="{{ route('register') }}">Daftar sekarang</a></p>
            </form>
        </div>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>

