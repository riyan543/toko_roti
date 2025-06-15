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

  
   
}
