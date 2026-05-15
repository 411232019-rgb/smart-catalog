@extends('layouts.app')
@section('title', 'Buat Transaksi - Smart-Catalog')
@section('page_title', 'Buat Transaksi')

@section('content')
<div class="row">
    <div class="col-md-7 mx-auto">
        <div class="sc-card">
            <div class="sc-card-header">
                <h6><i class="fas fa-cart-plus me-2" style="color:#f7374f;"></i> Form Transaksi Baru</h6>
            </div>
            <div style="padding:24px;">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Pilih Produk <span class="text-danger">*</span></label>
                        <select name="produk_id" id="produk_id" class="form-select @error('produk_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Produk Tersedia --</option>
                            @foreach($produks as $p)
                                <option value="{{ $p->id }}" data-harga="{{ $p->harga }}" data-stok="{{ $p->stok }}" {{ old('produk_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_produk }} (Stok: {{ $p->stok }} | Rp {{ number_format($p->harga, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        @error('produk_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Jumlah <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah', 1) }}" min="1" required>
                            <small id="stok-info" class="text-muted d-block mt-1"></small>
                            @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Total Harga</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#d1fae5;color:#059669;font-weight:700;border-color:#a7f3d0;border-radius:10px 0 0 10px;">Rp</span>
                                <input type="text" id="total_harga_display" class="form-control fw-bold" value="0" style="border-color:#a7f3d0;color:#059669;border-radius:0 10px 10px 0;" readonly>
                            </div>
                            <small class="text-muted mt-1 d-block">Dihitung otomatis</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5 pt-4" style="border-top:1px solid #f0f2f5;">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-gradient px-4"><i class="fas fa-check-circle me-1"></i> Proses Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const produkSelect = document.getElementById('produk_id');
    const jumlahInput  = document.getElementById('jumlah');
    const totalDisplay = document.getElementById('total_harga_display');
    const stokInfo     = document.getElementById('stok-info');

    function calc() {
        const opt = produkSelect.options[produkSelect.selectedIndex];
        if (!opt.value) { totalDisplay.value = '0'; stokInfo.innerHTML = ''; return; }
        const harga = parseFloat(opt.getAttribute('data-harga'));
        const stok  = parseInt(opt.getAttribute('data-stok'));
        let jumlah  = parseInt(jumlahInput.value) || 0;
        stokInfo.innerHTML = `Stok tersedia: <strong>${stok}</strong> unit`;
        if (jumlah > stok) { jumlahInput.value = stok; jumlah = stok; }
        totalDisplay.value = new Intl.NumberFormat('id-ID').format(harga * jumlah);
    }
    produkSelect.addEventListener('change', calc);
    jumlahInput.addEventListener('input', calc);
    if (produkSelect.value) calc();
});
</script>
@endpush
