@extends('layouts.app')
@section('title', 'Laporan Produk - Smart-Catalog')
@section('page_title', 'Laporan Produk')

@push('css')
<style>
@media print {
    body { background: #fff !important; }
    .sc-sidebar, .sc-topbar, .sc-footer, .no-print { display: none !important; }
    .sc-wrapper { margin-left: 0 !important; }
    .sc-content { padding: 0 !important; }
}
</style>
@endpush

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total Stok Keseluruhan</div>
                <div class="stat-value">{{ $totalStok }} <span style="font-size:1rem;color:#9ca3af;font-weight:400;">Unit</span></div>
            </div>
            <div class="stat-icon" style="background:#ede9fe;color:#7c3aed;"><i class="fas fa-boxes"></i></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total Nilai Aset Produk</div>
                <div class="stat-value" style="font-size:1.4rem;">Rp {{ number_format($totalAsset, 0, ',', '.') }}</div>
            </div>
            <div class="stat-icon" style="background:#d1fae5;color:#059669;"><i class="fas fa-money-bill-wave"></i></div>
        </div>
    </div>
</div>

<div class="sc-card">
    <div class="sc-card-header">
        <h6><i class="fas fa-file-alt me-2" style="color:#7c3aed;"></i> Laporan Stok Produk</h6>
        <button onclick="window.print()" class="btn btn-gradient btn-sm px-3 no-print"><i class="fas fa-print me-1"></i> Cetak</button>
    </div>
    <div style="padding:20px 22px 0;" class="no-print">
        <form action="{{ route('laporan.produk') }}" method="GET" class="mb-3">
            <div class="row g-2">
                <div class="col-md-4">
                    <select name="stok_filter" class="form-select">
                        <option value="">Semua Stok</option>
                        <option value="tersedia" {{ request('stok_filter') == 'tersedia' ? 'selected' : '' }}>Stok Tersedia (&gt; 0)</option>
                        <option value="habis"    {{ request('stok_filter') == 'habis'    ? 'selected' : '' }}>Stok Habis (= 0)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-gradient w-100" type="submit">Filter</button>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table sc-table mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama Produk</th>
                    <th class="text-end">Harga Satuan</th>
                    <th class="text-center">Sisa Stok</th>
                    <th class="text-end">Nilai Aset</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produks as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="badge rounded-pill" style="background:#ede9fe;color:#7c3aed;font-weight:600;">{{ $p->kategori->nama_kategori ?? '-' }}</span></td>
                    <td style="font-weight:600;">{{ $p->nama_produk }}</td>
                    <td class="text-end">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if($p->stok > 0)
                            <span class="badge rounded-pill" style="background:#d1fae5;color:#059669;font-weight:700;">{{ $p->stok }}</span>
                        @else
                            <span class="badge rounded-pill" style="background:#fee2e2;color:#ef4444;font-weight:700;">Habis</span>
                        @endif
                    </td>
                    <td class="text-end" style="color:#059669;font-weight:700;">Rp {{ number_format($p->stok * $p->harga, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada data produk.</td></tr>
                @endforelse
            </tbody>
            @if(count($produks) > 0)
            <tfoot style="background:#fafbfc;">
                <tr>
                    <td colspan="4" class="text-end fw-bold" style="padding:14px 16px;">TOTAL</td>
                    <td class="text-center fw-bold" style="padding:14px 16px;">{{ $totalStok }}</td>
                    <td class="text-end fw-bold" style="padding:14px 16px;color:#059669;">Rp {{ number_format($totalAsset, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection
