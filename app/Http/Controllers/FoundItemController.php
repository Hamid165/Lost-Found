<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use App\Models\User; // Mengimpor Model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View; // Mengimpor View
use Illuminate\Http\RedirectResponse; // Mengimpor RedirectResponse

/**
 * Class FoundItemController
 *
 * Controller ini menangani manajemen data "Barang Ditemukan" (Found Items).
 * Termasuk menampilkan form, menyimpan data baru, mengedit, dan menghapus data.
 */
class FoundItemController extends Controller
{
    /**
     * Menampilkan halaman form untuk membuat laporan penemuan barang baru.
     *
     * @return \Illuminate\View\View
     * Mengembalikan view 'found-items.create'.
     */
    public function create(): View
    {
        return view('found-items.create');
    }

    /**
     * Menyimpan data laporan barang ditemukan yang baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * Object Request yang berisi input dari form.
     *
     * @return \Illuminate\Http\RedirectResponse
     * Mengalihkan pengguna kembali ke halaman index atau dashboard dengan pesan sukses.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Input
        // Memastikan semua data yang dikirim sesuai dengan aturan yang ditetapkan.
        $request->validate([
            'nama_barang' => 'required|string|max:255', // Wajib, string, maks 255 karakter
            'deskripsi' => 'required|string', // Wajib, teks panjang
            'lokasi_penemuan' => 'required|string|max:255', // Wajib
            'tanggal_penemuan' => 'required|date', // Wajib, format tanggal valid
            'nama_pelapor' => 'required|string|max:255', // Wajib
            'no_telp' => 'nullable|string|max:20', // Opsional, maks 20 karakter
            'status_pelapor' => 'required|string|in:Mahasiswa,Dosen,Lainnya', // Wajib, pilihan terbatas
            'NIM_NIP' => 'nullable|string|max:100', // Opsional
        ]);

        // 2. Simpan Data ke Database
        // Menggunakan Mass Assignment untuk membuat record baru.
        FoundItem::create($request->all());

        // 3. Pengecekan Otorisasi & Redirect
        // Mengambil user yang sedang login
        $user = Auth::user();

        // Cek apakah user login DAN apakah user tersebut admin
        // 'instanceof User' untuk type safety (memastikan $user adalah Model User, bukan null/interface lain)
        if ($user instanceof User && $user->isAdmin()) {
            return redirect()->route('admin.reports.index')->with('success', 'Laporan barang ditemukan berhasil ditambahkan.');
        }

        // Jika user biasa, redirect ke halaman publik
        return redirect()->route('items.index')->with('success', 'Laporan barang ditemukan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit laporan barang ditemukan yang sudah ada.
     *
     * @param  \App\Models\FoundItem  $foundItem
     * Model Binding akan otomatis mencari item berdasarkan ID/UUID.
     *
     * @return \Illuminate\View\View
     * Mengembalikan view 'found-items.edit' dengan data item.
     */
    public function edit(FoundItem $foundItem): View
    {
        return view('found-items.edit', compact('foundItem'));
    }

    /**
     * Memperbarui data laporan barang ditemukan di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * Data input baru dari form.
     *
     * @param  \App\Models\FoundItem  $foundItem
     * Data item lama yang akan diupdate.
     *
     * @return \Illuminate\Http\RedirectResponse
     * Redirect kembali ke index dengan pesan sukses.
     */
    public function update(Request $request, FoundItem $foundItem): RedirectResponse
    {
        // 1. Validasi Input (Aturan sama dengan store)
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi_penemuan' => 'required|string|max:255',
            'tanggal_penemuan' => 'required|date',
            'nama_pelapor' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'status_pelapor' => 'required|string|in:Mahasiswa,Dosen,Lainnya',
            'NIM_NIP' => 'nullable|string|max:100',
        ]);

        // 2. Update Data
        // Mengubah data di database dengan data baru dari request
        $foundItem->update($request->all());

        // 3. Redirect
        return redirect()->route('items.index')->with('success', 'Laporan barang ditemukan berhasil diperbarui.');
    }

    /**
     * Menghapus laporan barang ditemukan dari database.
     *
     * @param  \App\Models\FoundItem  $foundItem
     * Item yang akan dihapus.
     *
     * @return \Illuminate\Http\RedirectResponse
     * Redirect dengan pesan sukses.
     */
    public function destroy(FoundItem $foundItem): RedirectResponse
    {
        // TODO: Otorisasi tambahan bisa ditambahkan di sini jika perlu
        
        // Hapus data dari database
        $foundItem->delete();

        return redirect()->route('items.index')->with('success', 'Laporan barang ditemukan berhasil dihapus.');
    }
}