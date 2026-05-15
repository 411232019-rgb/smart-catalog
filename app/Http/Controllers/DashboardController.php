<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKategori = Kategori::count();
        $totalProduk = Produk::count();
        $totalMerchant = User::count();
        $totalTransaksi = Transaksi::count();
        
        $recentProducts = Produk::with('kategori')->orderBy('created_at', 'desc')->take(5)->get();
        $recentTransactions = Transaksi::with('produk')->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact('totalKategori', 'totalProduk', 'totalMerchant', 'totalTransaksi', 'recentProducts', 'recentTransactions'));
    }
}
