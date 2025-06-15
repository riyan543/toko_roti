<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use App\Models\Roti;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    // Menambahkan item ke keranjang
    public function add($id)
    {
        $user = Auth::user();

        Keranjang::create([
            'user_id' => $user->id,
            'roti_id' => $id,
            'jumlah' => 1,
        ]);

        return redirect()->back();
    }

    // Menyimpan transaksi dan menghapus isi keranjang
    public function bayar()
    {
        $user = Auth::user();

        // Ambil isi keranjang user
        $items = Keranjang::with('roti')->where('user_id', $user->id)->get();

        if ($items->isEmpty()) {
            return back()->with('error', 'Keranjang Anda kosong.');
        }

        // Hitung total harga
        $total = $items->sum(fn($item) => $item->roti->harga * $item->jumlah);

        // Buat transaksi baru
        $transaksi = Transaksi::create([
            'user_id' => $user->id,
            'total_harga' => $total,
            'status' => 'berhasil',
        ]);

        // Simpan detail roti ke pivot table transaksi_roti
        foreach ($items as $item) {
            $transaksi->rotis()->attach($item->roti_id, [
                'jumlah' => $item->jumlah,
                'subtotal' => $item->jumlah * $item->roti->harga,
            ]);
        }

        // Kosongkan keranjang setelah transaksi
        Keranjang::where('user_id', $user->id)->delete();

        return redirect()->route('checkout.pembayaran')->with('success', 'Transaksi berhasil disimpan.');
    }

    // Menampilkan isi keranjang user
    public function view()
    {
        $user = Auth::user();
        $keranjang = Keranjang::with('roti')
            ->where('user_id', $user->id)
            ->get();

        return view('checkout', compact('keranjang'));
    }

    // Menampilkan halaman pembayaran untuk transaksi terakhir
    public function pembayaran()
    {
        $user = Auth::user();

        // Ambil transaksi terakhir user
        $transaksi = Transaksi::where('user_id', $user->id)->latest()->first();

        if (!$transaksi) {
            return redirect()->route('checkout.view')->with('error', 'Tidak ada transaksi ditemukan.');
        }

        return view('pembayaran', compact('transaksi'));
    }

    // Menghapus item dari keranjang
    public function hapus($id)
    {
        $item = Keranjang::findOrFail($id);

        // Pastikan user yang menghapus adalah pemilik item
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        $item->delete();

        return redirect()->route('checkout.view')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }


}
