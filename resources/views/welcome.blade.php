@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    {{-- ===================================================================== --}}
    {{-- HERO SECTION (DENGAN EFEK ASAP CSS & GLASS) --}}
    {{-- ===================================================================== --}}
    <section class="relative h-screen flex items-center justify-center text-center text-white overflow-hidden">

        {{-- Background Image --}}
        <div class="absolute inset-0 z-0">
            {{-- Menggunakan asset lokal agar aman dari CSP --}}
            <img src="{{ asset('images/telu.png') }}" class="w-full h-full object-cover transform scale-105"
                alt="Background Kampus">
            {{-- Gradient Overlay (Lebih Dramatis) --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-red-900/60 to-black/90"></div>
        </div>

        {{-- EFEK ASAP (FOG ANIMATION) - MENGGUNAKAN CSS MURNI (Fix Error CSP Image) --}}
        <div class="absolute inset-0 z-0 opacity-40 pointer-events-none overflow-hidden">
            {{-- Mengganti gambar eksternal dengan elemen CSS bergerak --}}
            <div
                class="fog-layer absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent w-[200%] animate-fog">
            </div>
        </div>

        {{-- Konten Hero --}}
        <div class="relative z-10 max-w-5xl px-6 flex flex-col items-center">

            {{-- ALERT LOGIN (GLASS STYLE) --}}
            @if (session('sumber_login') == 'whatsapp')
                <div
                    class="animate-bounce mb-8 bg-white/10 backdrop-blur-xl border border-white/20 p-4 rounded-2xl text-left shadow-[0_8px_32px_0_rgba(31,38,135,0.37)] flex items-center gap-4 max-w-lg mx-auto ring-1 ring-white/30">
                    <div class="bg-green-500/80 p-2 rounded-full text-white shadow-lg backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg text-white drop-shadow-md">Login Berhasil!</h4>
                        <p class="text-sm text-gray-200">Akun terhubung. Silakan kembali ke WhatsApp.</p>
                    </div>
                    <a href="https://wa.me/{{ env('NOMOR_WA_BOT') }}?text=Saya%20sudah%20login"
                        class="ml-auto bg-green-600/90 hover:bg-green-500 text-white text-sm font-bold px-5 py-2 rounded-lg transition shadow-lg hover:shadow-green-500/50 transform hover:-translate-y-1 backdrop-blur-md">
                        Buka WA
                    </a>
                </div>
                @php session()->forget('sumber_login'); @endphp
            @endif

            {{-- Badge Kapsul --}}
            <span
                class="mb-6 inline-block py-2 px-5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs md:text-sm font-bold tracking-widest uppercase text-red-200 shadow-lg animate-fadeIn">
                Lost & Found System
            </span>

            {{-- Judul Besar --}}
            <h1 class="text-5xl md:text-8xl font-black mb-6 leading-tight drop-shadow-2xl tracking-tight animate-fadeIn">
                Temukan <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 via-orange-300 to-yellow-200">Barangmu</span>
                <br> Kembali Disini
            </h1>

            {{-- Deskripsi --}}
            <p
                class="text-lg md:text-2xl text-gray-200 mb-12 max-w-3xl mx-auto leading-relaxed font-light drop-shadow-lg animate-fadeIn delay-100">
                Solusi cerdas dan terpusat untuk melaporkan kehilangan atau penemuan barang di lingkungan kampus. <span
                    class="font-semibold text-white">Cepat, Aman, dan Terpercaya.</span>
            </p>

            {{-- Tombol Glass & Glow --}}
            <div class="flex flex-col sm:flex-row gap-6 w-full justify-center animate-fadeIn delay-200">

                {{-- Tombol Utama (Hanya Satu Saja Sesuai Request) --}}
                <a href="{{ route('items.index') }}"
                    class="group relative px-12 py-5 bg-red-600/80 backdrop-blur-md rounded-full font-bold text-xl text-white shadow-[0_0_20px_rgba(220,38,38,0.5)] overflow-hidden transition-all hover:bg-red-600 hover:scale-105 hover:shadow-[0_0_40px_rgba(220,38,38,0.8)] border border-red-500/50">
                    {{-- Efek Kilau Lewat --}}
                    <div
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-shimmer">
                    </div>
                    <span class="relative z-10 flex items-center justify-center gap-3">
                        Cari Barang Sekarang
                    </span>
                </a>

            </div>
        </div>

        {{-- Scroll Down Indicator --}}
        <div class="absolute bottom-8 animate-bounce z-10">
            <svg class="w-8 h-8 text-white/70 drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>


    {{-- ===================================================================== --}}
    {{-- FEATURE SECTION --}}
    {{-- ===================================================================== --}}
    <section id="features" class="py-24 bg-gray-50 relative overflow-hidden">
        {{-- Decorative Blobs (Background Blur) --}}
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-red-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-yellow-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-32 left-20 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-20 max-w-3xl mx-auto">
                {{-- REVISI: Font Size Diperbesar (text-lg) --}}
                <h2 class="text-red-600 font-bold tracking-widest uppercase text-lg mb-3">Kenapa Memilih Kami?</h2>
                <h3 class="text-4xl md:text-5xl font-black text-gray-900 leading-tight">Solusi Terbaik untuk <br> <span
                        class="relative inline-block">Barang Hilangmu <div
                            class="absolute bottom-1 left-0 w-full h-3 bg-red-200/50 -z-10 transform -rotate-1"></div>
                        </span></h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                {{-- Feature 1 --}}
                <div
                    class="group bg-white p-10 rounded-[2rem] shadow-xl hover:shadow-2xl hover:-translate-y-3 transition-all duration-500 border border-gray-100 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-150 duration-700">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-700 rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-red-500/30 group-hover:rotate-6 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-red-700 transition-colors">
                            Real-Time & Cepat</h4>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            Laporan langsung dipublikasikan detik itu juga. Memperbesar peluang barangmu kembali dengan
                            segera.
                        </p>
                    </div>
                </div>

                {{-- Feature 2 --}}
                <div
                    class="group bg-white p-10 rounded-[2rem] shadow-xl hover:shadow-2xl hover:-translate-y-3 transition-all duration-500 border border-gray-100 relative overflow-hidden delay-100">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-150 duration-700">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-orange-400 to-red-500 rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-orange-500/30 group-hover:rotate-6 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-orange-600 transition-colors">
                            Mudah Diakses</h4>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            Antarmuka yang ramah pengguna. Login, laporkan, dan pantau status barangmu semudah membuka media
                            sosial.
                        </p>
                    </div>
                </div>

                {{-- Feature 3 --}}
                <div
                    class="group bg-white p-10 rounded-[2rem] shadow-xl hover:shadow-2xl hover:-translate-y-3 transition-all duration-500 border border-gray-100 relative overflow-hidden delay-200">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-yellow-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-150 duration-700">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-yellow-500/30 group-hover:rotate-6 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-yellow-600 transition-colors">Aman
                            & Terverifikasi</h4>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            Setiap laporan diverifikasi. Sistem kami memastikan keamanan data dan validitas informasi yang
                            beredar.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ===================================================================== --}}
    {{-- STATS SECTION (REVISI: HAPUS TEKS, TAMBAH LOGO) --}}
    {{-- ===================================================================== --}}
    {{-- Fix CSP: Ganti background image eksternal dengan CSS Pattern --}}
    <section class="py-24 bg-red-900 text-white relative">
        {{-- Pola Background CSS (Aman CSP) --}}
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;">
        </div>

        <div class="absolute inset-0 bg-gradient-to-r from-red-900/90 to-red-800/90"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black drop-shadow-md">Dampak Nyata Kami</h2>
                <p class="text-red-200 mt-4 text-xl">Membantu mahasiswa menemukan kembali barang berharga mereka.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                {{-- Stat 1 (Barang Ditemukan) --}}
                <div
                    class="group bg-white/5 backdrop-blur-md border border-white/10 p-10 rounded-[2.5rem] text-center transform transition hover:scale-105 hover:bg-white/10 hover:shadow-[0_0_40px_rgba(255,255,255,0.1)] flex flex-col items-center">

                    {{-- REVISI: Tambah Logo/Icon --}}
                    <div
                        class="w-20 h-20 mb-6 bg-yellow-500/20 rounded-full flex items-center justify-center group-hover:bg-yellow-500/30 transition-all">
                        <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <div
                        class="text-7xl font-black mb-4 text-transparent bg-clip-text bg-gradient-to-b from-yellow-300 to-yellow-500 drop-shadow-sm">
                        {{ \App\Models\FoundItem::count() }}</div>
                    <div class="text-2xl font-bold tracking-wide mb-2">Barang Ditemukan</div>
                    {{-- REVISI: Teks "Siap Diambil" dihapus --}}
                </div>

                {{-- Stat 2 (Laporan Kehilangan) --}}
                <div
                    class="group bg-white/5 backdrop-blur-md border border-white/10 p-10 rounded-[2.5rem] text-center transform transition hover:scale-105 hover:bg-white/10 hover:shadow-[0_0_40px_rgba(255,255,255,0.1)] flex flex-col items-center">

                    {{-- REVISI: Tambah Logo/Icon --}}
                    <div
                        class="w-20 h-20 mb-6 bg-red-500/20 rounded-full flex items-center justify-center group-hover:bg-red-500/30 transition-all">
                        <svg class="w-10 h-10 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <div
                        class="text-7xl font-black mb-4 text-transparent bg-clip-text bg-gradient-to-b from-red-300 to-red-500 drop-shadow-sm">
                        {{ \App\Models\LostItem::count() }}</div>
                    <div class="text-2xl font-bold tracking-wide mb-2">Laporan Kehilangan</div>
                    {{-- REVISI: Teks "Sedang Dicari" dihapus --}}
                </div>
            </div>
        </div>
    </section>


    {{-- ===================================================================== --}}
    {{-- FAQ SECTION --}}
    {{-- ===================================================================== --}}
    <section class="bg-white py-24">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16">
                {{-- REVISI: Font Size Diperbesar (text-xl) --}}
                <span class="text-red-600 font-bold tracking-widest uppercase text-xl">Pusat Bantuan</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mt-2">Pertanyaan Umum</h2>
            </div>

            <div class="space-y-6">
                @foreach ([['Apa itu Lost & Found Kampus?', 'Platform digital terpusat yang dirancang khusus untuk memfasilitasi pelaporan dan penemuan barang hilang di lingkungan kampus secara efisien.'], ['Bagaimana prosedur mengambil barang?', 'Jika barang Anda ada di daftar "Ditemukan", segera hubungi kontak yang tertera atau datang ke pos keamanan dengan membawa bukti kepemilikan.'], ['Apakah layanan ini gratis?', 'Ya, layanan ini 100% gratis untuk seluruh civitas akademika kampus.'], ['Berapa lama barang disimpan?', 'Barang temuan akan disimpan di pos keamanan selama maksimal 3 bulan sebelum didonasikan jika tidak ada yang mengambil.']] as $index => $faq)
                    <div
                        class="group border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:border-red-100">
                        <button
                            class="faq-toggle w-full px-8 py-6 bg-white flex justify-between items-center text-left focus:outline-none">
                            <span
                                class="font-bold text-gray-800 text-lg group-hover:text-red-700 transition-colors">{{ $faq[0] }}</span>
                            <div
                                class="p-3 bg-red-50 rounded-full transition-all duration-300 transform faq-icon group-hover:bg-red-100">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out bg-white">
                            <div class="px-8 pb-8 pt-0 text-gray-600 leading-relaxed text-lg">
                                {{ $faq[1] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Script untuk FAQ --}}
    {{-- FIX: Menambahkan nonce agar script diizinkan oleh CSP --}}
    <script nonce="{{ $csp_nonce ?? '' }}">
        document.querySelectorAll('.faq-toggle').forEach(btn => {
            btn.addEventListener('click', () => {
                const answer = btn.nextElementSibling;
                const icon = btn.querySelector('.faq-icon');

                // Toggle height
                if (answer.style.maxHeight) {
                    answer.style.maxHeight = null;
                    icon.classList.remove('rotate-180', 'bg-red-600', 'text-white');
                    icon.classList.add('bg-red-50', 'text-red-600');
                } else {
                    // Close other open FAQs
                    document.querySelectorAll('.faq-answer').forEach(el => el.style.maxHeight = null);
                    document.querySelectorAll('.faq-icon').forEach(el => {
                        el.classList.remove('rotate-180', 'bg-red-600', 'text-white');
                        el.classList.add('bg-red-50', 'text-red-600');
                    });

                    answer.style.maxHeight = answer.scrollHeight + "px";
                    icon.classList.add('rotate-180', 'bg-red-600', 'text-white');
                    icon.classList.remove('bg-red-50', 'text-red-600');
                }
            });
        });
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
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

    {{-- Tambahan Animasi Tailwind Custom --}}
    <style>
        /* Animasi Asap CSS Murni (Tanpa Gambar Eksternal - Aman CSP) */
        .fog-layer {
            mask-image: linear-gradient(to bottom, transparent, black, transparent);
            -webkit-mask-image: linear-gradient(to bottom, transparent, black, transparent);
        }

        @keyframes fog {
            0% {
                transform: translateX(0);
                opacity: 0.4;
            }

            50% {
                opacity: 0.6;
            }

            100% {
                transform: translateX(-50%);
                opacity: 0.4;
            }
        }

        .animate-fog {
            /* Membuat efek bergerak menyamping */
            animation: fog 20s linear infinite;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.2) 25%, transparent 50%, rgba(255, 255, 255, 0.2) 75%, transparent 100%);
            background-size: 200% 100%;
        }

        /* Animasi Blob */
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 10s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Animasi Fade In */
        .animate-fadeIn {
            animation: fadeIn 1.2s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animasi Shimmer (Kilau di Tombol) */
        @keyframes shimmer {
            100% {
                transform: translateX(100%);
            }
        }

        .animate-shimmer {
            animation: shimmer 2s infinite;
        }
    </style>

@endsection
