<!DOCTYPE html>
<html>
<head>
    <title>Daftar</title>
</head>
<body>
    <h1>Daftar Roti</h1>

    <ul>
        @foreach ($data as $roti)
            <li>{{ $roti['nama'] }} - Rp{{ number_format($roti['harga']) }}</li>
        @endforeach
    </ul>
</body>
</html>
