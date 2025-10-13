<nav id="main-nav" class="fixed top-0 left-0 w-full z-50 transition-opacity duration-300 before:absolute before:inset-0 before:bg-white/50 before:backdrop-blur-md before:-z-10">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            {{-- Logo di Kiri --}}
            <div>
                {{-- Diubah dari text-gray-800 menjadi text-black --}}
                <a href="/" class="text-xl font-bold text-black">Lost&Found</a>
            </div>

            {{-- Menu di Kanan --}}
            <div class="hidden md:flex items-center space-x-4">
                {{-- Diubah dari text-gray-600 hover:text-gray-800 menjadi text-black --}}
                <a href="/" class="text-black">Beranda</a>
                <a href="{{ route('report.index') }}" class="text-black">Laporan</a>
                <a href="{{ route('items.index') }}" class="text-black">Barang</a>
                {{-- Tampilkan menu Profil hanya jika admin login --}}
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="#" class="text-black">Profil</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
