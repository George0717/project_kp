<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratJalanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminMutasiController;
use App\Http\Controllers\AdminSuratJalanController;
use App\Http\Controllers\AdminSuratJalanControllerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LogController;

Route::get('/', function () {
    return response()->view('auth.login')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
});
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/password/reset', [PasswordResetController::class, 'requestForm'])->name('password.request.custom');
Route::post('/password/reset', [PasswordResetController::class, 'sendResetTokenViaWhatsApp'])->name('password.email.custom');
Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset.custom');
Route::post('/password/reset/confirm', [PasswordResetController::class, 'reset'])->name('password.update.custom');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard.index');
Route::get('/dashboard/filter', [DashboardController::class, 'filterData'])->name('dashboard.filter');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/store', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/logs', [LogController::class, 'index'])->name('admin.logs.index');
    Route::get('/admin/logs/{log}', [LogController::class, 'show'])->name('admin.logs.show');
    Route::post('/admin/logs/{log}/restore', [LogController::class, 'restore'])->name('admin.logs.restore');

});

// Admin Routes for Surat Jalan
Route::middleware(['auth', 'admin', 'log.crud'])->prefix('admin')->group(function () {
    Route::get('/admin/surat', [AdminSuratJalanController::class, 'index'])->name('admin.suratJalan.index');
    Route::get('/admin/surat/create', [AdminSuratJalanController::class, 'create'])->name('admin.suratJalan.create');
    Route::post('/admin/surat/store', [AdminSuratJalanController::class, 'store'])->name('admin.suratJalan.store');
    Route::get('/admin/surat/{suratJalan}', [AdminSuratJalanController::class, 'show'])->name('admin.suratJalan.show');
    Route::get('/admin/surat/{suratJalan}/edit', [AdminSuratJalanController::class, 'edit'])->name('admin.suratJalan.edit');
    Route::put('/admin/surat/{suratJalan}', [AdminSuratJalanController::class, 'update'])->name('admin.suratJalan.update');
    Route::delete('/admin/surat/{suratJalan}', [AdminSuratJalanController::class, 'destroy'])->name('admin.suratJalan.destroy');
});

// Admin Routes for Mutasi
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/mutasi', [AdminMutasiController::class, 'index'])->name('admin.mutasi.index');
    Route::get('/mutasi/create', [AdminMutasiController::class, 'create'])->name('admin.mutasi.create');
    Route::post('/mutasi', [AdminMutasiController::class, 'store'])->name('admin.mutasi.store');
    Route::get('/mutasi/{mutasi}', [AdminMutasiController::class, 'show'])->name('admin.mutasi.show');
    Route::get('/mutasi/{mutasi}/edit', [AdminMutasiController::class, 'edit'])->name('admin.mutasi.edit');
    Route::put('/mutasi/{mutasi}', [AdminMutasiController::class, 'update'])->name('admin.mutasi.update');
    Route::delete('/mutasi/{mutasi}', [AdminMutasiController::class, 'destroy'])->name('admin.mutasi.destroy');

});



Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
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
