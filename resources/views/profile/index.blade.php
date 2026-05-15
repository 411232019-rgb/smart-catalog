@extends('layouts.app')
@section('title', 'Profile - Smart-Catalog')
@section('page_title', 'Profile Merchant')

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="sc-card text-center" style="padding:32px 24px;">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width:90px;height:90px;background:linear-gradient(135deg,#f7374f,#88304e);font-size:2.2rem;font-weight:800;color:white;">
                {{ substr($user->name, 0, 1) }}
            </div>
            <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
            <p class="text-muted mb-3" style="font-size:0.875rem;">{{ $user->email }}</p>
            <span class="badge rounded-pill px-3 py-2" style="background:#d1fae5;color:#059669;font-weight:600;font-size:0.8rem;">
                <i class="fas fa-check-circle me-1"></i> Merchant Aktif
            </span>
        </div>
    </div>
    <div class="col-md-8">
        <div class="sc-card">
            <div class="sc-card-header">
                <h6><i class="fas fa-user-edit me-2" style="color:#f7374f;"></i> Edit Profile</h6>
            </div>
            <div style="padding:24px;">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Nama Merchant <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <hr class="my-4" style="border-color:#f0f2f5;">
                    <p class="fw-bold mb-3" style="color:#374151;font-size:0.875rem;">Ubah Password <span class="text-muted fw-normal">(opsional)</span></p>
                    <div class="mb-4">
                        <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Password Baru</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Min. 8 karakter">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-5">
                        <label class="form-label" style="font-weight:600;color:#374151;font-size:0.875rem;">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-gradient px-5"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
