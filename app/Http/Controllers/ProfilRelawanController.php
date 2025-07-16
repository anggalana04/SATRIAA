<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\kegiatan_relawan;
use App\Models\profil_relawan;
use App\Models\ProfilRelawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilRelawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the profile associated with the currently authenticated user
        $profil = profil_relawan::where('user_id', Auth::id())->first();

        return view('profil.relawan.index', compact('profil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profil.relawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate input data
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'keahlian' => 'required|string|max:255',
            'pengalaman' => 'nullable|string|max:500',
            'pendidikan' => 'nullable|string|max:500',
            'foto' => 'nullable|image|max:2048', // Only allow image file types with max size of 2MB
        ]);



        // Add the authenticated user's ID to the validated data
        $validated['user_id'] = Auth::id();

        // Handle file upload for 'foto'
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('profil_foto', 'public'); // Store photo in the public disk
        }

        // Create the profile for the authenticated user
        profil_relawan::create($validated);

        // Redirect to another page with a success message
        return redirect()->route('kegiatan.index')->with('success', 'Profil Relawan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    
        // Fetch the volunteer profile
        $profil = profil_relawan::where('user_id', $id)->firstOrFail();

        // Pass the data to the view
        return view('profil.relawan.show', compact('profil', ));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Retrieve the profile by ID and ensure it belongs to the current user
        $profil = profil_relawan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        return view('profil.relawan.edit', compact('profil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'keahlian' => 'required|string|max:255',
            'pengalaman' => 'nullable|string|max:500',
            'pendidikan' => 'nullable|string|max:500',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Retrieve the profile by ID and ensure it belongs to the current user
        $profil = profil_relawan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Handle file upload for 'foto'
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('profil_foto', 'public');
        }

        // Update the profile
        $profil->update($validated);

        // Redirect with a success message
        return redirect()->route('profil_relawan.index')->with('success', 'Profil Relawan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Retrieve the profile by ID and ensure it belongs to the current user
        $profil = profil_relawan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $profil->delete();

        return redirect()->route('profil_relawan.index')->with('success', 'Profil Relawan deleted successfully.');
    }
}
