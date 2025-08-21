<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Menampilkan halaman utama admin yang berisi daftar paket.
     */
    public function index()
    {
        // Ambil data untuk tabel utama
        $paketDiResepsionis = Paket::where('status', 'Di Resepsionis')
                                    ->latest('waktu_tiba')
                                    ->paginate(10);

        // Ambil data untuk kartu statistik
    $jumlahBelumDiambil = Paket::where('status', 'Di Resepsionis')->count();
    $paketDiambilHariIni = Paket::where('status', 'Sudah Diambil')->whereDate('waktu_diambil', today())->count();
    $paketMasukHariIni = Paket::whereDate('waktu_tiba', today())->count();  

        // Kirim semua data ke view
        return view('admin.index', compact(
            'paketDiResepsionis', 
            'jumlahBelumDiambil', 
            'paketDiambilHariIni',
            'paketMasukHariIni'
        ));
    }

    /**
     * Menampilkan formulir untuk membuat paket baru.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Menyimpan paket baru ke database.
     */
// app/Http/Controllers/Admin/PaketController.php

    public function store(Request $request)
    {
        // 1. Tambahkan validasi untuk file gambar
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'nama_pengirim' => 'required|string|max:255',
            'kontak_pengirim' => 'nullable|string|max:20',
            'alamat_pengirim' => 'nullable|string',
            'ekspedisi' => 'nullable|string|max:100',
            'foto_paket' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        // Simpan semua data dari request ke dalam sebuah variabel
        $data = $request->all();

        // 2. Cek jika ada file gambar yang di-upload
        if ($request->hasFile('foto_paket')) {
            // Simpan gambar ke storage/app/public/paket-photos
            // dan simpan path-nya ke variabel $data
            $path = $request->file('foto_paket')->store('paket-photos', 'public_uploads');
            $data['foto_paket'] = $path;
        }
        
        // 3. Set waktu tiba
        $data['waktu_tiba'] = now();

        // 4. Buat data paket baru di database menggunakan semua data yang sudah disiapkan
        Paket::create($data);

        if (auth()->check()) {
            return redirect()->route('admin.index')->with('success', 'Paket berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('success', 'Terima kasih! Paket telah berhasil dicatat.');
        }
    }

    /**
     * Mengubah status paket menjadi "Sudah Diambil".
     */
    public function tandaiDiambil(Request $request, Paket $paket)
    {
        $request->validate(['nama_pengambil' => 'required|string|max:255']);

        $paket->update([
            'status' => 'Sudah Diambil',
            'waktu_diambil' => now(),
            'nama_pengambil' => $request->nama_pengambil,
        ]);

        return redirect()->route('admin.index')->with('success', 'Paket telah ditandai sebagai sudah diambil.');
    }
}