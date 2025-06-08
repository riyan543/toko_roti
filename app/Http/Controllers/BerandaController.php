<?php

namespace App\Http\Controllers;

use App\Models\Roti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    // Menampilkan halaman beranda (untuk user biasa)
    public function index()
    {
        // Jika user adalah admin, redirect ke dashboard admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        // Ambil semua roti untuk ditampilkan di beranda
        $rotis = Roti::all();
        return view('beranda', compact('rotis'));
    }

    // Menyimpan roti baru ke database (jika digunakan oleh admin)
    public function store(Request $request)
    {
        // Simpan gambar ke dalam storage/public/roti
        $path = $request->file('gambar')->store('roti', 'public');

        // Simpan data roti ke database
        Roti::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'gambar' => $path
        ]);

        return redirect('/');
    }
}
