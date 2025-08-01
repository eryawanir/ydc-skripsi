<?php

use App\Livewire\Patients\CreatePatient;
use App\Livewire\Patients\LevenshteinListPatient;
use App\Livewire\Patients\ListPatient;
use App\Livewire\Patients\ShowPatient;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::prefix('pasien')->name('patient.')->group(function () {
        Route::get('/', ListPatient::class)->name('index');
        Route::get('/pendaftaran', CreatePatient::class)->name('create');
        Route::get('/{patient}', ShowPatient::class)->name('show');
    });

    Route::prefix('levenshtein')->name('levenshtein.')->group(function () {
        Route::get('/cari-pasien', LevenshteinListPatient::class)->name('search');
    });

    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
