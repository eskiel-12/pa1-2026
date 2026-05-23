<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\KontakController as AdminKontakController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\GeositeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\KontakController;


// ==================== FRONTEND ROUTES ====================


// Destinasi Routes
Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi');
Route::get('/destinasi/alam', [DestinasiController::class, 'alam'])->name('destinasi.alam');
Route::get('/destinasi/buatan', [DestinasiController::class, 'buatan'])->name('destinasi.buatan');
Route::get('/destinasi/budaya', [DestinasiController::class, 'budaya'])->name('destinasi.budaya');
Route::get('/destinasi/{id}', [DestinasiController::class, 'show'])->name('destinasi.show')->whereNumber('id');

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Informasi
Route::get('/informasi', function () {
    $informasi = App\Models\Informasi::where('status', true)->latest()->paginate(10);
    return view('pages.informasi', compact('informasi'));
})->name('informasi');

// Detail Informasi
Route::get('/informasi/{slug}', function ($slug) {
    $informasi = App\Models\Informasi::where('slug', $slug)->firstOrFail();
    $informasi->increment('views');
    return view('pages.informasi-detail', compact('informasi'));
})->name('informasi.detail');

Route::get('/search', [SearchController::class, 'index'])->name('search');

// ==================== GEOSITE ROUTES (TIGA GEOSITE) ====================
Route::get('/geosite/muara', [GeositeController::class, 'muara'])->name('geosite.muara');

Route::get('/geosite/sibandang', [GeositeController::class, 'sibandang'])->name('geosite.sibandang');

Route::get('/geosite/sampuran', [GeositeController::class, 'sampuran'])->name('geosite.sampuran');

Route::get('/geosite/papande', [GeositeController::class, 'papande'])->name('geosite.papande');

// Galeri
Route::get('/galeri', function () {
    $galeri = App\Models\Galeri::where('status', true)->latest()->paginate(12);
    return view('pages.galeri', compact('galeri'));
})->name('galeri');

// Berita
Route::get('/berita', function () {
    $berita = App\Models\Berita::with('kategori')->where('status', true)->latest()->paginate(9);
    $kategori = App\Models\Kategori::all();
    return view('pages.berita', compact('berita', 'kategori'));
})->name('berita');

// Detail Berita
Route::get('/berita/{slug}', function ($slug) {
    $berita = App\Models\Berita::with('kategori')->where('slug', $slug)->firstOrFail();
    $berita->increment('views');
    return view('pages.berita-detail', compact('berita'));
})->name('berita.detail');

// Detail Galeri
Route::get('/galeri/{slug}', function ($slug) {
    $galeri = App\Models\Galeri::where('slug', $slug)->firstOrFail();
    $galeri->increment('views');
    return view('pages.galeri-detail', compact('galeri'));
})->name('galeri.detail');

// UMKM
Route::get('/umkm', [HomeController::class, 'umkm'])->name('umkm');

// Budaya
Route::get('/budaya', [HomeController::class, 'budaya'])->name('budaya');

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak/pesan', [KontakController::class, 'storeMessage'])->name('kontak.storeMessage');

// ==================== AUTH ROUTES ====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', function () {
        $totalGaleri = App\Models\Galeri::count();
        $totalBerita = App\Models\Berita::count();
        $totalInformasi = App\Models\Informasi::count();
        $totalViews = App\Models\Berita::sum('views') + App\Models\Galeri::sum('views') + App\Models\Informasi::sum('views');
        return view('admin.dashboard', compact('totalGaleri', 'totalBerita', 'totalInformasi', 'totalViews'));
    })->name('admin.dashboard');
    
    Route::resource('galeri', GaleriController::class)->names('admin.galeri');
    Route::resource('berita', BeritaController::class)->names('admin.berita');
    Route::resource('informasi', InformasiController::class)->names('admin.informasi');
    Route::resource('banner', BannerController::class)->names('admin.banner');
    Route::resource('kontak', AdminKontakController::class)->names('admin.kontak');
    Route::resource('destinasi', App\Http\Controllers\Admin\DestinasiController::class)->names('admin.destinasi');
    Route::resource('umkm', UmkmController::class)->names('admin.umkm');
    Route::post('galeri/toggle-status/{id}',[GaleriController::class, 'toggleStatus'])->name('admin.galeri.toggle-status');
    Route::get('language/{lang}', [App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');

    
});