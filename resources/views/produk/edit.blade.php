@extends('layouts.app')
@section('title', 'Edit Produk - Smart-Catalog')
@section('page_title', 'Edit Produk')

@section('content')
<div class="row">
    <div class="col-md-9 mx-auto">
        <div class="sc-card">
            <div class="sc-card-header">
                <h6><i class="fas fa-edit me-2" style="color:#f7374f;"></i> Form Edit Produk</h6>
            </div>
            <div style="padding:24px;">
                <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                            @error('nama_produk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id', $produk->kategori_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#f9fafb;border-radius:10px 0 0 10px;font-size:0.85rem;font-weight:600;color:#6b7280;">Rp</span>
                                <input type="number" name="harga" class="form-control" value="{{ old('harga', (int)$produk->harga) }}" style="border-radius:0 10px 10px 0;" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stok" class="form-control" value="{{ old('stok', $produk->stok) }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Foto Produk <span class="text-muted fw-normal">(kosongkan jika tidak diubah)</span></label>
                            <input type="file" id="foto_produk" name="foto_produk" class="form-control @error('foto_produk') is-invalid @enderror" accept="image/*">
                            @error('foto_produk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="mt-3">
                                <img id="preview-image"
                                     src="{{ $produk->foto_produk ? asset('storage/'.$produk->foto_produk) : '#' }}"
                                     alt="Preview"
                                     class="rounded {{ $produk->foto_produk ? '' : 'd-none' }}"
                                     style="max-height:180px;border:2px solid #f0f2f5;">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-5 pt-4" style="border-top:1px solid #f0f2f5;">
                        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-gradient px-4"><i class="fas fa-save me-1"></i> Update Produk</button>
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
