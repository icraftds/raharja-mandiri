<?php

use Illuminate\Support\Facades\Route;

// Controller Publik
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\TentangController;
use App\Http\Controllers\Public\GaleriController;
use App\Http\Controllers\Public\ArtikelController;
use App\Http\Controllers\Public\DonasiController;
use App\Http\Controllers\Public\KontakController;

// Controller Admin
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;
use App\Http\Controllers\Admin\RekeningController;
use App\Http\Controllers\Admin\KebutuhanController;
use App\Http\Controllers\Admin\KontakController as AdminKontakController;
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\Admin\PengunjungController;

/*
|--------------------------------------------------------------------------
| Rute Publik Website
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('tentang')->name('tentang.')->group(function () {
    Route::get('/visi-misi', [TentangController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/sejarah', [TentangController::class, 'sejarah'])->name('sejarah');
    Route::get('/kepengurusan', [TentangController::class, 'kepengurusan'])->name('kepengurusan');
});

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

Route::prefix('artikel')->name('artikel.')->group(function () {
    Route::get('/', [ArtikelController::class, 'index'])->name('index');
    Route::get('/baca', [ArtikelController::class, 'showLegacy'])->name('baca.legacy');
    Route::get('/{slug}', [ArtikelController::class, 'show'])->name('show');
});

Route::prefix('donasi')->name('donasi.')->group(function () {
    Route::get('/rekening', [DonasiController::class, 'accounts'])->name('rekening');
    Route::get('/kebutuhan', [DonasiController::class, 'needs'])->name('kebutuhan');
});

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

/*
|--------------------------------------------------------------------------
| Rute Autentikasi Admin
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Rute CMS Admin (Terproteksi Middleware Auth)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::redirect('/', '/admin/dashboard');

    // Dashboard (Hero & Homepage)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/hero', [DashboardController::class, 'updateHero'])->name('dashboard.hero');

    // Sejarah
    Route::get('/sejarah', [SejarahController::class, 'index'])->name('sejarah');
    Route::post('/sejarah', [SejarahController::class, 'store'])->name('sejarah.store');
    Route::post('/sejarah/update', [SejarahController::class, 'update'])->name('sejarah.update');
    Route::delete('/sejarah/{id}', [SejarahController::class, 'destroy'])->name('sejarah.destroy');

    // Visi & Misi
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi');
    Route::post('/visi-misi', [VisiMisiController::class, 'update'])->name('visi-misi.update');

    // Kepengurusan
    Route::get('/kepengurusan', [PengurusController::class, 'index'])->name('kepengurusan');
    Route::post('/kepengurusan', [PengurusController::class, 'store'])->name('kepengurusan.store');
    Route::post('/kepengurusan/{id}', [PengurusController::class, 'update'])->name('kepengurusan.update');
    Route::delete('/kepengurusan/{id}', [PengurusController::class, 'destroy'])->name('kepengurusan.destroy');

    // Galeri
    Route::get('/galeri', [AdminGaleriController::class, 'index'])->name('galeri');
    Route::post('/galeri', [AdminGaleriController::class, 'store'])->name('galeri.store');
    Route::delete('/galeri/{id}', [AdminGaleriController::class, 'destroy'])->name('galeri.destroy');

    // Artikel
    Route::get('/artikel', [AdminArtikelController::class, 'index'])->name('artikel');
    Route::get('/artikel/tambah', [AdminArtikelController::class, 'create'])->name('artikel.create');
    Route::post('/artikel', [AdminArtikelController::class, 'store'])->name('artikel.store');
    Route::get('/artikel/{id}/edit', [AdminArtikelController::class, 'edit'])->name('artikel.edit');
    Route::post('/artikel/{id}', [AdminArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{id}', [AdminArtikelController::class, 'destroy'])->name('artikel.destroy');

    // Rekening
    Route::get('/rekening', [RekeningController::class, 'index'])->name('rekening');
    Route::post('/rekening', [RekeningController::class, 'store'])->name('rekening.store');
    Route::post('/rekening/update', [RekeningController::class, 'update'])->name('rekening.update');
    Route::delete('/rekening/{id}', [RekeningController::class, 'destroy'])->name('rekening.destroy');

    // Kebutuhan Donasi (Barang Fisik)
    Route::get('/kebutuhan', [KebutuhanController::class, 'index'])->name('kebutuhan');
    Route::post('/kebutuhan', [KebutuhanController::class, 'store'])->name('kebutuhan.store');
    Route::post('/kebutuhan/{id}', [KebutuhanController::class, 'update'])->name('kebutuhan.update');
    Route::delete('/kebutuhan/{id}', [KebutuhanController::class, 'destroy'])->name('kebutuhan.destroy');

    // Kontak
    Route::get('/kontak', [AdminKontakController::class, 'index'])->name('kontak');
    Route::post('/kontak', [AdminKontakController::class, 'update'])->name('kontak.update');

    // Kotak Masuk Pesan Publik
    Route::get('/pesan', [PesanController::class, 'index'])->name('pesan');
    Route::patch('/pesan/{id}/dibaca', [PesanController::class, 'markAsRead'])->name('pesan.dibaca');
    Route::delete('/pesan/{id}', [PesanController::class, 'destroy'])->name('pesan.destroy');

    // Analitik Pengunjung Website
    Route::get('/pengunjung', [PengunjungController::class, 'index'])->name('pengunjung');
    Route::delete('/pengunjung/bersihkan', [PengunjungController::class, 'cleanOldLogs'])->name('pengunjung.clean');
});
