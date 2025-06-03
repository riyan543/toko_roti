<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
        use HasFactory;

    protected $fillable = [
        'user_id',
        'roti_id',
        'jumlah',
    ];

    public function roti()
{
    return $this->belongsTo(Roti::class);
}

}
