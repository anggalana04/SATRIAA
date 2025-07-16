<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\kegiatan_relawan;
use Illuminate\Http\Request;
use App\Models\PendaftarKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PendaftarKegiatanController extends Controller
{
    /**
     * Display a listing of the registrants
     */
    public function index()
    {
        $pendaftar_kegiatan = PendaftarKegiatan::with(['user', 'kegiatan'])->get();
        return view('pendaftar_kegiatan.index', compact('pendaftar_kegiatan'));
    }

    /**
     * Show registration form for a specific activity
     */
    public function daftar($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // Validate registration eligibility
        $this->validateRegistration($kegiatan);

        // Check if user is already registered
        $existingPendaftaran = PendaftarKegiatan::where('user_id', auth()->id())
            ->where('kegiatan_id', $id)
            ->first();

        if ($existingPendaftaran) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar kegiatan ini.');
        }

        return view('kegiatan.daftar', compact('kegiatan'));
    }

    /**
     * Store a new registration
     */
    public function store(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // Validate registration eligibility
        $this->validateRegistration($kegiatan);

        // Validate input
        $validatedData = $request->validate([
            'alasan' => 'required|string|max:1000'
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create registration
            $pendaftaran = PendaftarKegiatan::create([
                'user_id' => auth()->id(),
                'kegiatan_id' => $id,
                'alasan' => $validatedData['alasan'],
                'status' => 'onreview'
            ]);

            // Commit the transaction
            DB::commit();

            return redirect()->route('kegiatan.index')
                ->with('success', 'Pendaftaran berhasil. Silakan tunggu konfirmasi.');
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            // Log the error
            Log::error('Pendaftaran Kegiatan Error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Gagal mendaftar kegiatan. Silakan coba lagi.');
        }
    }

    /**
     * Update registration status
     */
    public function updateStatus($id, Request $request)
    {
        DB::beginTransaction();

        try {
            // Find the PendaftarKegiatan by ID
            $pendaftarKegiatan = PendaftarKegiatan::findOrFail($id);

            // Update the status
            $newStatus = $request->input('status');
            $pendaftarKegiatan->status = $newStatus;
            $pendaftarKegiatan->save();

            if ($newStatus === 'diterima') {
                $kegiatan = Kegiatan::where('id', $pendaftarKegiatan->kegiatan_id)->first();



                if (!$kegiatan) {
                    throw new \Exception('Kegiatan tidak ditemukan.');
                }

                // Check if the volunteer limit is reached
                if ($kegiatan->jumlah_relawan_terdaftar >= $kegiatan->jumlah_relawan_dibutuhkan) {
                    throw new \Exception('Kuota relawan sudah penuh.');
                }

                // Create KegiatanRelawan record
                kegiatan_relawan::create([
                    'kegiatan_id' => $kegiatan->id,
                    'users_id' => $pendaftarKegiatan->user_id,
                ]);

                // Increment the volunteer count
                $kegiatan->increment('jumlah_relawan_terdaftar');
            }

            DB::commit();

            return redirect(route('dashboardOrganisasiPendaftar'))
                ->with('success', 'Status pendaftaran berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Update Status Pendaftaran Error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }


    /**
     * Remove a registration
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $pendaftar = PendaftarKegiatan::findOrFail($id);

            // If already accepted, remove from KegiatanRelawan and decrement count
            if ($pendaftar->status === 'onreview') {
                $kegiatanRelawan = kegiatan_relawan::where('kegiatan_id', $pendaftar->kegiatan_id)
                    ->where('users_id', $pendaftar->user_id)
                    ->first();

                if ($kegiatanRelawan) {
                    $kegiatanRelawan->delete();

                    // Decrement volunteer count
                    $pendaftar->kegiatan->decrement('jumlah_relawan_terdaftar');
                }
            }

            // Delete the registration
            $pendaftar->delete();

            DB::commit();

            return redirect()->route('dashboardOrganisasiPendaftar')
                ->with('success', 'Pendaftaran kegiatan berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Hapus Pendaftaran Error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Gagal menghapus pendaftaran.');
        }
    }

    /**
     * Validate registration eligibility
     */
    protected function validateRegistration(Kegiatan $kegiatan)
    {
        // Check if the activity is still open for registration
        if ($kegiatan->status !== 'aktif') {
            throw new \Exception('Kegiatan tidak lagi menerima pendaftaran.');
        }

        // Check if max volunteers limit is reached
        if ($kegiatan->jumlah_relawan_terdaftar >= $kegiatan->jumlah_relawan_dibutuhkan) {
            throw new \Exception('Kuota relawan sudah penuh.');
        }

        // Optional: Additional validations can be added here
        // For example, check user's profile completeness, age restrictions, etc.
    }
}
