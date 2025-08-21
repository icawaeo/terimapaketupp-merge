@extends('layouts.app')

@section('title', 'Admin - Tambah Pengguna Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        {{-- HEADER HALAMAN --}}
        <div class="mb-3">
            <h2 class="mb-1 fs-4" style="font-weight: 600;">Tambah Pengguna Baru</h2>
            <p class="text-muted mb-0">
                Buat akun baru untuk resepsionis atau super admin.
            </p>
        </div>

        {{-- KARTU FORMULIR DENGAN KELAS KUSTOM --}}
        <div class="card card-form">
            <div class="card-header card-form-header">
                <i class="bi bi-person-plus-fill me-2"></i>Detail Akun Pengguna
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Peran (Role)</label>
                        <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="resepsionis" selected>Resepsionis</option>
                            <option value="superadmin">Super Admin</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end pt-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-pln-primary">
                            <i class="bi bi-save me-2"></i>Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection