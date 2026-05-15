<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function produk(Request $request)
    {
        $query = Produk::with('kategori');

        // Filter based on stock if requested
        if ($request->has('stok_filter')) {
            if ($request->stok_filter == 'habis') {
                $query->where('stok', '<=', 0);
            } elseif ($request->stok_filter == 'tersedia') {
                $query->where('stok', '>', 0);
            }
        }

        $produks = $query->get();
        $totalStok = $produks->sum('stok');
        $totalAsset = $produks->sum(function($item) {
            return $item->stok * $item->harga;
        });

        return view('laporan.produk', compact('produks', 'totalStok', 'totalAsset'));
    }

    public function transaksi(Request $request)
    {
        $query = Transaksi::with('produk');

        // Filter by date
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $transaksis = $query->latest()->get();
        $totalPendapatan = $transaksis->where('status', 'selesai')->sum('total_harga');
        $totalTerjual = $transaksis->where('status', 'selesai')->sum('jumlah');

        return view('laporan.transaksi', compact('transaksis', 'totalPendapatan', 'totalTerjual'));
    }
}
