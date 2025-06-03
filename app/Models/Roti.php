<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roti extends Model
{
    protected $fillable = ['nama', 'harga', 'deskripsi'];

    public function transaksis()
{
    return $this->belongsToMany(Transaksi::class, 'roti_transaksi')
                ->withPivot('jumlah', 'subtotal')
                ->withTimestamps();
}

}
