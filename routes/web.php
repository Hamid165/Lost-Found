<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;

// == RUTE PUBLIK ==
Route::get('/', function () {
    return view('welcome');
});
Route::get('/barang', [ItemController::class, 'index'])->name('items.index');

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

// == RUTE AUTENTIKASI GOOGLE (TAMBAHKAN BLOK INI) ==
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// == RUTE AUTENTIKASI BAWAAN BREEZE ==
require __DIR__.'/auth.php';
