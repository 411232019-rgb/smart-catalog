@extends('layouts.app')
@section('title', 'Produk - Smart-Catalog')
@section('page_title', 'Kelola Produk')

@section('content')
<div class="sc-card">
    <div class="sc-card-header">
        <h6><i class="fas fa-box-open me-2" style="color:#059669;"></i> Daftar Produk</h6>
        <a href="{{ route('produk.create') }}" class="btn btn-gradient btn-sm px-4">
            <i class="fas fa-plus me-1"></i> Tambah
        </a>
    </div>
    <div style="padding: 20px 22px 0;">
        <form action="{{ route('produk.index') }}" method="GET">
            <div class="input-group mb-3" style="max-width:380px;">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ $search ?? '' }}">
                <button class="btn btn-gradient px-3" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table sc-table mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produks as $produk)
                <tr>
                    <td>{{ $loop->iteration + $produks->firstItem() - 1 }}</td>
                    <td>
                        @if($produk->foto_produk)
                            <img src="{{ asset('storage/' . $produk->foto_produk) }}" class="rounded" style="width:44px;height:44px;object-fit:cover;" alt="">
                        @else
                            <div class="rounded d-flex align-items-center justify-content-center" style="width:44px;height:44px;background:#f3f4f6;color:#9ca3af;">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $produk->nama_produk }}</td>
                    <td><span class="badge rounded-pill" style="background:#ede9fe;color:#7c3aed;font-weight:600;padding:6px 12px;">{{ $produk->kategori->nama_kategori ?? '-' }}</span></td>
                    <td style="color:#059669;font-weight:600;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $produk->stok }}</td>
                    <td class="text-center">
                        <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-sm me-1" style="background:#f3f4f6;color:#6b7280;border-radius:8px;" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm me-1" style="background:#ede9fe;color:#7c3aed;border-radius:8px;" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm" style="background:#fee2e2;color:#ef4444;border-radius:8px;" title="Hapus"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">Tidak ada data produk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3 d-flex justify-content-end">
        {{ $produks->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
