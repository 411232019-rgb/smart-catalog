@extends('layouts.app')
@section('title', 'Kategori - Smart-Catalog')
@section('page_title', 'Kelola Kategori')

@section('content')
<div class="sc-card">
    <div class="sc-card-header">
        <h6><i class="fas fa-tags me-2" style="color:#7c3aed;"></i> Daftar Kategori</h6>
        <a href="{{ route('kategori.create') }}" class="btn btn-gradient btn-sm px-4">
            <i class="fas fa-plus me-1"></i> Tambah
        </a>
    </div>
    <div style="padding: 20px 22px 0;">
        <form action="{{ route('kategori.index') }}" method="GET">
            <div class="input-group mb-3" style="max-width:380px;">
                <input type="text" name="search" class="form-control" placeholder="Cari kategori..." value="{{ $search ?? '' }}">
                <button class="btn btn-gradient px-3" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table sc-table mb-0">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="30%">Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $k)
                <tr>
                    <td>{{ $loop->iteration + $kategoris->firstItem() - 1 }}</td>
                    <td><span class="fw-600" style="font-weight:600;">{{ $k->nama_kategori }}</span></td>
                    <td class="text-muted">{{ $k->deskripsi ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-sm" style="background:#ede9fe;color:#7c3aed;border-radius:8px;" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#ef4444;border-radius:8px;" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-4 text-muted">Tidak ada data kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3 d-flex justify-content-end">
        {{ $kategoris->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
