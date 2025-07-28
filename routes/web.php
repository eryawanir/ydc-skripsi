<?php

use App\Enums\UserRole;
use App\Http\Middleware\CheckRole;
use App\Livewire\Admin\ManageUsers;
use App\Livewire\Patients\CreatePatient;
use App\Livewire\Patients\LevenshteinListPatient;
use App\Livewire\Patients\ListPatient;
use App\Livewire\Patients\ShowPatient;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Admin\UserIndex;
use App\Livewire\Dokter\DaftarPeriksa;
use App\Livewire\Manajemen\DokterIndex;
use App\Livewire\Patients\DaftarPeriksaPasien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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

        Route::get('/kelola-akun', ManageUsers::class)->name('users.index');

        Route::prefix('pasien')->name('patient.')->group(function () {
            Route::get('/', ListPatient::class)->name('index');
            Route::get('/pendaftaran', CreatePatient::class)->name('create');
            Route::get('/daftar-periksa', DaftarPeriksaPasien::class)
            ->name('daftar-periksa');
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
        Route::get('/dokters', function () {
            return 'Halaman Manajemen - Role: ' . Auth::user()->role;
        })->name('dokters.index');
    });

// ---------------------- DOKTER AREA ---------------------
Route::prefix('dokter')
    ->middleware(['auth', CheckRole::class . ':' . UserRole::Dokter->value])
    ->name('dokter.')
    ->group(function () {
        Route::prefix('pasien')->name('patient.')->group(function () {
            Route::get('/daftar-periksa', DaftarPeriksa::class)
            ->name('daftar-periksa');
        });
    });

require __DIR__.'/auth.php';
