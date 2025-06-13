<!DOCTYPE html>
<html>
<head>
    <title>Daftar Roti</title>
</head>
<body>
    <h2>Daftar Roti</h2>
    <ul id="roti-list"></ul>

    <script>
        fetch('/api')
            .then(response => response.json())
            .then(data => {
                const list = document.getElementById('roti-list');
                data.forEach(roti => {
                    const li = document.createElement('li');
                    li.textContent = `${roti.nama} - Rp${roti.harga}`;
                    list.appendChild(li);
                });
            });
    </script>
</body>
</html>
