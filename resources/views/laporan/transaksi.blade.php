@extends('layouts.app')
@section('title', 'Laporan Transaksi - Smart-Catalog')
@section('page_title', 'Laporan Transaksi')

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
                <div class="stat-label">Total Pendapatan (Selesai)</div>
                <div class="stat-value" style="font-size:1.4rem;color:#059669;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
            <div class="stat-icon" style="background:#d1fae5;color:#059669;"><i class="fas fa-chart-line"></i></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total Produk Terjual (Selesai)</div>
                <div class="stat-value">{{ $totalTerjual }} <span style="font-size:1rem;color:#9ca3af;font-weight:400;">Unit</span></div>
            </div>
            <div class="stat-icon" style="background:#dbeafe;color:#2563eb;"><i class="fas fa-box-open"></i></div>
        </div>
    </div>
</div>

<div class="sc-card">
    <div class="sc-card-header">
        <h6><i class="fas fa-file-invoice-dollar me-2" style="color:#f7374f;"></i> Laporan Data Transaksi</h6>
        <button onclick="window.print()" class="btn btn-gradient btn-sm px-3 no-print"><i class="fas fa-print me-1"></i> Cetak</button>
    </div>

    <div style="padding:20px 22px 0;" class="no-print">
        <form action="{{ route('laporan.transaksi') }}" method="GET" class="mb-3">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label" style="font-size:0.78rem;font-weight:600;color:#6b7280;">Dari Tanggal</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label" style="font-size:0.78rem;font-weight:600;color:#6b7280;">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label" style="font-size:0.78rem;font-weight:600;color:#6b7280;">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending"  {{ request('status') == 'pending'  ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai"  {{ request('status') == 'selesai'  ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-gradient w-100" type="submit"><i class="fas fa-filter me-1"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table sc-table mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode TRX</th>
                    <th>Tanggal</th>
                    <th>Nama Produk</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Status</th>
                    <th class="text-end">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $trx)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="font-weight:700;color:#f7374f;font-size:0.8rem;">{{ $trx->kode_transaksi }}</td>
                    <td style="color:#6b7280;font-size:0.85rem;">{{ $trx->created_at->format('d M Y') }}</td>
                    <td style="font-weight:600;">{{ $trx->produk->nama_produk ?? 'Dihapus' }}</td>
                    <td class="text-center">{{ $trx->jumlah }}</td>
                    <td class="text-center">
                        @if($trx->status == 'pending')
                            <span class="badge badge-pending rounded-pill px-3">Pending</span>
                        @elseif($trx->status == 'diproses')
                            <span class="badge badge-diproses rounded-pill px-3">Diproses</span>
                        @else
                            <span class="badge badge-selesai rounded-pill px-3">Selesai</span>
                        @endif
                    </td>
                    <td class="text-end" style="font-weight:700;{{ $trx->status == 'selesai' ? 'color:#059669;' : 'color:#9ca3af;' }}">
                        Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">Tidak ada data transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
