<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WhatsappWebhookController;
use App\Http\Controllers\WaAuthController;
use Illuminate\Support\Facades\Route;

// == RUTE PUBLIK ==
Route::get('/', function () {
    return view('welcome');
});

// Tambahkan Route ini:
// Ganti dengan ini di routes/web.php:
Route::get('/masuk-dari-wa', [WaAuthController::class, 'connect'])
    ->middleware('auth')
    ->name('login.from.wa');

Route::get('/barang', [ItemController::class, 'index'])->name('items.index');

Route::post('/webhook/whatsapp', [WhatsappWebhookController::class, 'handle'])->name('wa.webhook');

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
        Route::get('/reports/lost/{lostItem:uuid}/edit', [ReportController::class, 'editLostItem'])->name('reports.lost.edit');
        Route::patch('/reports/lost/{lostItem:uuid}', [ReportController::class, 'updateLostItem'])->name('reports.lost.update');
        Route::delete('/reports/lost/{lostItem:uuid}', [ReportController::class, 'destroyLostItem'])->name('reports.lost.destroy');
        Route::get('/barang/hilang/{lostItem:uuid}', [ItemController::class, 'showLost'])->name('items.show.lost');

        // Rute untuk Laporan Ditemukan
        Route::get('/reports/found/{foundItem:uuid}/edit', [ReportController::class, 'editFoundItem'])->name('reports.found.edit');
        Route::patch('/reports/found/{foundItem:uuid}', [ReportController::class, 'updateFoundItem'])->name('reports.found.update');
        Route::delete('/reports/found/{foundItem:uuid}', [ReportController::class, 'destroyFoundItem'])->name('reports.found.destroy');
        Route::get('/barang/ditemukan/{foundItem:uuid}', [ItemController::class, 'showFound'])->name('items.show.found');

        Route::get('/reports/lost/{lostItem:uuid}', [ReportController::class, 'showLostItem'])->name('reports.lost.show');
        Route::get('/reports/found/{foundItem:uuid}', [ReportController::class, 'showFoundItem'])->name('reports.found.show');
    });

// == RUTE KHUSUS PENGGUNA (Wajib Login & Email Terverifikasi) ==
// Perubahan di baris bawah ini: Menambahkan 'verified'
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('items.index');
    })->name('dashboard');
    // Ini link yang diklik user dari WA
    Route::get('/connect-wa', [WaAuthController::class, 'connect'])->middleware('auth')->name('wa.auth.link');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/laporan', function () {
        return view('report');
    })->name('report.index');
    Route::resource('lost-items', LostItemController::class)->except(['index', 'show']);
    Route::resource('found-items', FoundItemController::class)->except(['index', 'show']);
    Route::get('/barang/hilang/{lostItem:uuid}', [ItemController::class, 'showLost'])->name('items.show.lost');
    Route::get('/barang/ditemukan/{foundItem:uuid}', [ItemController::class, 'showFound'])->name('items.show.found');
});

// == RUTE AUTENTIKASI GOOGLE ==
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::get('/tes-error', function () {
    throw new Exception('Ini adalah tes untuk error 500.');
});

// == RUTE AUTENTIKASI BAWAAN BREEZE ==
require __DIR__ . '/auth.php';