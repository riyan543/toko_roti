@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Pembayaran Anda</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
    <p><strong>Total yang harus dibayar:</strong> <span class="text-danger">Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</span></p>

    <h4 class="mt-4">Scan QRIS di bawah untuk membayar</h4>
    <img src="{{ asset('storage/qris-sample.png') }}" alt="QRIS" class="img-fluid" style="max-width: 300px;">
 
    <p class="mt-3">Setelah membayar, simpan bukti dan tunggu konfirmasi admin.</p>

    <a href="{{ route('beranda') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
@endsection
