<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;

// == RUTE PUBLIK ==
Route::get('/', function () {
    return view('welcome');
});
Route::get('/barang', [ItemController::class, 'index'])->name('items.index');


// == RUTE ADMIN (Wajib Login & Role Admin) ==
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.') 
    ->group(function () {

    // Rute Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Tambahkan semua route untuk manajemen laporan di sini
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Rute untuk Laporan Hilang
    Route::get('/reports/lost/{item}/edit', [ReportController::class, 'editLostItem'])->name('reports.lost.edit');
    Route::patch('/reports/lost/{item}', [ReportController::class, 'updateLostItem'])->name('reports.lost.update');
    Route::delete('/reports/lost/{item}', [ReportController::class, 'destroyLostItem'])->name('reports.lost.destroy');

    // Rute untuk Laporan Ditemukan
    Route::get('/reports/found/{item}/edit', [ReportController::class, 'editFoundItem'])->name('reports.found.edit');
    Route::patch('/reports/found/{item}', [ReportController::class, 'updateFoundItem'])->name('reports.found.update');
    Route::delete('/reports/found/{item}', [ReportController::class, 'destroyFoundItem'])->name('reports.found.destroy');
});


// == RUTE KHUSUS PENGGUNA (Wajib Login) ==
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('items.index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/laporan', function () { return view('report'); })->name('report.index');
    Route::resource('lost-items', LostItemController::class)->except(['index', 'show']);
    Route::resource('found-items', FoundItemController::class)->except(['index', 'show']);
});


// == RUTE AUTENTIKASI GOOGLE ==
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');


// == RUTE AUTENTIKASI BAWAAN BREEZE ==
require __DIR__.'/auth.php';
