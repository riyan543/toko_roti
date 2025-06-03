@php
    
@extends('layouts.admin')

    <li class="nav-item mt-4">
        <div class="text-uppercase text-muted fw-bold small mb-2 px-3">🔧 Admin Menu</div>
    </li>

    <li class="nav-item mb-2">
        <a href="{{ route('admin.transactions') }}" class="nav-link d-flex align-items-center px-3 py-2 rounded {{ request()->routeIs('admin.transactions') ? 'bg-light fw-bold text-primary' : 'text-dark' }}">
            <i class="bi bi-receipt me-2"></i> Lihat Transaksi
        </a>
    </li>

    <li class="nav-item mb-2">
        <a href="{{ route('admin.users') }}" class="nav-link d-flex align-items-center px-3 py-2 rounded {{ request()->routeIs('admin.users') ? 'bg-light fw-bold text-primary' : 'text-dark' }}">
            <i class="bi bi-people me-2"></i> Manajemen Akun User
        </a>
    </li>

