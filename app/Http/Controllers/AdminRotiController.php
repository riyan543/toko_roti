<?php

namespace App\Http\Controllers;

use App\Models\Roti;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRotiController extends Controller
{
    // Menampilkan halaman dashboard admin
    public function index()
    {
        return view('admin.dashboard');
    }

    // Menampilkan daftar semua user dengan role 'user'
    public function users()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }

    // Menampilkan daftar transaksi lengkap dengan relasi user dan roti
    public function transactions()
    {
        $transaksi = Transaksi::with('user', 'rotis')->latest()->get(); // rotis = relasi many-to-many
        return view('admin.transactions', compact('transaksi'));
    }

    // Menghapus transaksi berdasarkan ID
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('admin.transactions')->with('success', 'Transaksi berhasil dihapus.');
    }
}
