<?php

namespace App\Http\Controllers;

use App\Models\donasi;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Organisasi;
use App\Models\PendaftarKegiatan;
use App\Models\profil_relawan;
use App\Models\ProfilRelawan;
use App\Models\transaksi_donasi;
use App\Models\User;

class dashboardController extends Controller
{
    public function KegiatanDashboard()
    {
        $organisasi = Organisasi::where('user_id', auth()->id())->first();

        $kegiatan = Kegiatan::all();
        return view('dashboard.organisasi.kegiatan', compact('kegiatan', 'organisasi'));
    }

    public function PendaftarDashboard()
    {
        $organisasi = Organisasi::where('user_id', auth()->id())->first();
        $profil = profil_relawan::all();
        $kegiatan = Kegiatan::all();
        $pendaftar = PendaftarKegiatan::all();

        return view('dashboard.organisasi.pendaftar', compact('profil', 'kegiatan', 'pendaftar', 'organisasi'));
    }

    public function donasiDashboard()
    {
        // Fetch the organisasi data
        $organisasi = Organisasi::where('user_id', auth()->id())->first();

        // Fetch the donasi data
        $donasi = donasi::all();

        // Pass both organisasi and donasi to the view
        return view('dashboard.organisasi.donasi', compact('donasi', 'organisasi'));
    }

    public function adminDashboard()
    {
        $kegiatan = Kegiatan::all();
        $donasi = donasi::all();
        $organisasi = Organisasi::all();
        $user = User::all();

        return view('dashboard.admin.data', compact('kegiatan', 'donasi', 'organisasi', 'user'));
    }

    public function riwayat()
    {
        // Fetch all donation transactions with the related donation and user
        $transaksiDonasi = transaksi_donasi::all();

        return view('dashboard.organisasi.riwayat', compact('transaksiDonasi'));
    }
}
