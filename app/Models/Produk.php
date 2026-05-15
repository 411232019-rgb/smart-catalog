<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';

    /**
     * $fillable digunakan untuk keamanan agar mencegah mass assignment vulnerability.
     * Hanya atribut ini yang bisa diisi secara massal.
     */
    protected $fillable = ['kategori_id', 'nama_produk', 'harga', 'stok', 'deskripsi', 'foto_produk'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
