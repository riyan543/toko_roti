@extends('layouts.app')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@section('content')
    <h2 class="mb-4">Keranjang Anda</h2>

    @if(count($keranjang) > 0)
        <table class="table table-striped">
          <thead>
    <tr>
        <th>Nama Roti</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>
</thead>

            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($keranjang as $item)
                    @php $total = $item->roti->harga * $item->jumlah; $grandTotal += $total; @endphp
                   <tr>
    <td>{{ $item->roti->nama }}</td>
    <td>{{ $item->jumlah }}</td>
    <td>Rp{{ number_format($total, 0, ',', '.') }}</td>
    <td>
        <form action="{{ route('checkout.hapus', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Hapus</button>
        </form>
    </td>
</tr>

                @endforeach
                <tr class="table-dark">
                    <td colspan="2" class="text-end fw-bold">Total</td>
                    <td class="fw-bold">Rp{{ number_format($grandTotal, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <form action="{{ route('checkout.bayar') }}" method="POST">
            @csrf
            <button class="btn btn-success" type="submit">Bayar Sekarang</button>
        </form>
    @else
        <div class="alert alert-info">Keranjang masih kosong.</div>
    @endif
@endsection
