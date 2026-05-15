@extends('layouts.app')
@section('title', 'Detail Transaksi - Smart-Catalog')
@section('page_title', 'Invoice Transaksi')

@push('css')
<style>
@media print {
    body { background: #fff !important; }
    .sc-sidebar, .sc-topbar, .sc-footer, .no-print { display: none !important; }
    .sc-wrapper { margin-left: 0 !important; }
    .sc-content { padding: 0 !important; }
    .sc-card { box-shadow: none !important; }
}
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-9 mx-auto">
        <div class="sc-card" style="padding:40px;">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-start mb-5 pb-4" style="border-bottom:2px solid #f0f2f5;">
                <div>
                    <div style="font-size:1.5rem;font-weight:800;background:linear-gradient(90deg,#f7374f,#88304e);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                        <i class="fas fa-store me-2" style="-webkit-text-fill-color:#f7374f;"></i>Smart-Catalog
                    </div>
                    <div style="font-size:0.8rem;color:#9ca3af;margin-top:4px;">Platform Katalog Produk UMKM</div>
                </div>
                <div class="text-end">
                    <div style="font-size:1.5rem;font-weight:800;color:#1a1a2e;letter-spacing:2px;">INVOICE</div>
                    <div style="font-size:0.85rem;color:#9ca3af;font-weight:600;">#{{ $transaksi->kode_transaksi }}</div>
                </div>
            </div>

            {{-- Meta --}}
            <div class="row mb-5">
                <div class="col-sm-6">
                    <p style="font-size:0.7rem;color:#9ca3af;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:8px;">Dari</p>
                    <p class="fw-bold text-dark mb-1">{{ Auth::user()->name ?? 'Merchant' }}</p>
                    <p style="color:#9ca3af;font-size:0.875rem;">{{ Auth::user()->email ?? '' }}</p>
                </div>
                <div class="col-sm-6 text-end">
                    <p style="font-size:0.7rem;color:#9ca3af;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:8px;">Detail</p>
                    <p class="mb-1" style="font-size:0.875rem;"><span style="color:#9ca3af;">Tanggal: </span><strong>{{ $transaksi->created_at->format('d M Y, H:i') }}</strong></p>
                    <p class="mb-0" style="font-size:0.875rem;"><span style="color:#9ca3af;">Status: </span>
                        @if($transaksi->status == 'pending')
                            <span class="badge badge-pending rounded-pill px-3">Pending</span>
                        @elseif($transaksi->status == 'diproses')
                            <span class="badge badge-diproses rounded-pill px-3">Diproses</span>
                        @else
                            <span class="badge badge-selesai rounded-pill px-3">Selesai</span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- Items Table --}}
            <div class="table-responsive mb-5">
                <table class="table" style="border:1.5px solid #f0f2f5;border-radius:12px;overflow:hidden;">
                    <thead style="background:#fafbfc;">
                        <tr>
                            <th style="padding:14px 18px;font-size:0.75rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:0.5px;">Produk</th>
                            <th class="text-end" style="padding:14px 18px;font-size:0.75rem;font-weight:700;color:#9ca3af;text-transform:uppercase;">Harga Satuan</th>
                            <th class="text-center" style="padding:14px 18px;font-size:0.75rem;font-weight:700;color:#9ca3af;text-transform:uppercase;">Qty</th>
                            <th class="text-end" style="padding:14px 18px;font-size:0.75rem;font-weight:700;color:#9ca3af;text-transform:uppercase;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding:18px;border-bottom:1.5px solid #f0f2f5;">
                                <div class="fw-bold text-dark">{{ $transaksi->produk->nama_produk ?? 'Produk Dihapus' }}</div>
                                <div style="font-size:0.8rem;color:#9ca3af;margin-top:2px;">{{ $transaksi->produk->kategori->nama_kategori ?? '-' }}</div>
                            </td>
                            <td class="text-end" style="padding:18px;border-bottom:1.5px solid #f0f2f5;vertical-align:middle;">Rp {{ number_format($transaksi->produk->harga ?? 0, 0, ',', '.') }}</td>
                            <td class="text-center" style="padding:18px;border-bottom:1.5px solid #f0f2f5;vertical-align:middle;font-weight:700;">{{ $transaksi->jumlah }}</td>
                            <td class="text-end" style="padding:18px;border-bottom:1.5px solid #f0f2f5;vertical-align:middle;font-weight:700;color:#059669;">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Total Box --}}
            <div class="d-flex justify-content-end mb-5">
                <div style="background:#fafbfc;border-radius:16px;padding:24px 32px;min-width:300px;">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color:#9ca3af;font-size:0.875rem;">Subtotal</span>
                        <span style="font-size:0.875rem;">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span style="color:#9ca3af;font-size:0.875rem;">Pajak (0%)</span>
                        <span style="font-size:0.875rem;">Rp 0</span>
                    </div>
                    <div style="border-top:2px solid #e5e7eb;padding-top:14px;" class="d-flex justify-content-between align-items-center">
                        <span style="font-weight:700;color:#1a1a2e;">TOTAL</span>
                        <span style="font-size:1.5rem;font-weight:800;color:#059669;">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex justify-content-between no-print pt-4" style="border-top:1.5px solid #f0f2f5;">
                <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary px-4"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                <button onclick="window.print()" class="btn btn-gradient px-4"><i class="fas fa-print me-1"></i> Cetak Invoice</button>
            </div>
        </div>
    </div>
</div>
@endsection
