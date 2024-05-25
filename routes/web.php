<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelatihController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi. 
|
*/

// Rute untuk autentikasi pengguna menggunakan AuthController
Route::controller(AuthController::class)->prefix('')->group(function () {
    // Halaman login
    Route::get('/', 'index')->name('auth.index');
    // Halaman register
    Route::get('/register', function () {
        return view('auth.register');
    })->name('auth.register');
    // Proses register
    Route::post('/register', 'register')->name('auth.postRegister');
    // Proses login
    Route::post('/login', 'login')->name('auth.login');
    // Proses logout
    Route::get('/logout', 'logout')->name('auth.logout');
});

// Grup rute yang memerlukan middleware 'auth.custom'
Route::middleware(['auth.custom'])->group(function () {
    // Halaman dashboard
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    // Rute untuk manajemen pengguna menggunakan UserController
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::post('/', 'store')->name('user.store');
        Route::put('/{id}', 'update')->name('user.update');
        Route::get('/{id}', 'destroy')->name('user.destroy');
    });

    // Rute untuk manajemen mahasiswa menggunakan MahasiswaController
    Route::controller(MahasiswaController::class)->prefix('mahasiswa')->group(function () {
        Route::get('/', 'index')->name('mahasiswa.index');
        Route::post('/', 'store')->name('mahasiswa.store');
        Route::put('/{id}', 'update')->name('mahasiswa.update');
        Route::get('/{id}', 'destroy')->name('mahasiswa.destroy');
    });

    // Rute untuk manajemen pelatih menggunakan PelatihController
    Route::controller(PelatihController::class)->prefix('pelatih')->group(function () {
        Route::get('/', 'index')->name('pelatih.index');
        Route::post('/', 'store')->name('pelatih.store');
        Route::put('/{id}', 'update')->name('pelatih.update');
        Route::get('/{id}', 'destroy')->name('pelatih.destroy');
    });

    // Rute untuk manajemen pendaftaran menggunakan PendaftaranController
    Route::controller(PendaftaranController::class)->prefix('pendaftaran')->group(function () {
        Route::get('/', 'index')->name('pendaftaran.index');
        Route::post('/', 'store')->name('pendaftaran.store');
        Route::put('/{id}', 'update')->name('pendaftaran.update');
        Route::get('/{id}', 'destroy')->name('pendaftaran.destroy');
    });

    // Rute untuk manajemen fasilitas menggunakan FasilitasController
    Route::controller(FasilitasController::class)->prefix('fasilitas')->group(function () {
        Route::get('/', 'index')->name('fasilitas.index');
        Route::post('/', 'store')->name('fasilitas.store');
        Route::put('/{id}', 'update')->name('fasilitas.update');
        Route::get('/{id}', 'destroy')->name('fasilitas.destroy');
    });

    // Rute untuk manajemen kriteria menggunakan KriteriaController
    Route::controller(KriteriaController::class)->prefix('kriteria')->group(function () {
        Route::get('/', 'index')->name('kriteria.index');
        Route::post('/', 'store')->name('kriteria.store');
        Route::put('/{id}', 'update')->name('kriteria.update');
        Route::get('/{id}', 'destroy')->name('kriteria.destroy');
    });

    // Rute untuk manajemen sub-kriteria menggunakan SubKriteriaController
    Route::controller(SubKriteriaController::class)->prefix('sub-Kriteria')->group(function () {
        Route::get('/', 'index')->name('subKriteria.index');
        Route::post('/', 'store')->name('subKriteria.store');
        Route::put('/{id}', 'update')->name('subKriteria.update');
        Route::get('/{id}', 'destroy')->name('subKriteria.destroy');
    });

    // Rute untuk manajemen penilaian menggunakan PenilaianController
    Route::controller(PenilaianController::class)->prefix('penilaian')->group(function () {
        Route::get('/', 'index')->name('penilaian.index');
        Route::post('/', 'store')->name('penilaian.store');
        Route::get('/print', 'cetak')->name('penilaian.print');
        Route::get('/{id}', 'destroy')->name('penilaian.destroy');
    });
});