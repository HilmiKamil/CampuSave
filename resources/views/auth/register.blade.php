
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Registrasi</title>
          <!-- Favicons -->

  <link rel="icon" href="{{ asset('user/landing/img/toga.jpg') }}">
  <link rel="apple-touch-icon" href="{{ asset('user/landing/img/toga.jpg') }}">
        <link rel="stylesheet" href="{{ asset('user/landing/css/regis.css') }}" />
    </head>
    <body>
        <div class="container">
            <form class="form-box" method="POST" action="{{ route('register') }}">
                @csrf
                <h2>Registrasi</h2>

                <!-- Name -->
                <input type="text" id="name" name="name" placeholder="Nama Lengkap" required value="{{ old('name') }}" autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                <!-- Email Address -->
                <input type="email" id="email" name="email" placeholder="Email" required value="{{ old('email') }}" autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <!-- Phone Number -->
                <input type="text" id="phone_number" name="phone_number" placeholder="Nomor Telepon" required value="{{ old('phone_number') }}" autocomplete="tel" />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />

                <!-- Password -->
                <input type="password" id="password" name="password" placeholder="Password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                <!-- Confirm Password -->
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                <button type="submit">Daftar</button>
                <p class="login-link">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
            </form>
        </div>
    </body>
    </html>

