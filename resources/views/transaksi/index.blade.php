@extends('layouts.app')
@section('title', 'Transaksi - Smart-Catalog')
@section('page_title', 'Data Transaksi')

@section('content')

{{-- Stat Cards --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total Transaksi</div>
                <div class="stat-value">{{ $totalTransaksi }}</div>
            </div>
            <div class="stat-icon" style="background:#fee2e2;color:#ef4444;">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div>
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $totalPending }}</div>
            </div>
            <div class="stat-icon" style="background:#fef3c7;color:#d97706;">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div>
                <div class="stat-label">Selesai</div>
                <div class="stat-value">{{ $totalSelesai }}</div>
            </div>
            <div class="stat-icon" style="background:#d1fae5;color:#059669;">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
</div>

<div class="sc-card">
    <div class="sc-card-header">
        <h6><i class="fas fa-list me-2" style="color:#ef4444;"></i> Daftar Transaksi</h6>
        <a href="{{ route('transaksi.create') }}" class="btn btn-gradient btn-sm px-4">
            <i class="fas fa-plus me-1"></i> Buat Transaksi
        </a>
    </div>
    <div style="padding:20px 22px 0;">
        <form action="{{ route('transaksi.index') }}" method="GET" class="mb-3">
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari kode atau produk..." value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending"   {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses"  {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai"   {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
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
                    <th>Kode TRX</th>
                    <th>Produk</th>
                    <th class="text-center">Jumlah</th>
                    <th>Total</th>
                    <th class="text-center">Status</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $trx)
                <tr>
                    <td style="font-weight:700;color:#f7374f;font-size:0.8rem;">{{ $trx->kode_transaksi }}</td>
                    <td style="font-weight:500;">{{ $trx->produk->nama_produk ?? 'Dihapus' }}</td>
                    <td class="text-center">{{ $trx->jumlah }}</td>
                    <td style="color:#059669;font-weight:600;">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if($trx->status == 'pending')
                            <span class="badge badge-pending rounded-pill px-3 py-1">Pending</span>
                        @elseif($trx->status == 'diproses')
                            <span class="badge badge-diproses rounded-pill px-3 py-1">Diproses</span>
                        @else
                            <span class="badge badge-selesai rounded-pill px-3 py-1">Selesai</span>
                        @endif
                    </td>
                    <td class="text-muted" style="font-size:0.8rem;">{{ $trx->created_at->format('d M Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('transaksi.show', $trx->id) }}" class="btn btn-sm me-1" style="background:#f3f4f6;color:#6b7280;border-radius:8px;" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('transaksi.edit', $trx->id) }}" class="btn btn-sm" style="background:#ede9fe;color:#7c3aed;border-radius:8px;" title="Update Status">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3 d-flex justify-content-end">
        {{ $transaksis->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
