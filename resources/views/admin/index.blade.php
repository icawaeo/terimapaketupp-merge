@extends('layouts.app')

@section('title', 'Admin - Dashboard')

@section('content')
    <div class="mb-4">
        <h1 class="fs-3" style="font-weight: 600;">Dashboard Admin</span></h1>
        <p class="text-muted mt-2">Lihat ringkasan aktivitas paket di UPP SULUT hari ini disini!</p>
    </div>

    {{-- KARTU STATISTIK --}}
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="stats-card text-white" style="background: linear-gradient(45deg, #0073b8, #005a92);">
                <div class="icon"><i class="bi bi-box-seam"></i></div>
                <h5>Paket Belum Diambil</h5>
                <div class="stats-number">{{ $jumlahBelumDiambil }}</div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="stats-card text-white" style="background: linear-gradient(45deg, #28a745, #218838);">
                <div class="icon"><i class="bi bi-calendar-check"></i></div>
                <h5>Paket Diambil Hari Ini</h5>
                <div class="stats-number">{{ $paketDiambilHariIni }}</div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="stats-card text-white" style="background: linear-gradient(45deg, #ffc107, #e0a800);">
                <div class="icon"><i class="bi bi-calendar-plus"></i></div>
                <h5>Paket Masuk Hari Ini</h5>
                <div class="stats-number">{{ $paketMasukHariIni }}</div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-start mb-3">
        <div class="mb-3 mb-md-0">
            <h2 class="mb-2 fs-4 table-title" style="font-weight: 600;">Daftar Paket di Meja Resepsionis</h2>
        </div>
        <div class="d-grid d-md-block">
            <a href="{{ route('admin.paket.create') }}" class="btn btn-pln-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Paket Baru
            </a>
        </div>
    </div>

    <div class="alert custom-info-alert d-flex align-items-center mb-3" role="alert">
        <i class="bi bi-info-circle-fill flex-shrink-0 me-2"></i>
        <div>
            Info: Tandai "Ambil" jika paket sudah diterima.
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle table-pln">
                <thead>
                    <tr>
                        <th class="text-center">Waktu Tiba</th>
                        <th>Nama Penerima</th>
                        <th>Dari Pengirim</th>
                        <th>Alamat Pengirim</th>
                        <th>Kontak Pengirim</th>
                        <th>Foto</th>
                        <th>Ekspedisi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($paketDiResepsionis as $paket)
                        <tr>
                            <td class="text-center">{{ \Carbon\Carbon::parse($paket->waktu_tiba)->format('d M Y, H:i') }}</td>
                            <td>{{ $paket->nama_penerima }}</td>
                            <td>{{ $paket->nama_pengirim }}</td>
                            <td class="address-cell">{{ $paket->alamat_pengirim ?? '-' }}</td>
                            <td>{{ $paket->kontak_pengirim ?? '-' }}</td>
                            <td>
                                @if ($paket->foto_paket)
                                    <img src="{{ asset('uploads/' . $paket->foto_paket) }}" alt="Foto Paket" style="width: 60px; height: 60px; object-fit: cover; border-radius: 0.5rem; cursor: pointer;" class="image-popup-trigger" data-image-url="{{ asset('uploads/' . $paket->foto_paket) }}">
                                @else
                                    -
                                @endif
                            </td>
                            <td><span class="badge bg-secondary">{{ $paket->ekspedisi }}</span></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalAmbil-{{ $paket->id }}">
                                    <i class="bi bi-check-lg"></i> Ambil
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5"> {{-- COLSPAN DIUBAH MENJADI 7 --}}
                                <i class="bi bi-info-circle fs-3 text-primary"></i>
                                <p class="mt-2 mb-0">Tidak ada paket di resepsionis saat ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($paketDiResepsionis->hasPages())
            <div class="card-footer bg-white">
                {{ $paketDiResepsionis->links() }}
            </div>
        @endif
    </div>

    @foreach ($paketDiResepsionis as $paket)
        <div class="modal fade" id="modalAmbil-{{ $paket->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Konfirmasi Pengambilan</b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.paket.ambil', $paket) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <p>Paket untuk: <strong>{{ $paket->nama_penerima }}</strong></p>
                            <div class="mb-3">
                                <label class="form-label">Nama Penerima</label>
                                <input type="text" name="nama_pengambil" class="form-control" value="{{ $paket->nama_penerima }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Ya, Tandai Sudah Diambil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection