{{-- Beri id="main-nav" agar bisa diambil oleh JavaScript --}}
<nav id="main-nav" class="bg-white shadow-md fixed top-0 left-0 w-full z-50 transition-transform duration-300">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            {{-- Logo di Kiri --}}
            <div>
                <a href="/" class="text-xl font-bold text-gray-800">Lost&Found</a>
            </div>

            {{-- Menu di Kanan --}}
            <div class="hidden md:flex items-center space-x-4">
                <a href="/" class="text-gray-600 hover:text-gray-800">Beranda</a>
                <a href="#" class="text-gray-600 hover:text-gray-800">Laporan</a>
                <a href="{{ route('items.index') }}" class="text-gray-600 hover:text-gray-800">Barang</a>
                {{-- Tampilkan menu Profil hanya jika admin login --}}
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="#" class="text-gray-600 hover:text-gray-800">Profil</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
