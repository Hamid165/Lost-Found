<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Token CSRF untuk keamanan form Ajax jika ada --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - {{ config('app.name', 'Lost & Found') }}</title>
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    {{-- Memuat asset CSS & JS via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- 
    Body Element.
    - font-sans: Menggunakan font default sans-serif (Inter/Nunito).
    - text-gray-900: Warna teks hampir hitam.
    - antialiased: Membuat font lebih halus.
--}}
<body class="font-sans text-gray-900 antialiased">
    
    {{-- 
        Wrapper Utama.
        - min-h-screen: Tinggi minimal 100vh.
        - bg-gray-100: Background abu muda.
        - flex justify-center items-center: Flexbox untuk menengahkan konten (card) di tengah layar.
        - p-4: Padding 1rem di semua sisi (agar tidak mentok di HP).
    --}}
    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center items-center p-4">
        
        {{-- 
            Card Login.
            - max-w-4xl: Lebar maksimal 56rem.
            - m-0: Margin 0.
            - bg-white: Background putih.
            - shadow-lg: Bayangan besar.
            - sm:rounded-lg: Sudut membulat di layar tablet ke atas.
            - flex: Menggunakan flexbox.
            - flex-1: Mengisi ruang yang tersedia.
            - overflow-hidden: Mencegah konten keluar dari radius sudut.
        --}}
        <div class="max-w-4xl m-0 bg-white shadow-lg sm:rounded-lg flex flex-1 overflow-hidden">

            {{-- ======================================================= --}}
            {{-- BAGIAN KIRI (Form) --}}
            {{-- ======================================================= --}}
            
            {{-- 
                Container Form.
                - lg:w-1/2 xl:w-1/2: Lebar 50% di layar besar.
                - p-10 sm:p-12: Padding besar.
                - flex flex-col justify-center: Flex kolom rata tengah vertikal.
            --}}
            <div class="lg:w-1/2 xl:w-1/2 p-10 sm:p-12 flex flex-col justify-center">
                {{-- Inner Wrapper --}}
                <div class="flex flex-col justify-center h-full">
                    {{-- Header Teks --}}
                    <div class="text-center">
                        {{-- Judul Sign In --}}
                        <h1 class="text-2xl xl:text-3xl font-extrabold">
                            Sign In
                        </h1>
                        {{-- Subjudul --}}
                        <p class="text-sm text-gray-500 mt-1">
                            Selamat datang kembali!
                        </p>
                    </div>

                    {{-- Wrapper Form --}}
                    <div class="w-full mt-8">
                        {{-- Membatasi lebar form agar rapi --}}
                        <div class="mx-auto max-w-xs">
                            
                            {{-- Form Login --}}
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                {{-- Input Email --}}
                                {{-- 
                                    - w-full: Lebar penuh.
                                    - px-8 py-3: Padding dalam yang luas.
                                    - rounded-lg: Sudut membulat.
                                    - font-medium: Font agak tebal.
                                    - bg-gray-100: Input background abu muda.
                                    - border: Border default.
                                --}}
                                <input id="email"
                                    class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border @error('email') border-red-500 @enderror"
                                    type="email" name="email" value="{{ old('email') }}" required autofocus
                                    placeholder="Email" />
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                
                                {{-- Input Password --}}
                                {{-- mt-4: Margin atas --}}
                                <input id="password"
                                    class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border mt-4 @error('password') border-red-500 @enderror"
                                    type="password" name="password" required autocomplete="current-password"
                                    placeholder="Password" />
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                {{-- Tombol Submit --}}
                                {{-- 
                                    - mt-5: Margin atas sedikit lebih jauh.
                                    - tracking-wide: Spasi huruf renggang.
                                    - font-semibold: Tebal.
                                    - bg-red-800: Background merah tua.
                                    - text-gray-100: Teks putih/abu sangat muda.
                                    - w-full: Lebar penuh.
                                    - py-3: Padding vertikal.
                                    - rounded-lg: Membulat.
                                    - hover:bg-red-900: Efek hover merah lebih gelap.
                                    - transition duration-200: Animasi transisi halus.
                                --}}
                                <button type="submit"
                                    class="mt-5 tracking-wide font-semibold bg-red-800 text-gray-100 w-full py-3 rounded-lg hover:bg-red-900 transition duration-200">
                                    Masuk
                                </button>
                            </form>

                            {{-- Pemisah "Atau" --}}
                            <div class="my-6 border-b text-center">
                                <div
                                    class="leading-none px-2 inline-block text-sm text-gray-600 bg-white transform translate-y-1/2">
                                    Atau
                                </div>
                            </div>

                            {{-- Tombol Login Google --}}
                            {{-- 
                                - bg-indigo-100: Background nila muda.
                                - text-gray-800: Teks abu gelap.
                                - hover:bg-indigo-200: Hover nila agak gelap.
                            --}}
                            <a href="{{ route('google.redirect') }}"
                                class="w-full font-bold shadow-sm rounded-lg py-3 bg-indigo-100 text-gray-800 flex items-center justify-center hover:bg-indigo-200 transition duration-200">
                                {{-- Icon Google (SVG) --}}
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
                                <span class="ml-4">Masuk dengan Google</span>
                            </a>

                            {{-- Footer Link: Daftar --}}
                            <div class="mt-6 text-center text-sm">
                                <p class="text-gray-600">
                                    Belum punya akun? <a href="{{ route('register') }}"
                                        class="border-b border-gray-500 border-dotted">Daftar</a>
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
                - bg-gray-100: Background cadangan.
                - hidden lg:flex: Disembunyikan di mobile/tablet, muncul flex di desktop.
                - rounded-r-lg: Sudut kanan membulat.
            --}}
           <div class="flex-1 bg-gray-100 text-center hidden lg:flex rounded-r-lg items-center justify-center overflow-hidden">
             {{-- Gambar --}}
            <img src="{{ asset('images/telu.png') }}" alt="Background"
                class="w-50% h-200% object-cover object-center"> 
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
