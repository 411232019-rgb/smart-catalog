<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';

    // $fillable menentukan kolom mana yang boleh diisi via create() atau update().
    // Tanpa ini, Laravel memblokir mass assignment untuk mencegah pengguna
    // menyisipkan kolom berbahaya (misal: is_admin) langsung dari request.
    protected $fillable = ['nama_kategori', 'deskripsi'];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
