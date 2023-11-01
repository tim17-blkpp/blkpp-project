<?php

use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\JawabanUserController;
use App\Http\Controllers\Admin\JPLController;
use App\Http\Controllers\Admin\KandidatController;
use App\Http\Controllers\Admin\KategoriBlogController;
use App\Http\Controllers\Admin\KategoriLowonganKerjaController;
use App\Http\Controllers\Admin\KategoriPelatihanController;
use App\Http\Controllers\Admin\KonfigurasiController;
use App\Http\Controllers\Admin\LowonganKerjaController;
use App\Http\Controllers\Admin\PelatihanController;
use App\Http\Controllers\Admin\PilihanJawabanController;
use App\Http\Controllers\Admin\SesiPelatihanController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\SoalController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\BlogUserController;
use App\Http\Controllers\Kandidat\CvKandidatController;
use App\Http\Controllers\Kandidat\DashboardKandidatController;
use App\Http\Controllers\Kandidat\DataDiriKandidatController;
use App\Http\Controllers\Kandidat\KerjakanTesController;
use App\Http\Controllers\Kandidat\LowonganKerjaKandidatController;
use App\Http\Controllers\Kandidat\PelatihanKandidatController;
use App\Http\Controllers\Kandidat\SertifikatKandidatController;
use App\Http\Controllers\LowonganKerjaUserController;
use App\Http\Controllers\PelatihanUserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('user.landing.index');
// });

Route::get('/', [LandingController::class, 'get'])->name('landing.get');
Route::get('/blog', [BlogUserController::class, 'get'])->name('blog.get');
Route::get('/detail_blog', [BlogUserController::class, 'detail'])->name('blog.detail');
Route::get('/lowongan_pekerjaan', [LowonganKerjaUserController::class, 'get'])->name('lowongan_pekerjaan.get');
Route::get('/detail_lowongan_pekerjaan', [LowonganKerjaUserController::class, 'detail'])->name('lowongan_pekerjaan.detail');
Route::get('/pelatihan', [PelatihanUserController::class, 'get'])->name('pelatihan.get');
Route::get('/detail_pelatihan', [PelatihanUserController::class, 'detail'])->name('pelatihan.detail');
Route::get('/kontak', [KontakController::class, 'get'])->name('kontak.get');

Route::resource('/dashboard-kandidat', DashboardKandidatController::class)->middleware(['checkRole:Kandidat', 'auth', 'verified']);
Route::resource('/data-diri-kandidat', DataDiriKandidatController::class)->middleware(['checkRole:Kandidat', 'auth', 'verified']);
Route::resource('/pelatihan-kandidat', PelatihanKandidatController::class)->middleware(['checkRole:Kandidat,Super Admin,Admin', 'auth', 'verified']);
Route::resource('/kerjakan-tes', KerjakanTesController::class)->middleware(['checkRole:Kandidat', 'auth', 'verified']);
Route::resource('/sertifikat', SertifikatKandidatController::class)->middleware(['checkRole:Kandidat', 'auth', 'verified']);
Route::resource('/lowongan-kerja-apply', LowonganKerjaKandidatController::class)->middleware(['checkRole:Kandidat,Super Admin,Admin', 'auth', 'verified']);
Route::resource('/cv-kandidat', CvKandidatController::class);

Route::prefix('admin')->group(function () {
    Route::resource('/dashboard', DashboardController::class)->middleware(['checkRole:Super Admin,Admin', 'auth', 'verified']);
    Route::resource('/', DashboardController::class)->middleware(['checkRole:Super Admin,Admin', 'auth', 'verified']);
    Route::resource('/kategori_lowongan_kerja', KategoriLowonganKerjaController::class)->middleware(['checkRole:Super Admin']);
    Route::resource('/kategori_blog', KategoriBlogController::class)->middleware(['checkRole:Super Admin']);
    Route::resource('/kategori_pelatihan', KategoriPelatihanController::class)->middleware(['checkRole:Super Admin']);
    Route::resource('/faq', FaqController::class)->middleware(['checkRole:Super Admin']);

    Route::resource('/blog', BlogController::class)->middleware(['checkRole:Super Admin']);
    Route::resource('/lowongan_kerja', LowonganKerjaController::class)->middleware(['checkRole:Super Admin']);
    Route::resource('/pelatihan', PelatihanController::class)->middleware(['checkRole:Super Admin']);
    Route::resource('/sesi_pelatihan', SesiPelatihanController::class)->middleware(['checkRole:Super Admin']);
    Route::resource('/soal', SoalController::class)->middleware(['checkRole:Super Admin']);
    Route::resource('/pilihan_jawaban', PilihanJawabanController::class)->middleware(['checkRole:Super Admin']);
    Route::resource('/jawaban_user', JawabanUserController::class)->middleware(['checkRole:Super Admin']);

    Route::resource('/kandidat', KandidatController::class)->middleware(['checkRole:Super Admin']);
    Route::resource('/siswa', SiswaController::class)->middleware(['checkRole:Super Admin']);
    Route::resource('/alumni', AlumniController::class)->middleware(['checkRole:Super Admin']);

    Route::resource('/jpl', JPLController::class)->middleware(['checkRole:Super Admin']);
    Route::resource('/konfigurasi', KonfigurasiController::class)->middleware(['checkRole:Super Admin']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
