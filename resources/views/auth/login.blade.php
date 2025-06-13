<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Toko Roti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 400px;">
    <h2 class="text-center mb-4">🔐 Login ke Toko Roti</h2>

    @if(session('status'))
        <div class="alert alert-danger">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" name="email" class="form-control" id="email" required autofocus>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" name="password" class="form-control" id="password" required>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Masuk</button>
        </div>
    </form>

    <div class="text-center mt-3">
        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>

    </div>
</div>
</body>
</html>
