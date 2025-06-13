@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4">🧾 Detail Transaksi</h3>

    <div class="mb-4">
        <p><strong>Nama User:</strong> {{ $transaksi->user->name }}</p>
        <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d M Y H:i') }}</p>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $produkGabung = [];

                foreach ($transaksi->rotis as $roti) {
                    $nama = $roti->nama;
                    $harga = $roti->harga;

                    if (!isset($produkGabung[$nama])) {
                        $produkGabung[$nama] = [
                            'jumlah' => $roti->pivot->jumlah,
                            'subtotal' => $roti->pivot->subtotal,
                            'harga' => $harga,
                        ];
                    } else {
                        $produkGabung[$nama]['jumlah'] += $roti->pivot->jumlah;
                        $produkGabung[$nama]['subtotal'] += $roti->pivot->subtotal;
                    }
                }
            @endphp

            @foreach ($produkGabung as $nama => $data)
                <tr>
                    <td>{{ $nama }}</td>
                    <td>Rp{{ number_format($data['harga'], 0, ',', '.') }}</td>
                    <td>{{ $data['jumlah'] }}</td>
                    <td>Rp{{ number_format($data['subtotal'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.transactions') }}" class="btn btn-secondary mt-3">← Kembali ke Daftar</a>
</div>
@endsection
