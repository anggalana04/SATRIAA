<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Organisasi;
use App\Models\profil_relawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DonasiController extends Controller
{
    /**
     * Menampilkan form untuk membuat kegiatan donasi baru.
     */
    public function create()
    {
        return view('donasi.create');
    }

    /**
     * Menyimpan data donasi ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
            'target_donasi' => 'nullable|numeric|min:0',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|in:pending,aktif,selesai',
            'rekening/VA' => 'required',
            'kategori' => 'required|in:Kesehatan,Bencana,Pendidikan,Sosial dan Kesejahteraan,Pemberdayaan Masyarakat,Keagamaan,Lainnya',
            'foto' => 'nullable|image|max:2048', // Maksimal 2 MB
        ]);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('donasi_foto', 'public');
        }



        // Simpan data ke dalam database
        Donasi::create([
            'organisasi_id' => 1, // Sesuaikan dengan autentikasi Anda
            'nama' => $validated['nama'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'deskripsi' => $validated['deskripsi'],
            'target_donasi' => $validated['target_donasi'],
            'lokasi' => $validated['lokasi'],
            'status' => $validated['status'],
            'kategori' => $validated['kategori'],
            'rekening/VA' => $validated['rekening/VA'],
            'foto' => $fotoPath,
            'organisasi_id' => Organisasi::where('user_id', auth()->user()->id)->value('id') ?? null
        ]);

        // Redirect ke halaman lain dengan pesan sukses
        return redirect()->route('donasi.index')->with('success', 'Donasi berhasil dibuat!');
    }

    public function edit(Donasi $donasi)
    {
        return view('donasi.edit', compact('donasi'));
    }

    public function update(Request $request, Donasi $donasi)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
            'target_donasi' => 'nullable|numeric|min:0',
            'rekening/VA' => 'required',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|in:pending,aktif,selesai',
            'kategori' => 'required|in:Kesehatan,Bencana,Pendidikan,Sosial dan Kesejahteraan,Pemberdayaan Masyarakat,Keagamaan,Lainnya',
            'foto' => 'nullable|image|max:2048', // Maksimal 2 MB
        ]);

        // Upload foto jika ada yang baru
        if ($request->hasFile('foto')) {
            // Menghapus file foto lama jika ada
            if ($donasi->foto) {
                Storage::delete($donasi->foto);
            }

            // Mengunggah file foto baru
            $fotoPath = $request->file('foto')->store('donasi_foto', 'public');
        } else {
            $fotoPath = $donasi->foto;
        }

        // Update data ke dalam database
        $donasi->update([
            'organisasi_id' => 1, // Sesuaikan dengan autentikasi Anda
            'nama' => $validated['nama'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'deskripsi' => $validated['deskripsi'],
            'target_donasi' => $validated['target_donasi'],
            'lokasi' => $validated['lokasi'],
            'status' => $validated['status'],
            'foto' => $fotoPath,
        ]);

        // Redirect ke halaman lain dengan pesan sukses
        return redirect()->route('dashboardOrganisasiDonasi')->with('success', 'Donasi berhasil diperbarui!');
    }

    /**
     * Menampilkan daftar kegiatan donasi.
     */
    public function index()
    {
        $profil = profil_relawan::where('user_id', auth()->id())->first();
        $user = auth()->user();

        // Ambil data donasi dari database
        $donasi = donasi::all();
        if ($user->jenis === 'organisasi') {
            return redirect()->route('dashboardOrganisasiKegiatan');
        }
        return view('donasi.index', compact('donasi', 'profil'));
    }

    public function updateStatus(Request $request, $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->status = $request->input('status');
        $donasi->save();

        return redirect()->back()->with('success', 'Status donasi berhasil diperbarui.');
    }

    public function show($id)
    {
        $donasi = Donasi::findOrFail($id);
        return view('donasi.show', compact('donasi'));
    }
    public function destroy($id)
    {
        // Find the donation record by its ID
        $donasi = Donasi::findOrFail($id);

        // Delete the associated photo if it exists
        if ($donasi->foto) {
            Storage::delete($donasi->foto);
        }

        // Delete the donation record from the database
        $donasi->delete();

        // Redirect to the donation index page with a success message
        return redirect()->route('dashboardOrganisasiDonasi')->with('success', 'Donasi berhasil dihapus!');
    }

    public function calculateProgress(Donasi $donasi)
    {
        // Example logic: Assuming target_donasi and current donasi are available
        if ($donasi->target_donasi > 0) {
            $progress = ($donasi->donasi_terkumpul / $donasi->target_donasi) * 100;
            return min($progress, 100); // Ensure progress does not exceed 100%
        }
        return 0;
    }
}
