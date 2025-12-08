{{-- 
    Container Navigasi Utama.
    x-data="{ open: false }": Inisialisasi state Alpine.js untuk menu mobile (default tertutup).
    class="...":
    - bg-red-800: Latar belakang warna merah tua.
    - border-b border-red-900: Garis bawah dengan warna merah lebih tua.
    - fixed: Posisi tetap (sticky) saat discroll.
    - w-full: Lebar penuh 100%.
    - z-50: Z-index tinggi agar selalu di atas elemen lain.
    - top-0: Menempel di bagian atas viewport.
--}}
<nav x-data="{ open: false }" class="bg-red-800 border-b border-red-900 fixed w-full z-50 top-0">
    
    {{-- 
        Wrapper Konten Maksimal.
        - max-w-7xl: Lebar maksimum konten 80rem.
        - mx-auto: Margin kiri-kanan otomatis (rata tengah).
        - px-4: Padding horizontal 1rem (Mobile).
        - sm:px-6: Padding horizontal 1.5rem (Tablet).
        - lg:px-8: Padding horizontal 2rem (Desktop).
    --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Flex Container Utama. h-16: Tinggi navbar 4rem. flex justify-between: Flexbox dengan jarak antar item (Logo kiri, Menu kanan). --}}
        <div class="flex justify-between h-16">
            
            {{-- Bagian Kiri (Logo) --}}
            <div class="flex">
                {{-- Logo Wrapper. shrink-0: Mencegah logo mengecil. flex items-center: Rata tengah vertikal. space-x-2: Jarak antar elemen 0.5rem. --}}
                <div class="shrink-0 flex items-center space-x-2">
                    {{-- Link Homepage --}}
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        {{-- Komponen Logo. block h-9 w-auto: Tinggi 2.25rem, lebar menyesuaikan. --}}
                        <x-application-logo class="block h-9 w-auto" />
                        {{-- Teks Brand. text-white: Putih. font-bold: Tebal. text-lg: Ukuran font besar. --}}
                        <span class="text-white font-bold text-lg">Lost&Found</span>
                    </a>
                </div>
            </div>

            {{-- Bagian Kanan (Menu Desktop) --}}
            {{-- hidden sm:flex: Sembunyi di mobile, tampil flex di tablet+. sm:items-center: Rata tengah vertikal. sm:ms-6: Margin kiri 1.5rem. --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                
                {{-- Link Navigasi Desktop. hidden space-x-4 sm:flex: Jarak horizontal antar link 1rem. --}}
                <div class="hidden space-x-4 sm:flex">
                    {{-- Link Beranda --}}
                    <x-nav-link :href="url('/')" :active="request()->is('/')">{{ __('Beranda') }}</x-nav-link>

                    {{-- =================================================================== --}}
                    {{-- Logika Link "Barang" (Admin vs User) --}}
                    {{-- =================================================================== --}}
                    @if(auth()->check() && auth()->user()->isAdmin())
                        {{-- Admin: Link ke Manajemen Laporan --}}
                        <x-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.index*')">{{ __('Barang') }}</x-nav-link>
                    @else
                        {{-- User: Link ke Katalog Barang --}}
                        <x-nav-link :href="route('items.index')" :active="request()->routeIs('items.index')">{{ __('Barang') }}</x-nav-link>
                    @endif

                    {{-- Link Laporan --}}
                    <x-nav-link :href="route('report.index')" :active="request()->routeIs('report.index')">{{ __('Laporan') }}</x-nav-link>

                    {{-- Link Dashboard Khusus Admin --}}
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard*')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif
                </div>

                {{-- Dropdown Profil User (Desktop) --}}
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @auth
                        {{-- Komponen Dropdown. align="right": Dropdown muncul ke arah kanan. width="48": Lebar dropdown. --}}
                        <x-dropdown align="right" width="48">
                            
                            {{-- Trigger Dropdown (Tombol Nama/Foto) --}}
                            <x-slot name="trigger">
                                {{-- 
                                    Button Styles:
                                    - inline-flex items-center: Flex inline rata tengah.
                                    - px-3 py-2: Padding.
                                    - border border-transparent: Border transparan.
                                    - text-sm leading-4 font-medium: Font kecil, tebal sedang.
                                    - rounded-md: Sudut membulat.
                                    - text-gray-300: Teks abu-abu muda.
                                    - hover:text-white: Putih saat hover.
                                    - bg-red-800: Background merah navbar.
                                    - transition...: Animasi halus.
                                --}}
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 hover:text-white focus:outline-none transition ease-in-out duration-150 bg-red-800">
                                    <div>{{ Auth::user()->name }}</div>
                                    
                                    {{-- Foto Profil Kecil. h-8 w-8: Ukuran 2rem. rounded-full: Lingkaran. object-cover: Crop. ms-2: Margin kiri. --}}
                                    <img class="h-8 w-8 rounded-full object-cover ms-2" src="{{ Auth::user()->profile_photo_path ? asset('storage/'. Auth::user()->profile_photo_path) : 'https://ui-avatars.com/api/?name='. urlencode(Auth::user()->name). '&color=FFFFFF&background=D12E37' }}" alt="{{ Auth::user()->name }}">
                                    
                                    {{-- Ikon Panah Bawah --}}
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            {{-- Isi Dropdown --}}
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>

                                {{-- Form Logout --}}
                                <form method="POST" action="{{ route('logout') }}" x-ref="logoutForm">
                                    @csrf
                                    {{-- Tombol Logout --}}
                                    <x-dropdown-link :href="route('logout')"
                                                     x-on:click.prevent="$refs.logoutForm.submit()">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        {{-- Link Login/Register jika belum login --}}
                        <div class="space-x-4">
                            <a href="{{ route('login') }}" class="text-sm text-gray-200 hover:text-white underline">Log in</a>
                            <a href="{{ route('register') }}" class="text-sm text-gray-200 hover:text-white underline">Register</a>
                        </div>
                    @endauth
                </div>
            </div>

            {{-- Tombol Hamburger Menu (Mobile) --}}
            {{-- -me-2: Margin end negatif. flex items-center: Flex rata tengah. sm:hidden: Sembunyi di desktop. --}}
            <div class="-me-2 flex items-center sm:hidden">
                {{-- Button Toggle. @click="open = ! open": Ubah state open true/false. --}}
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 focus:text-white transition duration-150 ease-in-out">
                    {{-- Ikon Hamburger / Silang SVG --}}
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        {{-- Ikon Garis 3 (Hamburger) - Muncul saat tutup (!open) --}}
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        {{-- Ikon Silang (Close) - Muncul saat buka (open) --}}
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu Mobile (Dropdown Responsif) --}}
    {{-- :class="{'block': open, 'hidden': ! open}": Tampil jika open=true. hidden sm:hidden: Default sembunyi. --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        {{-- List Link Mobile. pt-2 pb-3 space-y-1: Padding & jarak vertikal. --}}
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">{{ __('Beranda') }}</x-responsive-nav-link>

            @if(auth()->check() && auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.index*')">{{ __('Barang') }}</x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('items.index')" :active="request()->routeIs('items.index')">{{ __('Barang') }}</x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('report.index')" :active="request()->routeIs('report.index')">{{ __('Laporan') }}</x-responsive-nav-link>

             @if(auth()->check() && auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endif
        </div>

        {{-- Bagian Profil Mobile --}}
        <div class="pt-4 pb-1 border-t border-gray-600">
            @auth
                {{-- Info User Mobile --}}
                <div class="px-4 flex items-center justify-between">
                    <div>
                        <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="shrink-0">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_path ? asset('storage/'. Auth::user()->profile_photo_path) : 'https://ui-avatars.com/api/?name='. urlencode(Auth::user()->name). '&color=FFFFFF&background=D12E37' }}" alt="{{ Auth::user()->name }}">
                    </div>
                </div>
                
                {{-- Link Aksi Profil Mobile --}}
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>

                    {{-- Form Logout Mobile --}}
                    <form method="POST" action="{{ route('logout') }}" x-ref="logoutFormMobile">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                             :active="false"
                                             x-on:click.prevent="$refs.logoutFormMobile.submit()">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                {{-- Link Login/Register Mobile --}}
                <div class="py-1 border-t border-gray-600">
                    <x-responsive-nav-link :href="route('login')" :active="false">{{ __('Log in') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" :active="false">{{ __('Register') }}</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>

{{-- 
    Tombol Scroll to Top.
    fixed bottom-6 right-6: Posisi tetap di pojok kanan bawah.
    bg-red-700: Warna background merah.
    text-white: Ikon putih.
    p-3 rounded-full: Padding & lingkaran.
    shadow-lg: Bayangan.
    opacity-0: Default transparan (sembunyi).
    transition-opacity duration-300: Animasi fading.
--}}
<button id="scrollTopBtn" class="fixed bottom-6 right-6 bg-red-700 text-white p-3 rounded-full shadow-lg hover:bg-red-800 transition-opacity opacity-0 duration-300">
    ↑
</button>

{{-- Script Scroll Logic (Jangan Diubah) --}}
<script nonce="{{ $csp_nonce }}">
    const scrollBtn = document.getElementById('scrollTopBtn');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 200) { // Muncul jika scroll > 200px
            scrollBtn.classList.remove('opacity-0');
        } else {
            scrollBtn.classList.add('opacity-0');
        }
    });

    scrollBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

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
