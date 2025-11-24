<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use App\Models\User; // Import User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View; // Import View
use Illuminate\Http\RedirectResponse; // Import RedirectResponse

class LostItemController extends Controller
{
    /**
     * Form create laporan.
     */
    public function create(): View
    {
        return view('lost-items.create');
    }

    /**
     * Simpan laporan baru.
     */
    public function store(Request $request): RedirectResponse
    {
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

        LostItem::create($validated);

        // Redirect sesuai role
        // PERBAIKAN PHPSTAN: Ambil user ke variabel dulu
        $user = Auth::user();

        // Kita asumsikan logic 'role' === 'admin' atau 'is_admin' property ada di model User
        // Kita cek instance User dulu biar propertinya dikenali
        $isAdmin = false;

        if ($user instanceof User) {
            // Menggunakan Null Coalescing Operator (??) untuk properti dinamis
            // PHPStan mungkin complain kalau properti tidak didefinisikan di Model,
            // tapi ini lebih aman daripada langsung akses.
            $role = $user->role ?? null;
            $is_admin = $user->is_admin ?? false;

            if ($role === 'admin' || $is_admin) {
                $isAdmin = true;
            }
        }

        if ($isAdmin) {
            return redirect()
                ->route('admin.reports.index')
                ->with('success', 'Laporan barang hilang berhasil ditambahkan.');
        }

        return redirect()
            ->route('items.index')
            ->with('success', 'Laporan barang hilang berhasil ditambahkan.');
    }

    /**
     * Form edit laporan.
     */
    public function edit(LostItem $lostItem): View
    {
        return view('lost-items.edit', compact('lostItem'));
    }

    /**
     * Update laporan.
     */
    public function update(Request $request, LostItem $lostItem): RedirectResponse
    {
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

        $lostItem->update($validated);

        return redirect()
            ->route('items.index')
            ->with('success', 'Laporan barang hilang berhasil diperbarui.');
    }

    /**
     * Hapus laporan.
     */
    public function destroy(LostItem $lostItem): RedirectResponse
    {
        // (Nanti bisa tambahkan authorization Admin-only)
        $lostItem->delete();

        return redirect()
            ->route('items.index')
            ->with('success', 'Laporan barang hilang berhasil dihapus.');
    }
}
