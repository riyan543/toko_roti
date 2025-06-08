<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Field yang dapat diisi mass-assignment
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Field yang tidak boleh tampil dalam serialisasi (misal: ke JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting atribut ke tipe data tertentu
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke keranjang (satu user bisa punya banyak item keranjang)
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }

    // Relasi ke transaksi (satu user bisa punya banyak transaksi)
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
