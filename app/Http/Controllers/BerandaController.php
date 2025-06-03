<?php

namespace App\Http\Controllers;

use App\Models\Roti;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
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