@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4">📄 Daftar Menu Admin</h3>

    <div class="row g-4">
        <!-- Kartu Lihat Transaksi -->
        <div class="col-md-6">
            <a href="{{ route('admin.transactions') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100 {{ request()->routeIs('admin.transactions') ? 'bg-primary text-white' : 'bg-light' }} hover-zoom">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-receipt fs-2 {{ request()->routeIs('admin.transactions') ? 'text-white' : 'text-primary' }}"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-semibold">Lihat Transaksi</h5>
                            <p class="mb-0 small text-muted {{ request()->routeIs('admin.transactions') ? 'text-white-50' : '' }}">Pantau semua transaksi pembelian roti</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Kartu Manajemen Akun User -->
        <div class="col-md-6">
            <a href="{{ route('admin.users') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100 {{ request()->routeIs('admin.users') ? 'bg-primary text-white' : 'bg-light' }} hover-zoom">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-people fs-2 {{ request()->routeIs('admin.users') ? 'text-white' : 'text-primary' }}"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-semibold">Manajemen Akun User</h5>
                            <p class="mb-0 small text-muted {{ request()->routeIs('admin.users') ? 'text-white-50' : '' }}">Kelola informasi dan hak akses pengguna</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
