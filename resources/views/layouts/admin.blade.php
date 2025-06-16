<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Toko Roti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Theme for Toko Roti -->
    <style>
        :root {
            --roti-dark: #5C4033;
            --roti-light: #FFF8DC;
            --roti-caramel: #D2B48C;
            --roti-cream: #F5F5DC;
        }

        body {
            background-color: var(--roti-cream);
        }

        .navbar {
            background-color: var(--roti-dark) !important;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #fff;
        }

        .card-roti {
            background-color: var(--roti-light);
            border: 1px solid #e0c097;
            transition: transform 0.3s ease;
        }

        .card-roti:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-roti {
            background-color: var(--roti-caramel);
            color: white;
        }

        .btn-roti:hover {
            background-color: #b8860b;
        }

        footer {
            background-color: var(--roti-light);
            padding: 10px 0;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('beranda') }}">🍞 Toko Roti</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-danger ms-2" type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    @yield('content')
</div>

<footer class="text-center mt-4 text-muted">
    <small>&copy; {{ date('Y') }} Toko Roti</small>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
