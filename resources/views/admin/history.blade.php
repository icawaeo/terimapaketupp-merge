@extends('layouts.app')

@section('title', 'Admin - Riwayat Paket')

@section('content')
    <h2 class="mb-2 fs-4" style="font-weight: 600;">Riwayat Paket</h2>
    <p class="text-muted mb-4">Lihat riwayat paket yang sudah diambil di UPP SULUT di sini!</p>

    <div class="card card-riwayat mb-4">
        <div class="card-header card-header-riwayat">
            <i class="bi bi-funnel-fill me-2"></i>Filter Riwayat
        </div>
    
        <div class="card-body">
            <form action="{{ route('admin.history.index') }}" method="GET" class="row g-3 align-items-end form-filter-mobile">
                <div class="col-md-5">
                    <label for="search" class="form-label">Cari Kata Kunci</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Nama, pengirim, kontak..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label for="start_date" class="form-label">Dari Tanggal</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="form-label">Sampai Tanggal</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-pln-primary w-100"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle table-pln">
                <thead>
                    <tr>
                        <th class="text-center">Waktu Diambil</th>
                        <th>Nama Penerima</th>
                        <th>Diambil Oleh</th>
                        <th>Dari Pengirim</th>
                        <th>Kontak Pengirim</th>
                        <th>Foto</th>
                        <th>Ekspedisi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($historyPaket as $paket)
                        <tr>
                            <td class="text-center">{{ \Carbon\Carbon::parse($paket->waktu_diambil)->format('d M Y, H:i') }}</td>
                            <td>{{ $paket->nama_penerima }}</td>
                            <td>{{ $paket->nama_pengambil }}</td>
                            <td>{{ $paket->nama_pengirim }}</td>
                            <td>{{ $paket->kontak_pengirim ?? '-' }}</td>
                            <td>
                                @if ($paket->foto_paket)
                                    <img src="{{ asset('storage/' . $paket->foto_paket) }}" alt="Foto Paket" style="width: 60px; height: 60px; object-fit: cover; border-radius: 0.5rem; cursor: pointer;" class="image-popup-trigger" data-image-url="{{ asset('storage/' . $paket->foto_paket) }}">
                                @else
                                    -
                                @endif
                            </td>
                            <td><span class="badge bg-secondary">{{ $paket->ekspedisi }}</span></td>
                        </tr>
                    @empty
                         <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-info-circle fs-3 text-primary"></i>
                                <p class="mt-2 mb-0">Tidak ada data riwayat yang cocok dengan filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">
            {{ $historyPaket->links() }}
        </div>
    </div>
@endsection