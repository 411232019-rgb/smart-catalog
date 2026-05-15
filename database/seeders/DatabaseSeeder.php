<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================
        // SEED USERS (Merchants)
        // =====================
        User::updateOrCreate(
            ['email' => 'admin@smartcatalog.com'],
            [
                'name'     => 'Admin Utama',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'toko@umkm.com'],
            [
                'name'     => 'Toko Berkah Jaya',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'merchant@smartcatalog.com'],
            [
                'name'     => 'Warung Bu Sari',
                'password' => Hash::make('password'),
            ]
        );

        $this->command->info('✅ Users seeded.');

        // =====================
        // SEED KATEGORIS
        // =====================
        $kategoris = [
            ['nama_kategori' => 'Makanan & Minuman',   'deskripsi' => 'Produk makanan dan minuman segar maupun kemasan.'],
            ['nama_kategori' => 'Pakaian & Fashion',   'deskripsi' => 'Berbagai pilihan pakaian, baju, celana, dan aksesoris fashion.'],
            ['nama_kategori' => 'Elektronik',          'deskripsi' => 'Gadget, perangkat elektronik, dan aksesori pendukungnya.'],
            ['nama_kategori' => 'Kesehatan & Kecantikan', 'deskripsi' => 'Produk perawatan tubuh, kesehatan, dan kecantikan.'],
            ['nama_kategori' => 'Perlengkapan Rumah',  'deskripsi' => 'Furnitur, peralatan dapur, dan kebutuhan rumah tangga.'],
        ];

        foreach ($kategoris as $k) {
            Kategori::updateOrCreate(['nama_kategori' => $k['nama_kategori']], $k);
        }

        $this->command->info('✅ Kategoris seeded.');

        // =====================
        // SEED PRODUKS
        // =====================
        $makmin  = Kategori::where('nama_kategori', 'Makanan & Minuman')->first();
        $fashion = Kategori::where('nama_kategori', 'Pakaian & Fashion')->first();
        $elektro = Kategori::where('nama_kategori', 'Elektronik')->first();
        $health  = Kategori::where('nama_kategori', 'Kesehatan & Kecantikan')->first();
        $rumah   = Kategori::where('nama_kategori', 'Perlengkapan Rumah')->first();

        $produks = [
            // Makanan & Minuman
            ['kategori_id' => $makmin->id, 'nama_produk' => 'Keripik Singkong Pedas',      'harga' => 15000,   'stok' => 120, 'deskripsi' => 'Keripik singkong renyah dengan bumbu pedas pilihan, cocok untuk camilan sehari-hari.'],
            ['kategori_id' => $makmin->id, 'nama_produk' => 'Kopi Arabika Toraja',          'harga' => 75000,   'stok' => 85,  'deskripsi' => 'Biji kopi arabika dari pegunungan Toraja, kaya aroma dan cita rasa.'],
            ['kategori_id' => $makmin->id, 'nama_produk' => 'Sambal Bajak Homemade',        'harga' => 25000,   'stok' => 60,  'deskripsi' => 'Sambal bajak buatan sendiri dengan rasa autentik dan pedas yang pas.'],
            ['kategori_id' => $makmin->id, 'nama_produk' => 'Teh Hijau Premium',            'harga' => 35000,   'stok' => 200, 'deskripsi' => 'Teh hijau organik pilihan, menyegarkan dan menyehatkan.'],

            // Pakaian & Fashion
            ['kategori_id' => $fashion->id, 'nama_produk' => 'Batik Tulis Motif Parang',   'harga' => 350000,  'stok' => 30,  'deskripsi' => 'Batik tulis tangan motif parang klasik, cocok untuk acara formal maupun kasual.'],
            ['kategori_id' => $fashion->id, 'nama_produk' => 'Kaos Polos Premium Cotton',  'harga' => 85000,   'stok' => 150, 'deskripsi' => 'Kaos polos bahan cotton combed 30s, nyaman dan tahan lama.'],
            ['kategori_id' => $fashion->id, 'nama_produk' => 'Tas Rajut Handmade',         'harga' => 120000,  'stok' => 25,  'deskripsi' => 'Tas rajut buatan tangan dengan desain unik dan modern.'],

            // Elektronik
            ['kategori_id' => $elektro->id, 'nama_produk' => 'Earphone Wireless Bluetooth', 'harga' => 180000, 'stok' => 45,  'deskripsi' => 'Earphone nirkabel dengan konektivitas Bluetooth 5.0 dan baterai tahan lama.'],
            ['kategori_id' => $elektro->id, 'nama_produk' => 'Power Bank 10000mAh',         'harga' => 150000, 'stok' => 70,  'deskripsi' => 'Power bank kapasitas besar 10.000mAh dengan fitur fast charging.'],
            ['kategori_id' => $elektro->id, 'nama_produk' => 'Lampu LED Philips 10W',       'harga' => 45000,  'stok' => 200, 'deskripsi' => 'Lampu LED hemat energi 10 watt, terang dan tahan lama.'],

            // Kesehatan & Kecantikan
            ['kategori_id' => $health->id, 'nama_produk' => 'Masker Wajah Clay',           'harga' => 55000,   'stok' => 90,  'deskripsi' => 'Masker clay untuk membersihkan pori-pori dan menjaga kulit tetap sehat.'],
            ['kategori_id' => $health->id, 'nama_produk' => 'Vitamin C Effervescent',       'harga' => 40000,  'stok' => 300, 'deskripsi' => 'Suplemen vitamin C 1000mg dalam bentuk effervescent yang menyegarkan.'],

            // Perlengkapan Rumah
            ['kategori_id' => $rumah->id, 'nama_produk' => 'Tumbler Stainless 500ml',      'harga' => 95000,   'stok' => 55,  'deskripsi' => 'Tumbler anti bocor bahan stainless steel, menjaga minuman tetap dingin atau panas.'],
            ['kategori_id' => $rumah->id, 'nama_produk' => 'Lilin Aromaterapi Lavender',   'harga' => 65000,   'stok' => 40,  'deskripsi' => 'Lilin aromaterapi wangi lavender untuk relaksasi dan suasana rumah yang nyaman.'],
        ];

        foreach ($produks as $p) {
            Produk::updateOrCreate(['nama_produk' => $p['nama_produk']], $p);
        }

        $this->command->info('✅ Produks seeded.');

        // =====================
        // SEED TRANSAKSIS
        // =====================
        $allProduks = Produk::all();
        $statuses   = ['pending', 'diproses', 'selesai'];

        $transaksiData = [
            ['produk' => 'Keripik Singkong Pedas',      'jumlah' => 5,  'status' => 'selesai'],
            ['produk' => 'Kopi Arabika Toraja',          'jumlah' => 2,  'status' => 'selesai'],
            ['produk' => 'Batik Tulis Motif Parang',     'jumlah' => 1,  'status' => 'diproses'],
            ['produk' => 'Kaos Polos Premium Cotton',    'jumlah' => 3,  'status' => 'selesai'],
            ['produk' => 'Earphone Wireless Bluetooth',  'jumlah' => 1,  'status' => 'pending'],
            ['produk' => 'Power Bank 10000mAh',          'jumlah' => 2,  'status' => 'selesai'],
            ['produk' => 'Sambal Bajak Homemade',        'jumlah' => 4,  'status' => 'diproses'],
            ['produk' => 'Vitamin C Effervescent',       'jumlah' => 6,  'status' => 'pending'],
            ['produk' => 'Tumbler Stainless 500ml',      'jumlah' => 2,  'status' => 'selesai'],
            ['produk' => 'Masker Wajah Clay',            'jumlah' => 3,  'status' => 'selesai'],
        ];

        foreach ($transaksiData as $t) {
            $produk = Produk::where('nama_produk', $t['produk'])->first();
            if (!$produk) continue;

            Transaksi::create([
                'kode_transaksi' => 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(5)),
                'produk_id'      => $produk->id,
                'jumlah'         => $t['jumlah'],
                'total_harga'    => $produk->harga * $t['jumlah'],
                'status'         => $t['status'],
            ]);
        }

        $this->command->info('✅ Transaksis seeded.');
        $this->command->info('');
        $this->command->info('🎉 Semua data contoh berhasil diisi!');
        $this->command->info('   Login: admin@smartcatalog.com / password');
    }
}
