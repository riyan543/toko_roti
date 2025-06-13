<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roti extends Model
{
    use HasFactory;

    // Field yang dapat diisi mass-assignment
    protected $fillable = ['nama', 'harga', 'deskripsi'];

    // Relasi many-to-many ke transaksi melalui tabel pivot 'roti_transaksi'
    public function transaksis()
    {
        return $this->belongsToMany(Transaksi::class, 'roti_transaksi')
                    ->withPivot('jumlah', 'subtotal') // Data tambahan pada tabel pivot
                    ->withTimestamps(); // Menyimpan waktu created_at dan updated_at
    }
}
