<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';

    /**
     * $fillable digunakan untuk keamanan agar mencegah mass assignment vulnerability.
     */
    protected $fillable = [
        'kode_transaksi',
        'produk_id',
        'jumlah',
        'total_harga',
        'status',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
