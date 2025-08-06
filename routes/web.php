<?php

use App\Enums\UserRole;
use App\Http\Middleware\CheckRole;
use App\Livewire\Admin\ManageUsers;
use App\Livewire\Admin\ProsesPembayaran;
use App\Livewire\Patients\CreatePatient;
use App\Livewire\Patients\LevenshteinListPatient;
use App\Livewire\Patients\ListPatient;
use App\Livewire\Patients\ShowPatient;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Admin\UserIndex;
use App\Livewire\Dokter\DaftarPeriksa;
use App\Livewire\Dokter\InputPemeriksaan;
use App\Livewire\Manajemen\DokterIndex;
use App\Livewire\Manajemen\KelolaDokter;
use App\Livewire\Manajemen\KelolaLayanan;
use App\Livewire\Manajemen\SortirBagihasil;
use App\Livewire\Patients\DaftarPeriksaPasien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
     if (Auth::check()) {
        // Sudah login, redirect sesuai role
        return match (Auth::user()->role->value) {
            1 => redirect()->route('admin.patient.create'),
            2  => redirect()->route('dokter.patient.daftar-periksa'),
            3 => redirect()->route('manajemen.sortir-bagihasil'),
        };
    }

    // Belum login, ke halaman login
    return redirect()->route('login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {



    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// ---------------------- ADMIN AREA ----------------------
Route::prefix('admin')
    ->middleware(['auth', CheckRole::class . ':' . UserRole::Admin->value])
    ->name('admin.')
    ->group(function () {



        Route::prefix('pasien')->name('patient.')->group(function () {
            Route::get('/', ListPatient::class)->name('index');
            Route::get('/pendaftaran', CreatePatient::class)->name('create');
            Route::get('/daftar-periksa', DaftarPeriksaPasien::class)
            ->name('daftar-periksa');
            Route::get('/proses-pembayaran/{periksaId}', ProsesPembayaran::class)->name('proses-pembayaran');
            Route::get('/{patient}', ShowPatient::class)->name('show');
        });

        Route::prefix('levenshtein')->name('levenshtein.')->group(function () {
            Route::get('/cari-pasien', LevenshteinListPatient::class)->name('search');
        });
    });

// ------------------- MANAJEMEN AREA ---------------------
Route::prefix('manajemen')
    ->middleware(['auth', CheckRole::class . ':' . UserRole::Manajemen->value])
    ->name('manajemen.')
    ->group(function () {
        Route::get('/sortir-bagihasil', SortirBagihasil::class)->name('sortir-bagihasil');
        Route::get('/kelola-layanan', KelolaLayanan::class)->name('kelola-layanan');
        Route::get('/kelola-dokter', KelolaDokter::class)->name('kelola-dokter');
        Route::get('/kelola-akun', ManageUsers::class)->name('kelola-akun');
    });

// ---------------------- DOKTER AREA ---------------------
Route::prefix('dokter')
    ->middleware(['auth', CheckRole::class . ':' . UserRole::Dokter->value])
    ->name('dokter.')
    ->group(function () {
        Route::prefix('pasien')->name('patient.')->group(function () {
            Route::get('/daftar-periksa', DaftarPeriksa::class)
            ->name('daftar-periksa');
            Route::get('/input-pemeriksaan/{periksaId}', InputPemeriksaan::class)
            ->name('input-pemeriksaan');
        });
    });

require __DIR__.'/auth.php';
