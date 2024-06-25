<?php

use App\Http\Controllers\MutasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratJalanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Admin
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/logout', function () {
    Auth::logout();
    return Redirect::to('login');
});

Route::get('/surat', [SuratJalanController::class, 'index'])->name('suratJalan.index');
Route::get('/create', [SuratJalanController::class, 'create'])->name('suratJalan.create');
Route::post('/store', [SuratJalanController::class, 'store'])->name('suratJalan.store');
Route::get('/{suratJalan}', [SuratJalanController::class, 'show'])->name('suratJalan.show');
Route::get('/{suratJalan}/edit', [SuratJalanController::class, 'edit'])->name('suratJalan.edit');
Route::put('/{suratJalan}', [SuratJalanController::class, 'update'])->name('suratJalan.update');
Route::delete('/{suratJalan}', [SuratJalanController::class, 'destroy'])->name('suratJalan.destroy');

Route::resource('mutasi', MutasiController::class);

require __DIR__ . '/auth.php';
require __DIR__ . '/adminauth.php';
