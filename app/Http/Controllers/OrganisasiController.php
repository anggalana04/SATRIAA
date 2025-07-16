<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Organisasi;
use App\Models\profil_relawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganisasiController extends Controller
{
    public function index()
    {
        $profil = profil_relawan::where('user_id', auth()->id())->first();
        $organisasi = Organisasi::all();
        return view('organisasi.index', compact('organisasi', 'profil'));
    }

    public function create()
    {
        return view('organisasi.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ketua' => 'required|string|max:255',
            'kategori' => 'required|in:Kesehatan,Pendidikan,Lingkungan Hidup,HAM,Keagamaan,Olahraga dan Kesenian',
            'visi' => 'required|string|max:255',
            'misi' => 'required|string|max:255',
            'id_sertifikasi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'wa' => 'required|string|max:20',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('organisasi_images', $imageName, 'public');

            $validatedData['foto'] = $imagePath;
        }

        $validatedData['user_id'] = auth()->user()->id;

        Organisasi::create($validatedData);

        return redirect()->route('dashboardOrganisasiKegiatan')
            ->with('success', 'Organisasi created successfully!');
    }

    public function show($id)
    {
        $organization = Organisasi::findOrFail($id);

        // Fetch active activities related to the organization
        $activities = Kegiatan::where('organisasi_id', $id)
            ->where('status', 'aktif')
            ->get();
        return view('organisasi.show', compact('organization', 'activities'));
    }

    public function edit(Organisasi $organisasi)
    {
        return view('organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, Organisasi $organisasi)
    {
        $validatedData = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'alamat' => 'sometimes|string|max:255',
            'ketua' => 'sometimes|string|max:255',
            'kategori' => 'sometimes|in:Kesehatan,Pendidikan,Lingkungan Hidup,HAM,Keagamaan,Olahraga dan Kesenian',
            'visi' => 'sometimes|string|max:255',
            'misi' => 'sometimes|string|max:255',
            'id_sertifikasi' => 'sometimes|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'email' => 'sometimes|email|max:255',
            'wa' => 'sometimes|string|max:20',
        ]);

        // Handle file upload if a new photo is uploaded
        if ($request->hasFile('foto')) {
            // Delete old image if exists
            if ($organisasi->foto) {
                Storage::disk('public')->delete($organisasi->foto);
            }

            $image = $request->file('foto');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('organisasi_images', $imageName, 'public');

            $validatedData['foto'] = $imagePath;
        }

        // Update the organisation
        $organisasi->update($validatedData);

        return redirect()->route('dashboardOrganisasiKegiatan')
            ->with('success', 'Organisasi updated successfully!');
    }

    public function destroy(Organisasi $organisasi)
    {
        // Delete associated image if exists
        if ($organisasi->foto) {
            Storage::disk('public')->delete($organisasi->foto);
        }

        // Delete the organisation
        $organisasi->delete();

        return redirect()->route('organisasi.index')
            ->with('success', 'Organisasi deleted successfully!');
    }
}
