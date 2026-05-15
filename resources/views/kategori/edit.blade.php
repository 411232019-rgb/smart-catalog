@extends('layouts.app')
@section('title', 'Edit Kategori - Smart-Catalog')
@section('page_title', 'Edit Kategori')

@section('content')
<div class="row">
    <div class="col-md-7 mx-auto">
        <div class="sc-card">
            <div class="sc-card-header">
                <h6><i class="fas fa-edit me-2" style="color:#f7374f;"></i> Form Edit Kategori</h6>
            </div>
            <div style="padding:24px;">
                <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="form-label fw-600" style="font-weight:600;color:#374151;font-size:0.875rem;">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                        @error('nama_kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-5">
                        <label class="form-label fw-600" style="font-weight:600;color:#374151;font-size:0.875rem;">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-gradient px-4"><i class="fas fa-save me-1"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
