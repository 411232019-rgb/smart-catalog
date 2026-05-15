@extends('layouts.app')
@section('title', 'Tambah Produk - Smart-Catalog')
@section('page_title', 'Tambah Produk')

@section('content')
<div class="row">
    <div class="col-md-9 mx-auto">
        <div class="sc-card">
            <div class="sc-card-header">
                <h6><i class="fas fa-plus-circle me-2" style="color:#f7374f;"></i> Form Produk Baru</h6>
            </div>
            <div style="padding:24px;">
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk') }}" placeholder="Nama produk" required>
                            @error('nama_produk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#f9fafb;border-radius:10px 0 0 10px;font-size:0.85rem;font-weight:600;color:#6b7280;">Rp</span>
                                <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" placeholder="0" style="border-radius:0 10px 10px 0;" required>
                            </div>
                            @error('harga')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', 0) }}" placeholder="0" required>
                            @error('stok')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Foto Produk <span class="text-muted fw-normal">(jpg/jpeg/png, maks 2MB)</span></label>
                            <input type="file" id="foto_produk" name="foto_produk" class="form-control @error('foto_produk') is-invalid @enderror" accept="image/*">
                            @error('foto_produk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="mt-3">
                                <img id="preview-image" src="#" alt="Preview" class="rounded d-none" style="max-height:180px;border:2px solid #f0f2f5;">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsi produk...">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-5 pt-4" style="border-top:1px solid #f0f2f5;">
                        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-gradient px-4"><i class="fas fa-save me-1"></i> Simpan Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('foto_produk').addEventListener('change', function(e) {
    const reader = new FileReader();
    reader.onload = ev => {
        const img = document.getElementById('preview-image');
        img.src = ev.target.result;
        img.classList.remove('d-none');
    };
    if (e.target.files[0]) reader.readAsDataURL(e.target.files[0]);
});
</script>
@endpush
