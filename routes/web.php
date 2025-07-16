<?php

use App\Http\Controllers\{
    LoginController,
    UserController,
    DonasiController,
    KegiatanController,
    DashboardController,
    OrganisasiController,
    ProfilRelawanController,
    KegiatanRelawanController,
    TransaksiDonasiController,
    PendaftarKegiatanController
};

use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them
| will be assigned to the "web" middleware group. Make something great!
|----------------------------------------------------------------------
*/

// Home Page Route
Route::get('/', function () {
    return view('layouts.footer');
});

// Authentication Routes
Route::get('login', [LoginController::class, 'loginPage'])->name('login');
Route::post('autentikasi', [LoginController::class, 'autentikasi'])->name('autentikasi');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


// User Registration Routes
Route::get('register', [UserController::class, 'create'])->name('register');
Route::resource('user', UserController::class);

// Dashboard Routes for Organisasi
Route::middleware('auth')->group(function () {
    Route::get('dashboard/organisasi/kegiatan', [DashboardController::class, 'KegiatanDashboard'])->name('dashboardOrganisasiKegiatan');
    Route::get('dashboard/organisasi/pendaftar', [DashboardController::class, 'PendaftarDashboard'])->name('dashboardOrganisasiPendaftar');
    Route::get('dashboard/organisasi/donasi', [DashboardController::class, 'donasiDashboard'])->name('dashboardOrganisasiDonasi');
    Route::get('dashboard/master', [DashboardController::class, 'adminDashboard'])->name('dashboardAdmin');
});

// Donasi Routes
Route::middleware('auth')->group(function () {
    Route::resource('donasi', DonasiController::class);
    Route::put('/donasi/{id}/status', [DonasiController::class, 'updateStatus'])->name('donasi.updateStatus');
    Route::get('donasi/transaksi/{id}', [TransaksiDonasiController::class, 'transfer'])->name('donasi.transfer');
});

// Organisasi Routes
Route::resource('organisasi', OrganisasiController::class);

// Profil Relawan Routes
Route::resource('profil_relawan', ProfilRelawanController::class);

// Kegiatan Routes
Route::resource('kegiatan', KegiatanController::class)->middleware('auth');

// Pendaftar Kegiatan Routes
Route::resource('daftar', PendaftarKegiatanController::class);
Route::get('/kegiatan/daftar/{id}', [PendaftarKegiatanController::class, 'daftar'])->name('kegiatan.daftar');
Route::post('/kegiatan/store-pendaftaran/{id}', [PendaftarKegiatanController::class, 'store'])->name('kegiatan.store_pendaftaran');
Route::get('/kegiatan/{id}/daftar', [PendaftarKegiatanController::class, 'daftar'])->name('kegiatan.daftar.form');
Route::post('/kegiatan/{id}/store-pendaftaran', [PendaftarKegiatanController::class, 'store'])->name('kegiatan.store_pendaftaran');
Route::post('dashboard/organisasi/pendaftar/{id}', [PendaftarKegiatanController::class, 'updateStatus'])->name('update.status');
Route::get('/riwayat', [DashboardController::class, 'riwayat'])->name('transaksi_donasi.riwayat');
Route::get('/transaksi-donasi/export-pdf', [TransaksiDonasiController::class, 'exportPdf'])->name('transaksi_donasi.export_pdf');




// Kegiatan Relawan Routes
Route::post('daftar_entry', [KegiatanRelawanController::class, 'store'])->name('daftar.entry');

// Transaksi Donasi Routes
Route::resource('transaksi_donasi', TransaksiDonasiController::class);

// Additional Routes for Kegiatan and Status Updates
Route::put('/kegiatan/{id}/update-status', [KegiatanController::class, 'updateStatus'])->name('kegiatan.updateStatus');
