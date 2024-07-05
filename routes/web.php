<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratJalanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/sejarah/{id}', [HistoryController::class, 'show'])->name('sejarah');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/logout', function () {
    Auth::logout();
    return Redirect::to('login');
});

// Mutasi Routes
Route::get('/mutasi', [MutasiController::class, 'index'])->name('mutasi.index');
Route::get('/mutasi/create', [MutasiController::class, 'create'])->name('mutasi.create');
Route::post('/mutasi', [MutasiController::class, 'store'])->name('mutasi.store');
Route::get('/mutasi/{mutasi}', [MutasiController::class, 'show'])->name('mutasi.show');
Route::get('/mutasi/{mutasi}/edit', [MutasiController::class, 'edit'])->name('mutasi.edit');
Route::put('/mutasi/{mutasi}', [MutasiController::class, 'update'])->name('mutasi.update');
Route::delete('/mutasi/{mutasi}', [MutasiController::class, 'destroy'])->name('mutasi.destroy');

// Surat Jalan Routes
Route::get('/surat', [SuratJalanController::class, 'index'])->name('suratJalan.index');
Route::get('/surat/create', [SuratJalanController::class, 'create'])->name('suratJalan.create');
Route::post('/surat/store', [SuratJalanController::class, 'store'])->name('suratJalan.store');
Route::get('/surat/{suratJalan}', [SuratJalanController::class, 'show'])->name('suratJalan.show');
Route::get('/surat/{suratJalan}/edit', [SuratJalanController::class, 'edit'])->name('suratJalan.edit');
Route::put('/surat/{suratJalan}', [SuratJalanController::class, 'update'])->name('suratJalan.update');
Route::delete('/surat/{suratJalan}', [SuratJalanController::class, 'destroy'])->name('suratJalan.destroy');


require __DIR__ . '/auth.php';
