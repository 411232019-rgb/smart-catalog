@extends('layouts.app')
@section('title', 'Detail Produk - Smart-Catalog')
@section('page_title', 'Detail Produk')

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="sc-card text-center" style="padding:28px;">
            @if($produk->foto_produk)
                <img src="{{ asset('storage/'.$produk->foto_produk) }}" alt="{{ $produk->nama_produk }}" class="img-fluid rounded-3 shadow-sm" style="max-height:260px;object-fit:cover;width:100%;">
            @else
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="height:220px;background:#f3f4f6;color:#d1d5db;">
                    <i class="fas fa-image" style="font-size:4rem;"></i>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-8">
        <div class="sc-card" style="padding:28px;">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <span class="badge rounded-pill mb-2" style="background:#ede9fe;color:#7c3aed;font-weight:600;font-size:0.8rem;padding:6px 14px;">{{ $produk->kategori->nama_kategori ?? '-' }}</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $produk->nama_produk }}</h3>
                </div>
                <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="mb-4">
                <span style="font-size:2rem;font-weight:800;background:linear-gradient(90deg,#f7374f,#88304e);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </span>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-sm-4">
                    <div style="background:#f9fafb;border-radius:12px;padding:16px;text-align:center;">
                        <div style="font-size:0.75rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Stok</div>
                        <div style="font-size:1.5rem;font-weight:800;color:#1a1a2e;">{{ $produk->stok }}</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div style="background:#f9fafb;border-radius:12px;padding:16px;text-align:center;">
                        <div style="font-size:0.75rem;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Ditambahkan</div>
                        <div style="font-size:0.9rem;font-weight:700;color:#1a1a2e;">{{ $produk->created_at->format('d M Y') }}</div>
                    </div>
                </div>
            </div>

            @if($produk->deskripsi)
            <div class="mb-5">
                <p style="font-size:0.75rem;color:#9ca3af;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px;">Deskripsi</p>
                <p style="color:#374151;line-height:1.7;font-size:0.9rem;">{{ $produk->deskripsi }}</p>
            </div>
            @endif

            <div class="d-flex gap-2 pt-3" style="border-top:1px solid #f0f2f5;">
                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-gradient px-4">
                    <i class="fas fa-edit me-1"></i> Edit Produk
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
