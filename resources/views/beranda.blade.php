@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- Tombol Titik Tiga -->
        <div class="py-2 px-3 bg-bakery-light border-bottom d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-bakery fw-bold">🍞 Home Bakery</h5>
            <button class="btn btn-sm btn-outline-bakery rounded-circle" onclick="toggleSidebar()">
                &#x22EE;
            </button>
        </div>

        <!-- Sidebar -->
        <div id="sidebar" class="sidebar-custom shadow-lg">
            <div class="p-3">
                <h4 class="text-bakery fw-bold mb-4">🍞 Home Bakery</h4>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ route('beranda') }}" class="nav-link text-bakery-dark fw-semibold">🏠 Beranda</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('checkout.view') }}" class="nav-link text-bakery-dark fw-semibold">🛒 Keranjang</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('profile.edit') }}" class="nav-link text-bakery-dark fw-semibold">👤 Profil</a>
                    </li>
                    <li class="nav-item mt-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger rounded-pill w-100 shadow-sm">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="col-12 py-5 px-4">
            <h2 class="fw-bold text-bakery mb-4">🥖 Freshly Baked with Love — From Our Home Bakery to You</h2>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @foreach ($rotis as $roti)
                <div class="col">
                    <div class="card h-100 border-0 rounded-4 shadow bakery-card"
                         data-nama="{{ $roti->nama }}"
                         data-gambar="{{ asset('storage/' . $roti->gambar) }}"
                         data-deskripsi="{{ $roti->deskripsi }}"
                         onclick="showProductModal(this)">

                        <img src="{{ asset('storage/' . $roti->gambar) }}"
                             alt="Gambar {{ $roti->nama }}"
                             class="card-img-top rounded-top-4 object-fit-cover"
                             style="height: 230px; object-fit: cover;">

                        <div class="card-body d-flex flex-column px-4 pb-4">
                            <h5 class="card-title fw-semibold text-bakery-dark">{{ $roti->nama }}</h5>
                            <p class="card-text text-muted small mb-2">{{ Str::limit($roti->deskripsi, 80) }}</p>

                            <div class="mb-3">
                                <span class="price-badge">
                                    Rp{{ number_format($roti->harga, 0, ',', '.') }}
                                </span>
                            </div>

                            <form method="POST" action="{{ route('checkout.add', $roti->id) }}" class="mt-auto">
                                @csrf
                                <button type="submit" class="btn btn-bakery w-100 rounded-pill shadow-sm py-2 fw-semibold">
                                    + Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal Deskripsi Produk -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="mo dal-header bg-bakery-light">
        <h5 class="modal-title text-bakery" id="productModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body p-4">
        <img id="modalProductImage"
     src=""
     class="img-fluid rounded mb-4 d-block mx-auto"
     style="max-height: 300px; width: auto; object-fit: contain;"
     alt="">
     <p id="modalProductDescription" class="text-muted"></p>
      </div>
    </div>
  </div>
</div>

<!-- Style -->
<style>
    body {
        background-color: #fffaf3;
    }

    .bg-bakery-light {
        background-color: #fff4e6;
    }

    .text-bakery {
        color: #a0522d;
    }

    .text-bakery-dark {
        color: #6f4e37;
    }

    .btn-bakery {
        background-color: #d2691e;
        color: white;
        border: none;
    }

    .btn-bakery:hover {
        background-color: #b3581a;
        color: white;
    }

    .btn-outline-bakery {
        border-color: #d2691e;
        color: #d2691e;
    }

    .btn-outline-bakery:hover {
        background-color: #d2691e;
        color: #fff;
    }

    .bakery-card {
        background-color: #fffef8;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
    }

    .bakery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .price-badge {
        background-color: #fef1df;
        color: #a0522d;
        padding: 6px 14px;
        border-radius: 1rem;
        font-weight: bold;
        font-size: 1rem;
    }

    .sidebar-custom {
        position: fixed;
        top: 0;
        left: -300px;
        height: 100%;
        width: 280px;
        background-color: #fff4e6;
        overflow-y: auto;
        transition: left 0.3s ease-in-out;
        z-index: 1055;
    }

    .sidebar-custom.show {
        left: 0;
    }

    .sidebar-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1050;
        display: none;
    }

    .sidebar-backdrop.show {
        display: block;
    }
</style>

<!-- Script -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('show');
    }

    function showProductModal(card) {
        const nama = card.getAttribute('data-nama');
        const gambar = card.getAttribute('data-gambar');
        const deskripsi = card.getAttribute('data-deskripsi');

        document.getElementById('productModalLabel').textContent = nama;
        document.getElementById('modalProductImage').src = gambar;
        document.getElementById('modalProductImage').alt = "Gambar " + nama;
        document.getElementById('modalProductDescription').textContent = deskripsi;

        const modal = new bootstrap.Modal(document.getElementById('productModal'));
        modal.show();
    }
</script>
@endsection
