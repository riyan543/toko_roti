@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4">📄 Daftar Transaksi per User</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama User</th>
                <th>Tanggal Transaksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($transaksi as $t)
            <tr>
                <td>{{ $t->user->name }}</td>
                <td>{{ $t->created_at->format('d M Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.detailtransaksi', $t->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>

                    <form action="{{ route('admin.transaksi.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
