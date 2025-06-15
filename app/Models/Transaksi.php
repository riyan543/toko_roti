<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Field yang dapat diisi mass-assignment
    protected $fillable = [
        'user_id',
        'total_harga',
    ];

    // Relasi ke user (setiap transaksi milik satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi many-to-many ke roti melalui tabel pivot 'roti_transaksi'
    public function rotis()
    {
        return $this->belongsToMany(Roti::class, 'roti_transaksi')
                    ->withPivot('jumlah', 'subtotal')
                    ->withTimestamps();
    }
}
