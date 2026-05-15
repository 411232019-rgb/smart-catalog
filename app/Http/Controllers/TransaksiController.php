<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        $query = Transaksi::with('produk')->latest();

        if ($search) {
            $query->where('kode_transaksi', 'like', "%{$search}%")
                  ->orWhereHas('produk', function ($q) use ($search) {
                      $q->where('nama_produk', 'like', "%{$search}%");
                  });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $transaksis = $query->paginate(10);

        // Statistik
        $totalTransaksi = Transaksi::count();
        $totalPending = Transaksi::where('status', 'pending')->count();
        $totalSelesai = Transaksi::where('status', 'selesai')->count();

        return view('transaksi.index', compact('transaksis', 'search', 'status', 'totalTransaksi', 'totalPending', 'totalSelesai'));
    }

    public function create()
    {
        $produks = Produk::where('stok', '>', 0)->get();
        return view('transaksi.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        if ($request->jumlah > $produk->stok) {
            return back()->withErrors(['jumlah' => 'Jumlah melebihi stok yang tersedia.'])->withInput();
        }

        $totalHarga = $produk->harga * $request->jumlah;

        // Generate kode transaksi: TRX-YYYYMMDD-RANDOM
        $kodeTransaksi = 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        Transaksi::create([
            'kode_transaksi' => $kodeTransaksi,
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ]);

        // Opsional: kurangi stok saat transaksi dibuat
        // $produk->decrement('stok', $request->jumlah);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('produk.kategori')->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with('produk')->findOrFail($id);
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'status' => $request->status,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Status transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
