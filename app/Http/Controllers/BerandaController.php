<?php

namespace App\Http\Controllers;

use App\Models\Roti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
public function index()
{
    
      if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect('/admin/dashboard');
    }

    $rotis = Roti::all();
    return view('beranda', compact('rotis'));
}

 public function store(Request $request)
    {
         $path = $request->file('gambar')->store('roti', 'public');

    Roti::create([
        'nama' => $request->nama,
        'harga' => $request->harga,
        'gambar' => $path
    ]);

    return redirect('/');
    }
}