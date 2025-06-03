<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use App\Models\Roti;



class CheckoutController extends Controller
{
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
  public function bayar()
{
    $user = Auth::user();

    $items = Keranjang::with('roti')->where('user_id', $user->id)->get();

    if ($items->isEmpty()) {
        return back()->with('error', 'Keranjang Anda kosong.');
    }

    $total = $items->sum(fn($item) => $item->roti->harga * $item->jumlah);

    $transaksi = Transaksi::create([
        'user_id' => $user->id,
        'total_harga' => $total,
        'status' => 'berhasil',
    ]);

    foreach ($items as $item) {
        $transaksi->rotis()->attach($item->roti_id, [
            'jumlah' => $item->jumlah,
            'subtotal' => $item->jumlah * $item->roti->harga,
        ]);
    }

    Keranjang::where('user_id', $user->id)->delete();

    return redirect()->route('checkout.view')->with('success', 'Transaksi berhasil disimpan.');
}

public function view()
{
    $user = Auth::user();
   $keranjang = \App\Models\Keranjang::with('roti')
        ->where('user_id', $user->id)
        ->get();


    return view('checkout', compact('keranjang'));
}



}
