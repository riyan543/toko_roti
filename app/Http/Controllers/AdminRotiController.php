<?php

namespace App\Http\Controllers;

use App\Models\Roti;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRotiController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
   

    public function users()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }

    public function transactions()
{
    $transaksi = Transaksi::with('user', 'rotis')->latest()->get(); // ✅ 'rotis' bukan 'roti'
    return view('admin.transactions', compact('transaksi'));
}

public function destroy($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $transaksi->delete();

    return redirect()->route('admin.transactions')->with('success', 'Transaksi berhasil dihapus.');
    
}




}
