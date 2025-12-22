<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register - {{ config('app.name', 'Lost & Found') }}</title>
    {{-- Memuat favicon --}}
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    {{-- Memuat asset Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Body: Font Sans, Teks Hitam, Antialiased --}}
<body class="font-sans text-gray-900 antialiased">
    {{-- Wrapper Halaman Penuh. min-h-screen: Full height. --}}
    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center items-center p-4">
        
        {{-- Card Container. max-w-4xl: Lebar maks 56rem. flex flex-1: Fleksibel mengisi ruang. --}}
        <div class="max-w-4xl m-0 bg-white shadow-lg sm:rounded-lg flex flex-1 overflow-hidden">

            {{-- ======================================================= --}}
            {{-- BAGIAN KIRI (Form Register) --}}
            {{-- ======================================================= --}}
            
            {{-- Kolom Kiri 50% di Desktop --}}
            <div class="lg:w-1/2 xl:w-1/2 p-10 sm:p-12 flex flex-col justify-center">
                
                {{-- Pembungkus untuk menengahkan konten secara vertikal --}}
                <div class="flex flex-col justify-center h-full">
                    {{-- Judul Halaman --}}
                    <div class="text-center">
                        <h1 class="text-2xl xl:text-3xl font-extrabold">
                            Sign Up
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            Ayo, buat akun barumu!
                        </p>
                    </div>

                    {{-- Wrapper Form --}}
                    <div class="w-full mt-8">
                        <div class="mx-auto max-w-xs">
                            
                            {{-- Form Register --}}
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                {{-- Input 1: Nama Lengkap --}}
                                {{-- w-full: Lebar full. bg-gray-100: Background input abu muda. --}}
                                <input id="name"
                                    class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border @error('name') border-red-500 @enderror"
                                    type="text" name="name" value="{{ old('name') }}" required autofocus
                                    placeholder="Nama Lengkap" />
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                {{-- Input 2: Email --}}
                                <input id="email"
                                    class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border mt-4 @error('email') border-red-500 @enderror"
                                    type="email" name="email" value="{{ old('email') }}" required
                                    placeholder="Email" />
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                {{-- Input 3: Password --}}
                                <input id="password"
                                    class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border mt-4 @error('password') border-red-500 @enderror"
                                    type="password" name="password" required autocomplete="new-password"
                                    placeholder="Password" />
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                
                                {{-- Input 4: Konfirmasi Password --}}
                                <input id="password_confirmation"
                                    class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border mt-4"
                                    type="password" name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Konfirmasi Password" />

                                {{-- Tombol Daftar --}}
                                {{-- bg-red-800: Merah tua. hover:bg-red-900: Hover merah lebih gelap. --}}
                                <button type="submit"
                                    class="mt-5 tracking-wide font-semibold bg-red-800 text-gray-100 w-full py-3 rounded-lg hover:bg-red-900 transition duration-200">
                                    Daftar
                                </button>
                            </form>

                            {{-- Pemisah "Atau" --}}
                            <div class="my-6 border-b text-center">
                                <div
                                    class="leading-none px-2 inline-block text-sm text-gray-600 bg-white transform translate-y-1/2">
                                    Atau
                                </div>
                            </div>

                            {{-- Tombol Daftar Google --}}
                            <a href="{{ route('google.redirect') }}"
                                class="w-full font-bold shadow-sm rounded-lg py-3 bg-indigo-100 text-gray-800 flex items-center justify-center hover:bg-indigo-200 transition duration-200">
                                {{-- Icon Google --}}
                                <div class="bg-white p-2 rounded-full">
                                    <svg class="w-4" viewBox="0 0 533.5 544.3">
                                        <path fill="#4285f4"
                                            d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h147c-6.1 33.8-25.7 63.7-54.4 82.7v68h87.7c51.5-47.4 81.1-117.4 81.1-200.2z" />
                                        <path fill="#34a853"
                                            d="M272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-87.7-68c-24.4 16.6-55.9 26-92.6 26-71 0-131.2-47.9-152.8-112.3H28.9v70.1c46.2 91.9 140.3 149.9 243.2 149.9z" />
                                        <path fill="#fbbc04"
                                            d="M119.3 324.3c-11.4-33.8-11.4-70.4 0-104.2V150H28.9c-38.6 76.9-38.6 167.5 0 244.4l90.4-70.1z" />
                                        <path fill="#ea4335"
                                            d="M272.1 107.7c38.8-.6 76.3 14 104.4 40.8l77.7-77.7C405 24.6 339.7-.8 272.1 0 169.2 0 75.1 58 28.9 150l90.4 70.1c21.5-64.5 81.8-112.4 152.8-112.4z" />
                                    </svg>
                                </div>
                                <span class="ml-4">Daftar dengan Google</span>
                            </a>

                            {{-- Footer Link: Masuk --}}
                            <div class="mt-6 text-center text-sm">
                                <p class="text-gray-600">
                                    Sudah punya akun? <a href="{{ route('login') }}"
                                        class="border-b border-gray-500 border-dotted">Masuk</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ======================================================= --}}
            {{-- BAGIAN KANAN (Gambar Ilustrasi) --}}
            {{-- ======================================================= --}}
            {{-- 
                - flex-1: Mengambil sisa ruang.
                - bg-cover bg-center: Gambar background menutupi area & di tengah.
                - hidden lg:flex: Hanya muncul di desktop.
            --}}
            <div class="flex-1 bg-cover bg-center hidden lg:flex rounded-r-lg"
                 style="background-image: url('{{ asset('images/telu.png') }}');">
            </div>

        </div>
    </div>
</body>

</html>

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