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
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->prefix('')->group(function () {
    Route::get('/', 'index')->name('auth.index');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('auth.register');
    Route::post('/register', 'register')->name('auth.postRegister');
    Route::post('/login', 'login')->name('auth.login');
    Route::get('/logout', 'logout')->name('auth.logout');
});

Route::middleware(['auth.custom'])->group(
    function () {
        Route::get('/dashboard', function () {
            return view('pages.dashboard');
        })->name('dashboard');

        // route user
        Route::controller(UserController::class)->prefix('user')->group(function () {
            Route::get('/', 'index')->name('user.index');
            Route::post('/', 'store')->name('user.store');
            Route::put('/{id}', 'update')->name('user.update');
            Route::get('/{id}', 'destroy')->name('user.destroy');
        });

        // route mahasiswa
        Route::controller(MahasiswaController::class)->prefix('mahasiswa')->group(function () {
            Route::get('/', 'index')->name('mahasiswa.index');
            Route::post('/', 'store')->name('mahasiswa.store');
            Route::put('/{id}', 'update')->name('mahasiswa.update');
            Route::get('/{id}', 'destroy')->name('mahasiswa.destroy');
        });

        // route pelatih
        Route::controller(PelatihController::class)->prefix('pelatih')->group(function () {
            Route::get('/', 'index')->name('pelatih.index');
            Route::post('/', 'store')->name('pelatih.store');
            Route::put('/{id}', 'update')->name('pelatih.update');
            Route::get('/{id}', 'destroy')->name('pelatih.destroy');
        });

        // route pendaftaran
        Route::controller(PendaftaranController::class)->prefix('pendaftaran')->group(function () {
            Route::get('/', 'index')->name('pendaftaran.index');
            Route::post('/', 'store')->name('pendaftaran.store');
            Route::put('/{id}', 'update')->name('pendaftaran.update');
            Route::get('/{id}', 'destroy')->name('pendaftaran.destroy');
        });

        // route fasilitas
        Route::controller(FasilitasController::class)->prefix('fasilitas')->group(function () {
            Route::get('/', 'index')->name('fasilitas.index');
            Route::post('/', 'store')->name('fasilitas.store');
            Route::put('/{id}', 'update')->name('fasilitas.update');
            Route::get('/{id}', 'destroy')->name('fasilitas.destroy');
        });

        // route kriteria
        Route::controller(KriteriaController::class)->prefix('kriteria')->group(function () {
            Route::get('/', 'index')->name('kriteria.index');
            Route::post('/', 'store')->name('kriteria.store');
            Route::put('/{id}', 'update')->name('kriteria.update');
            Route::get('/{id}', 'destroy')->name('kriteria.destroy');
        });

        // route subkriteria
        Route::controller(SubKriteriaController::class)->prefix('sub-Kriteria')->group(function () {
            Route::get('/', 'index')->name('subKriteria.index');
            Route::post('/', 'store')->name('subKriteria.store');
            Route::put('/{id}', 'update')->name('subKriteria.update');
            Route::get('/{id}', 'destroy')->name('subKriteria.destroy');
        });

        // route penilaian
        Route::controller(PenilaianController::class)->prefix('penilaian')->group(function () {
            Route::get('/', 'index')->name('penilaian.index');
            Route::post('/', 'store')->name('penilaian.store');
            Route::get('/print', 'cetak')->name('penilaian.print');
            Route::get('/{id}', 'destroy')->name('penilaian.destroy');
        });
    }
);
