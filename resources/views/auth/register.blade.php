<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Toko Roti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #FFF7E6;
            font-family: 'Segoe UI', sans-serif;
        }
        .register-card {
            background-color: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(139, 94, 60, 0.15);
        }
        .btn-bakery {
            background-color: #8B5E3C;
            color: white;
            border-radius: 10px;
        }
        .btn-bakery:hover {
            background-color: #734a30;
        }
        .form-label {
            color: #8B5E3C;
            font-weight: 600;
        }
        .bakery-logo {
            width: 60px;
        }
        a {
            color: #8B5E3C;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card register-card p-4 w-100" style="max-width: 480px;">
            <div class="text-center mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/869/869636.png" alt="Bakery Logo" class="bakery-logo mb-2">
                <h3 class="fw-bold">Daftar Akun</h3>
                <p class="text-muted small">Yuk buat akun dan nikmati roti pilihanmu 🍞</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('login') }}" class="small">Sudah punya akun?</a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-bakery">Daftar Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
