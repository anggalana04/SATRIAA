<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Organisasi;
use App\Models\profil_relawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profil = profil_relawan::where('user_id', auth()->id())->first();
        $user = auth()->user();
        $kegiatan = Kegiatan::all();
        if ($user->jenis === 'organisasi') {
            return redirect()->route('dashboardOrganisasiKegiatan');
        }
        return view('kegiatan.index', compact(['kegiatan', 'user', 'profil']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jumlah_relawan_dibutuhkan' => 'required|integer',
            'lokasi' => 'required|string|max:255',
            'kontak' => 'required|string|max:255', // Make kontak optional
            'kategori' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/kegiatan_images', $imageName);

            // Save the image path in the database
            $validatedData['foto'] = str_replace('public/', 'storage/', $imagePath);
        }

        $validatedData['organisasi_id'] = Organisasi::where('user_id', auth()->user()->id)->value('id') ?? null;

        // Create a new Kegiatan record
        Kegiatan::create($validatedData);

        return redirect()->route('dashboardOrganisasiKegiatan')->with('success', 'Kegiatan created successfully!');
    }


    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'deskripsi' => 'sometimes|string',
            'tanggal_mulai' => 'sometimes|date',
            'tanggal_selesai' => 'sometimes|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'sometimes|string|max:255',
            'status' => 'sometimes|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image update
        if ($request->hasFile('foto')) {
            // Delete the old image if it exists
            if ($kegiatan->foto) {
                Storage::delete(str_replace('storage/', 'public/', $kegiatan->foto));
            }

            $image = $request->file('foto');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/kegiatan_images', $imageName);

            // Update image path
            $kegiatan->foto = str_replace('public/', 'storage/', $imagePath);
        }

        // Update other fields
        $kegiatan->update($request->except('foto', 'kontak'));

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan updated successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $organisasi = Organisasi::findOrFail($kegiatan->id);
        $profil = profil_relawan::where('user_id', auth()->id())->first();

        return view('kegiatan.show', compact('kegiatan', 'organisasi', 'profil'));
    }

    public function daftarKegiatan($id)
    {
        // Get the selected Kegiatan
        $kegiatan = Kegiatan::findOrFail($id);

        // Redirect to the PendaftarKegiatan form
        return redirect()->route('pendaftar_kegiatan.create', ['kegiatan_id' => $kegiatan->id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // Delete image file if it exists
        if ($kegiatan->foto) {
            Storage::delete(str_replace('storage/', 'public/', $kegiatan->foto));
        }

        $kegiatan->delete();

        return redirect()->route('dashboardOrganisasiKegiatan')->with('success', 'Kegiatan deleted successfully!');
    }

    // Add this new method to your KegiatanController class
    public function updateStatus(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'status' => 'required|string|in:pending,aktif,selesai'
        ]);

        $kegiatan->status = $request->status;
        $kegiatan->save();

        return redirect()->back()->with('success', 'Status kegiatan berhasil diperbarui');
    }
}
