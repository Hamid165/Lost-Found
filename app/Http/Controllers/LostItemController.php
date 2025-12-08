<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use App\Models\User; // Import Model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View; // Import View
use Illuminate\Http\RedirectResponse; // Import RedirectResponse

/**
 * Class LostItemController
 *
 * Controller ini menangani manajemen data "Barang Hilang" (Lost Items).
 * Termasuk menampilkan form, menyimpan data baru, mengedit, dan menghapus data.
 */
class LostItemController extends Controller
{
    /**
     * Menampilkan halaman form untuk membuat laporan kehilangan barang baru.
     *
     * @return \Illuminate\View\View
     * Mengembalikan view 'lost-items.create'.
     */
    public function create(): View
    {
        return view('lost-items.create');
    }

    /**
     * Menyimpan data laporan barang hilang yang baru ke dalam database.
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
        // Menambahkan validasi regex untuk mencegah XSS (menolak karakter < dan >).
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255|regex:/^[^<>]*$/',
            'deskripsi' => 'required|string',
            'lokasi_terakhir' => 'required|string|max:255|regex:/^[^<>]*$/',
            'tanggal_kehilangan' => 'required|date',
            'nama_pelapor' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'status_pelapor' => 'required|string|in:Mahasiswa,Dosen,Lainnya',
            'NIM_NIP' => 'nullable|string|max:100',
        ], [
            // Custom Error Messages
            'nama_barang.regex' => 'Nama barang tidak boleh mengandung karakter HTML (< atau >).',
            'lokasi_terakhir.regex' => 'Lokasi tidak boleh mengandung karakter HTML (< atau >).',
        ]);

        // 2. Simpan Data ke Database
        LostItem::create($validated);

        // 3. Pengecekan Role User untuk Redirect
        // Mengambil user yang sedang login
        $user = Auth::user();
        $isAdmin = false;

        // Cek apakah user valid dan memiliki role/property admin
        if ($user instanceof User) {
            // Menggunakan Null Coalescing Operator (??) untuk menangani jika properti tidak ada
            // Ini untuk kompatibilitas jika kolom 'role' atau 'is_admin' belum ditambahkan di database
            $role = $user->role ?? null;
            $is_admin = $user->is_admin ?? false;

            // Jika role adalah 'admin' atau is_admin bernilai true
            if ($role === 'admin' || $is_admin) {
                $isAdmin = true;
            }
        }

        // Jika Admin, redirect ke dashboard admin
        if ($isAdmin) {
            return redirect()
                ->route('admin.reports.index')
                ->with('success', 'Laporan barang hilang berhasil ditambahkan.');
        }

        // Jika User Biasa, redirect ke halaman publik
        return redirect()
            ->route('items.index')
            ->with('success', 'Laporan barang hilang berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit laporan barang hilang yang sudah ada.
     *
     * @param  \App\Models\LostItem  $lostItem
     * Model Binding otomatis mencari item berdasarkan ID/UUID.
     *
     * @return \Illuminate\View\View
     * Mengembalikan view 'lost-items.edit'.
     */
    public function edit(LostItem $lostItem): View
    {
        return view('lost-items.edit', compact('lostItem'));
    }

    /**
     * Memperbarui data laporan barang hilang di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * Data input baru.
     *
     * @param  \App\Models\LostItem  $lostItem
     * Item lama yang akan diupdate.
     *
     * @return \Illuminate\Http\RedirectResponse
     * Redirect kembali ke index.
     */
    public function update(Request $request, LostItem $lostItem): RedirectResponse
    {
        // 1. Validasi Input (Sama dengan store)
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255|regex:/^[^<>]*$/',
            'deskripsi' => 'required|string',
            'lokasi_terakhir' => 'required|string|max:255|regex:/^[^<>]*$/',
            'tanggal_kehilangan' => 'required|date',
            'nama_pelapor' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'status_pelapor' => 'required|string|in:Mahasiswa,Dosen,Lainnya',
            'NIM_NIP' => 'nullable|string|max:100',
        ], [
            'nama_barang.regex' => 'Nama barang tidak boleh mengandung karakter HTML (< atau >).',
            'lokasi_terakhir.regex' => 'Lokasi tidak boleh mengandung karakter HTML (< atau >).',
        ]);

        // 2. Update Data
        $lostItem->update($validated);

        // 3. Redirect
        return redirect()
            ->route('items.index')
            ->with('success', 'Laporan barang hilang berhasil diperbarui.');
    }

    /**
     * Menghapus laporan barang hilang dari database.
     *
     * @param  \App\Models\LostItem  $lostItem
     * Item yang akan dihapus.
     *
     * @return \Illuminate\Http\RedirectResponse
     * Redirect dengan pesan sukses.
     */
    public function destroy(LostItem $lostItem): RedirectResponse
    {
        // TODO: Tambahkan validasi otorisasi agar hanya pemilik/admin yang bisa menghapus
        
        // Hapus data
        $lostItem->delete();

        return redirect()
            ->route('items.index')
            ->with('success', 'Laporan barang hilang berhasil dihapus.');
    }
}
