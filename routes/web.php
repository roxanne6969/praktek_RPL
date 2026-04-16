<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\UserController; // Import baru Ep 8
use App\Http\Controllers\HomeController; // Import baru Ep 9
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/berita/{id}', [HomeController::class, 'detailBerita'])->name('home.detailBerita');
Route::get('/page/{id}', [HomeController::class, 'detailPage'])->name('home.detailPage');
Route::get('/semua-berita', [HomeController::class, 'semuaBerita'])->name('home.semuaBerita');


Route::middleware('guest:user')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/verify', [AuthController::class, 'verify'])->name('auth.verify');
});


Route::middleware('auth:user')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard.index');
        Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
        Route::get('/reset-password', [DashboardController::class, 'resetPassword'])->name('dashboard.resetPassword');
        Route::post('/reset-password', [DashboardController::class, 'processResetPassword'])->name('dashboard.processResetPassword');

        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/tambah', [UserController::class, 'tambah'])->name('user.tambah');
        Route::post('/user/prosesTambah', [UserController::class, 'prosesTambah'])->name('user.prosesTambah');
        Route::get('/user/ubah/{id}', [UserController::class, 'ubah'])->name('user.ubah');
        Route::post('/user/prosesUbah', [UserController::class, 'prosesUbah'])->name('user.prosesUbah');
        Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('user.hapus');

        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/tambah', [KategoriController::class, 'tambah'])->name('kategori.tambah');
        Route::post('/kategori/prosesTambah', [KategoriController::class, 'prosesTambah'])->name('kategori.prosesTambah');
        Route::get('/kategori/ubah/{id}', [KategoriController::class, 'ubah'])->name('kategori.ubah');
        Route::post('/kategori/prosesUbah', [KategoriController::class, 'prosesUbah'])->name('kategori.prosesUbah');
        Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapus'])->name('kategori.hapus');
        Route::get('/kategori/export', [KategoriController::class, 'export'])->name('kategori.export');

        Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
        Route::get('/berita/tambah', [BeritaController::class, 'tambah'])->name('berita.tambah');
        Route::post('/berita/prosesTambah', [BeritaController::class, 'prosesTambah'])->name('berita.prosesTambah');
        Route::get('/berita/ubah/{id}', [BeritaController::class, 'ubah'])->name('berita.ubah');
        Route::post('/berita/prosesUbah', [BeritaController::class, 'prosesUbah'])->name('berita.prosesUbah');
        Route::get('/berita/hapus/{id}', [BeritaController::class, 'hapus'])->name('berita.hapus');

    });
});

Route::get('files/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!File::exists($path)) { abort(404); }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('storage');
