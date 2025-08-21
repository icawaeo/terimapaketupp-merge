@extends('guest_dashboard')

@section('content')
    {{-- Bagian 1: Paket di Meja Resepsionis --}}
    <div class="mb-5">
        <div class="mb-4">
            <h2 class="display-8 fw-bold">Paket yang Tersedia</h2>
            <p class="text-muted">Lihat nama disini untuk memeriksa paket yang siap diambil.</p>
        </div>
        <div class="card">
            <div class="card-header">Daftar Paket yang Belum Diambil</div>
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle table-pln">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 15%;">Waktu Tiba</th>
                            <th style="width: 15%;">Nama Penerima</th>
                            <th style="width: 15%;">Dikirim Oleh</th>
                            <th style="width: 15%;">Alamat Pengirim</th>
                            <th class="text-center" style="width: 17%;">Ekspedisi</th>
                            <th class="text-center" style="width: 15%;">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($paketDiResepsionis as $paket)
                            <tr>
                                <td class="text-center">{{ \Carbon\Carbon::parse($paket->waktu_tiba)->format('d M Y, H:i') }}</td>
                                <td>{{ $paket->nama_penerima }}</td>
                                <td>{{ $paket->nama_pengirim }}</td>
                                <td class="address-cell">{{ $paket->alamat_pengirim ?? '-' }}</td>
                                <td class="text-center"><span class="badge bg-secondary">{{ $paket->ekspedisi }}</span></td>
                                <td class="text-center">
                                    @if ($paket->foto_paket)
                                        <img src="{{ asset('storage/' . $paket->foto_paket) }}" 
                                             alt="Foto Paket" 
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 0.5rem; cursor: pointer;"
                                             class="image-popup-trigger"
                                             data-image-url="{{ asset('storage/' . $paket->foto_paket) }}">
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4">Tidak ada paket di resepsionis saat ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($paketDiResepsionis->hasPages())
                <div class="card-footer bg-white">{{ $paketDiResepsionis->links() }}</div>
            @endif
        </div>
    </div>

    {{-- Bagian 2: Riwayat Pengambilan Paket --}}
    <div>
        <div class="mb-4">
            <h2 class="fs-4 fw-bold">Riwayat Pengambilan Paket</h2>
            <p class="text-muted small">Lihat riwayat paket yang telah diambil oleh penerima.</p>
        </div>
        <div class="card">
            <div class="card-header">Daftar Paket yang Sudah Diambil</div>
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle table-pln">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 18%;">Waktu Diambil</th>
                            <th style="width: 15%;">Nama Penerima</th>
                            <th style="width: 15%;">Dikirim Oleh</th>
                            <th style="width: 15%;">Alamat Pengirim</th>
                            <th style="width: 15%;">Telah Diterima Oleh</th>
                            <th class="text-center" style="width: 12%;">Ekspedisi</th>
                            <th class="text-center"style="width: 15%;">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayatPaket as $paket)
                        <tr>
                            <td class="text-center">{{ \Carbon\Carbon::parse($paket->waktu_diambil)->format('d M Y, H:i') }}</td>
                            <td>{{ $paket->nama_penerima }}</td>
                            <td>{{ $paket->nama_pengirim }}</td>
                            <td class="address-cell">{{ $paket->alamat_pengirim ?? '-' }}</td>
                            <td>{{ $paket->nama_pengambil }}</td>
                            <td class="text-center"><span class="badge bg-secondary">{{ $paket->ekspedisi }}</span></td>
                            <td class="text-center">
                                @if ($paket->foto_paket)
                                    <img src="{{ asset('storage/' . $paket->foto_paket) }}" 
                                         alt="Foto Paket" 
                                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 0.5rem; cursor: pointer;"
                                         class="image-popup-trigger"
                                         data-image-url="{{ asset('storage/' . $paket->foto_paket) }}">
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr><td colspan="6" class="text-center py-4">Belum ada riwayat pengambilan paket.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($riwayatPaket->hasPages())
                <div class="card-footer bg-white">{{ $riwayatPaket->links() }}</div>
            @endif
        </div>
    </div>
@endsection