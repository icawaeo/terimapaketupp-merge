@extends('layouts.app')

@section('title', 'Admin - Tambah Paket Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="mb-3">
            <h2 class="mb-1 fs-4" style="font-weight: 600;">Formulir Input Paket Baru</h2>
            <p class="text-muted mb-0">
                Silakan isi detail paket yang baru tiba di bawah ini.
            </p>
        </div>

        <div class="card card-form">
            <div class="card-header card-form-header">
                Detail Informasi Paket
            </div>
            <div class="card-body">
                <form action="{{ route('admin.paket.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Input Nama Penerima --}}
                    <div class="mb-3">
                        <label for="nama_penerima" class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control @error('nama_penerima') is-invalid @enderror" id="nama_penerima" name="nama_penerima" value="{{ old('nama_penerima') }}" required autofocus>
                        @error('nama_penerima')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Input Nama Pengirim --}}
                    <div class="mb-3">
                        <label for="nama_pengirim" class="form-label">Nama Pengirim</label>
                        <input type="text" class="form-control @error('nama_pengirim') is-invalid @enderror" id="nama_pengirim" name="nama_pengirim" value="{{ old('nama_pengirim') }}" required>
                        @error('nama_pengirim')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Input Kontak Pengirim --}}
                    <div class="mb-3">
                        <label for="kontak_pengirim" class="form-label">Kontak Pengirim (No. HP)</label>
                        <input type="text" class="form-control" id="kontak_pengirim" name="kontak_pengirim" value="{{ old('kontak_pengirim') }}">
                    </div>

                    {{-- Input Alamat Pengirim --}}
                    <div class="mb-3">
                        <label for="alamat_pengirim" class="form-label">Alamat Pengirim</label>
                        <textarea class="form-control" id="alamat_pengirim" name="alamat_pengirim" rows="3">{{ old('alamat_pengirim') }}</textarea>
                    </div>

                    {{-- Input Ekspedisi --}}
                    <div class="mb-3">
                        <label for="ekspedisi" class="form-label">Jasa Ekspedisi</label>
                        <input type="text" class="form-control" id="ekspedisi" name="ekspedisi" value="{{ old('ekspedisi') }}">
                    </div>

                    {{-- Input File Gambar --}}
                    <div class="mb-3">
                        <label for="foto_paket" class="form-label">Foto Paket (Opsional)</label>
                        <input class="form-control @error('foto_paket') is-invalid @enderror" type="file" id="foto_paket" name="foto_paket" accept="image/*" capture="environment">
                        @error('foto_paket')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-end pt-3">
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Paket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection