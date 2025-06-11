@extends('warga.layout.master')
@section('title', 'Warga - Profile')
@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }

    .info-item p {
        margin-bottom: 0;
        font-weight: 500;
        color: #212529;
    }

    .info-item small {
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4 px-4">

    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                {{-- Icon header --}}
                <i class="fas fa-user fa-2x me-3 text-primary"></i> 
                <div>
                    <h1 class="h4 mb-0">Profile Saya</h1>
                    <p class="text-muted mb-0 small">Kelola Informasi Pribadi Anda</p>
                </div>
            </div>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-pencil-alt me-1"></i>
                Edit Profile
            </a>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4 d-flex flex-column justify-content-center">
                    <div class="mb-3">
                        {{-- Ikon profil default menggunakan Font Awesome --}}
                        <i class="fas fa-user-circle fa-6x text-secondary"></i>
                    </div>
                    <h5 class="card-title mb-0">{{ $user->nama }}</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4">Informasi Pribadi</h5>

                    <div class="info-item mb-3">
                        <small>Nama Lengkap</small>
                        <p>{{ $user->nama }}</p>
                    </div>
                    <hr>
                    <div class="info-item mb-3">
                        <small>No. KK</small>
                        <p>{{ $warga?->no_kk ?? 'Data No. KK tidak ditemukan' }}</p>
                    </div>
                    <hr>
                    <div class="info-item mb-3">
                        <small>NIK</small>
                        <p>{{ $warga?->nik ?? 'Data NIK tidak ditemukan' }}</p>
                    </div>
                    <hr>
                    <div class="info-item mb-3">
                        <small>Email</small>
                        <p>{{ $user ->email }}</p>
                    </div>
                    <hr>
                    <div class="info-item">
                        <small>No. HP</small>
                        <p>{{ $warga?->no_hp ?? 'Data No. HP tidak ditemukan' }}</p>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>
@endsection