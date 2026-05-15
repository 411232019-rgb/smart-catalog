@extends('layouts.app')
@section('title', 'Update Transaksi - Smart-Catalog')
@section('page_title', 'Update Status Transaksi')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="sc-card">
            <div class="sc-card-header">
                <h6><i class="fas fa-edit me-2" style="color:#f7374f;"></i> Update Status Transaksi</h6>
            </div>
            <div style="padding:24px;">

                {{-- Info Box --}}
                <div class="mb-4 p-4 rounded-3" style="background:#fafbfc;border:1.5px solid #f0f2f5;">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="font-size:0.8rem;color:#9ca3af;font-weight:600;">Kode Transaksi</span>
                        <span style="font-weight:700;color:#f7374f;font-size:0.875rem;">{{ $transaksi->kode_transaksi }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span style="font-size:0.8rem;color:#9ca3af;font-weight:600;">Produk</span>
                        <span style="font-weight:600;color:#374151;font-size:0.875rem;">{{ $transaksi->produk->nama_produk ?? 'Dihapus' }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span style="font-size:0.8rem;color:#9ca3af;font-weight:600;">Total Harga</span>
                        <span style="font-weight:700;color:#059669;font-size:0.875rem;">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-5">
                        <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Status Transaksi <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="pending"  {{ old('status', $transaksi->status) == 'pending'  ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="diproses" {{ old('status', $transaksi->status) == 'diproses' ? 'selected' : '' }}>🔄 Diproses</option>
                            <option value="selesai"  {{ old('status', $transaksi->status) == 'selesai'  ? 'selected' : '' }}>✅ Selesai</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="d-flex justify-content-between pt-4" style="border-top:1px solid #f0f2f5;">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-gradient px-4"><i class="fas fa-save me-1"></i> Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
