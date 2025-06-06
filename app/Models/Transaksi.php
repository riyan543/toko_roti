<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'total_harga', ];
         public function user()
    {
        return $this->belongsTo(User::class);
    }

public function rotis()
{
    return $this->belongsToMany(Roti::class, 'roti_transaksi')
                ->withPivot('jumlah', 'subtotal')
                ->withTimestamps();
}

}
