@extends('layouts.app')

@section('title', 'Dashboard - Smart-Catalog')
@section('page_title', 'Dashboard')

@section('content')

{{-- Welcome Banner --}}
<div class="welcome-banner">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <p class="mb-1 opacity-75" style="font-size:0.85rem; letter-spacing:0.5px;">SELAMAT DATANG KEMBALI</p>
            <h3 class="fw-bold mb-1">{{ Auth::user()->name ?? 'Merchant' }} 👋</h3>
            <p class="mb-0 opacity-75" style="font-size:0.875rem;">Kelola katalog produk UMKM Anda hari ini dengan mudah dan cepat.</p>
        </div>
        <div class="d-none d-lg-block" style="opacity:0.2; font-size:5rem;">
            <i class="fas fa-store"></i>
        </div>
    </div>
</div>

{{-- STAT CARDS --}}
<div class="row g-4 mb-4">

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total Kategori</div>
                <div class="stat-value">{{ $totalKategori }}</div>
            </div>
            <div class="stat-icon" style="background: #ede9fe; color: #7c3aed;">
                <i class="fas fa-tags"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total Produk</div>
                <div class="stat-value">{{ $totalProduk }}</div>
            </div>
            <div class="stat-icon" style="background: #d1fae5; color: #059669;">
                <i class="fas fa-box-open"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total Transaksi</div>
                <div class="stat-value">{{ $totalTransaksi }}</div>
            </div>
            <div class="stat-icon" style="background: #fee2e2; color: #ef4444;">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total Merchant</div>
                <div class="stat-value">{{ $totalMerchant }}</div>
            </div>
            <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

</div>

{{-- RECENT TABLES --}}
<div class="row g-4">

    {{-- Recent Products --}}
    <div class="col-lg-6">
        <div class="sc-card h-100">
            <div class="sc-card-header">
                <h6><i class="fas fa-box-open me-2" style="color:#7c3aed;"></i> Produk Terbaru</h6>
                <a href="{{ route('produk.index') }}" class="btn btn-sm btn-gradient px-3">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table sc-table mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th class="text-center">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentProducts as $produk)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($produk->foto_produk)
                                        <img src="{{ asset('storage/' . $produk->foto_produk) }}" class="rounded" style="width:36px;height:36px;object-fit:cover;" alt="">
                                    @else
                                        <div class="rounded d-flex align-items-center justify-content-center" style="width:36px;height:36px;background:#f3f4f6;color:#9ca3af;">
                                            <i class="fas fa-image" style="font-size:0.75rem;"></i>
                                        </div>
                                    @endif
                                    <span class="fw-600 text-dark" style="font-weight:600;">{{ $produk->nama_produk }}</span>
                                </div>
                            </td>
                            <td style="color:#059669; font-weight:600;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td class="text-center"><span class="badge rounded-pill" style="background:#ede9fe;color:#7c3aed;font-weight:600;">{{ $produk->stok }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center py-4 text-muted">Belum ada produk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="col-lg-6">
        <div class="sc-card h-100">
            <div class="sc-card-header">
                <h6><i class="fas fa-shopping-cart me-2" style="color:#ef4444;"></i> Transaksi Terbaru</h6>
                <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-gradient px-3">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table sc-table mb-0">
                    <thead>
                        <tr>
                            <th>Kode TRX</th>
                            <th>Produk</th>
                            <th class="text-center">Status</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $trx)
                        <tr>
                            <td style="font-size:0.78rem;font-weight:700;color:#f7374f;">{{ $trx->kode_transaksi }}</td>
                            <td class="fw-500">{{ $trx->produk->nama_produk ?? 'Dihapus' }}</td>
                            <td class="text-center">
                                @if($trx->status == 'pending')
                                    <span class="badge badge-pending rounded-pill px-3 py-1">Pending</span>
                                @elseif($trx->status == 'diproses')
                                    <span class="badge badge-diproses rounded-pill px-3 py-1">Diproses</span>
                                @else
                                    <span class="badge badge-selesai rounded-pill px-3 py-1">Selesai</span>
                                @endif
                            </td>
                            <td class="text-end" style="color:#059669;font-weight:600;">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection