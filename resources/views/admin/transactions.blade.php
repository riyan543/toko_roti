@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4">📄 Daftar Transaksi</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama User</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
         <tbody>
@foreach ($transaksi as $t)
    @foreach ($t->rotis as $roti)
        <tr>
            <td>{{ $t->user->name }}</td>
            <td>{{ $roti->nama }}</td>
            <td>{{ $roti->pivot->jumlah }}</td>
            <td>Rp{{ number_format($roti->pivot->subtotal, 0, ',', '.') }}</td>
            <td>{{ $t->created_at->format('d M Y H:i') }}</td>
            <td>
                <!-- Tombol Hapus -->
                <form action="{{ route('admin.transaksi.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
@endforeach
</tbody>

        </tbody>
    </table>
</div>
@endsection
