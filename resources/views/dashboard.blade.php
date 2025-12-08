{{-- 
    Wrapper Utama Layout Aplikasi.
    <x-app-layout> adalah komponen Blade yang memuat struktur dasar HTML (head, body, navbar, dll).
--}}
<x-app-layout>
    
    {{-- 
        Slot Header.
        Digunakan untuk memasukkan konten ke bagian header layout yang sudah disediakan.
    --}}
    <x-slot name="header">
        {{-- 
            Judul Halaman Dashboard.
            - font-semibold: Ketebalan font 600 (agak tebal).
            - text-xl: Ukuran font extra large (1.25rem / 20px).
            - text-gray-800: Warna teks abu-abu gelap.
            - leading-tight: Jarak antar baris rapat (line-height: 1.25).
            {{ __('Dashboard') }}: Fungsi lokalisasi Laravel untuk menampilkan teks "Dashboard".
        --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- 
        Container Utama Halaman.
        - py-12: Padding vertikal (atas dan bawah) sebesar 3rem (48px). Memberi jarak dari header.
    --}}
    <div class="py-12">
        
        {{-- 
            Wrapper Konten Terpusat.
            - max-w-7xl: Lebar maksimum konten dibatasi hingga 80rem (1280px).
            - mx-auto: Margin kiri dan kanan otomatis (membuat konten rata tengah horizontal).
            - sm:px-6: Pada layar kecil (small) ke atas, beri padding horizontal 1.5rem (24px).
            - lg:px-8: Pada layar besar (large) ke atas, beri padding horizontal 2rem (32px).
        --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- 
                Kartu Konten (Card).
                - bg-white: Warna latar belakang putih.
                - overflow-hidden: Menyembunyikan konten yang keluar dari batas elemen (berguna untuk border-radius).
                - shadow-sm: Memberikan efek bayangan tipis (small shadow) di sekeliling elemen.
                - sm:rounded-lg: Pada layar small ke atas, sudut elemen dibuat membulat (large radius: 0.5rem).
            --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                {{-- 
                    Isi Konten Kartu.
                    - p-6: Padding di semua sisi sebesar 1.5rem (24px).
                    - text-gray-900: Warna teks abu-abu sangat gelap (hampir hitam).
                --}}
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }} {{-- Pesan status login --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- ========================================================================================= --}}
{{--                    PANDUAN PENGUBAHAN GAYA (CUSTOMIZATION GUIDE)                          --}}
{{-- ========================================================================================= --}}
{{-- 
    1. MENGUBAH WARNA (Background & Text)
       Format: 'bg-{warna}-{intensitas}' atau 'text-{warna}-{intensitas}'
       Contoh:
       - 'bg-red-800' (Merah Tua)    -> Ubah ke 'bg-blue-600' (Biru Sedang) atau 'bg-green-500' (Hijau)
       - 'text-white' (Putih)         -> Ubah ke 'text-black' (Hitam) atau 'text-gray-200' (Abu Terang)
       
       CATATAN PENTING:
       - Jika Anda mengubah 'bg-white' menjadi 'blue', itu TIDAK AKAN BERJALAN.
       - Anda harus spesifik: 'bg-blue-500' (standar).
       - Angka intensitas: 
         50 (paling terang), 100, 200, 300, 400, 500 (standar), 600, 700, 800, 900 (paling gelap).
       - Jika angka tidak cocok (misal 'bg-blue-333'), class tersebut tidak akan dikenali dan warnanya hilang.

    2. MENGUBAH UKURAN TEXT
       Format: 'text-{ukuran}'
       Pilihan:
       - 'text-xs'   (Sangat Kecil)
       - 'text-sm'   (Kecil)
       - 'text-base' (Normal/Standar)
       - 'text-lg'   (Besar)
       - 'text-xl'   (Lebih Besar)
       - 'text-2xl' s/d 'text-9xl' (Sangat Besar untuk Judul)

    3. MENGUBAH JARAK (Margin & Padding)
       - Margin (Jarak Luar): 'm-{ukuran}' (semua sisi), 'my-{ukuran}' (atas-bawah), 'mx-{ukuran}' (kiri-kanan)
       - Padding (Jarak Dalam): 'p-{ukuran}' (sama seperti margin formatnya)
       Contoh:
       - 'mb-4' (Margin Bawah level 4) -> Ubah ke 'mb-8' (lebih jauh) atau 'mb-2' (lebih dekat).
       - Skala ukuran Tailwind: 0, 1, 2, 4, 8, 12, 16, 20, dll.
--}}
{{-- ========================================================================================= --}}
