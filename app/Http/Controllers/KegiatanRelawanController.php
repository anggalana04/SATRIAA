<?php

namespace App\Http\Controllers;


use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\KegiatanRelawan;
use App\Models\kegiatan_relawan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class KegiatanRelawanController extends Controller
{
    /**
     * Store a new volunteer registration for an activity
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
        ]);

        // Check if the user is already registered for this activity
        $existingRegistration = kegiatan_relawan::where('kegiatan_id', $request->kegiatan_id)
            ->where('users_id', Auth::id())
            ->exists();

        if ($existingRegistration) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar dalam kegiatan ini.');
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create the kegiatan_relawan record
            $kegiatanRelawan = kegiatan_relawan::create([
                'kegiatan_id' => $request->kegiatan_id,
                'users_id' => Auth::id(),
            ]);

            // Find the related kegiatan
            $kegiatan = Kegiatan::findOrFail($request->kegiatan_id);

            // Increment jumlah_relawan_terdaftar
            $kegiatan->increment('jumlah_relawan_terdaftar');

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Berhasil mendaftar kegiatan.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            // Log the error
            Log::error('Kegiatan Relawan Registration Error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Gagal mendaftar kegiatan. Silakan coba lagi.');
        }
    }

    /**
     * Remove a volunteer from an activity
     */
    public function destroy($kegiatanId)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Find the registration
            $registration = kegiatan_relawan::where('kegiatan_id', $kegiatanId)
                ->where('users_id', Auth::id())
                ->firstOrFail();

            // Find the related kegiatan
            $kegiatan = Kegiatan::findOrFail($kegiatanId);

            // Delete the registration
            $registration->delete();

            // Decrement jumlah_relawan_terdaftar
            $kegiatan->decrement('jumlah_relawan_terdaftar');

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Berhasil membatalkan pendaftaran kegiatan.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            // Log the error
            Log::error('Kegiatan Relawan Cancellation Error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Gagal membatalkan pendaftaran. Silakan coba lagi.');
        }
    }

    /**
     * Add rating and comment for a volunteer after activity completion
     */
    public function addRating(Request $request, $kegiatanId)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'nilai' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:255',
        ]);

        try {
            $kegiatanRelawan = kegiatan_relawan::where('kegiatan_id', $kegiatanId)
                ->where('users_id', $request->users_id)
                ->firstOrFail();

            $kegiatanRelawan->update([
                'nilai' => $request->nilai,
                'komentar' => $request->komentar,
            ]);

            return redirect()->back()->with('success', 'Penilaian berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Kegiatan Relawan Rating Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan penilaian.');
        }
    }

    /**
     * Get list of volunteers for a specific activity
     */
    public function listVolunteers($kegiatanId)
    {
        $volunteers = kegiatan_relawan::with('relawan')
            ->where('kegiatan_id', $kegiatanId)
            ->get();

        return view('kegiatan.volunteers', compact('volunteers'));
    }
}
