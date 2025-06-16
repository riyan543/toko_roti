<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    // Field yang boleh diisi mass-assignment
    protected $fillable = [
        'user_id',
        'roti_id',
        'jumlah',
    ];

    // Relasi ke tabel roti (satu keranjang milik satu roti)
    public function roti()
    {
        return $this->belongsTo(Roti::class);
    }

    // Relasi ke user (satu keranjang milik satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
