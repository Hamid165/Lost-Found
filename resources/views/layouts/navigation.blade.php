<nav x-data="{ open: false }" class="bg-red-800 border-b border-red-900 fixed w-full z-50 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center space-x-2">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        <x-application-logo class="block h-9 w-auto" />
                        <span class="text-white font-bold text-lg">Lost&Found</span>
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="hidden space-x-4 sm:flex">
                    <x-nav-link :href="url('/')" :active="request()->is('/')">{{ __('Beranda') }}</x-nav-link>

                    {{-- =================================================================== --}}
                    {{-- PERUBAHAN 1: Link "Barang" dibuat menjadi dinamis untuk Desktop --}}
                    {{-- =================================================================== --}}
                    @if(auth()->check() && auth()->user()->isAdmin())
                        {{-- Jika Admin, arahkan ke halaman manajemen --}}
                        <x-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.index*')">{{ __('Barang') }}</x-nav-link>
                    @else
                        {{-- Jika User biasa atau Tamu, arahkan ke halaman publik --}}
                        <x-nav-link :href="route('items.index')" :active="request()->routeIs('items.index')">{{ __('Barang') }}</x-nav-link>
                    @endif

                    <x-nav-link :href="route('report.index')" :active="request()->routeIs('report.index')">{{ __('Laporan') }}</x-nav-link>

                    {{-- Link khusus Admin lainnya --}}
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard*')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif
                </div>
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 hover:text-white focus:outline-none transition ease-in-out duration-150 bg-red-800">
                                    <div>{{ Auth::user()->name }}</div>
                                    <img class="h-8 w-8 rounded-full object-cover ms-2" src="{{ Auth::user()->profile_photo_path ? asset('storage/'. Auth::user()->profile_photo_path) : 'https://ui-avatars.com/api/?name='. urlencode(Auth::user()->name). '&color=FFFFFF&background=D12E37' }}" alt="{{ Auth::user()->name }}">
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>

                                {{-- ================================================= --}}
                                {{-- PERBAIKAN 1: Menggunakan x-on:click untuk Desktop --}}
                                {{-- ================================================= --}}
                                <form method="POST" action="{{ route('logout') }}" x-ref="logoutForm">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                                     x-on:click.prevent="$refs.logoutForm.submit()">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <div class="space-x-4">
                            <a href="{{ route('login') }}" class="text-sm text-gray-200 hover:text-white underline">Log in</a>
                            <a href="{{ route('register') }}" class="text-sm text-gray-200 hover:text-white underline">Register</a>
                        </div>
                    @endauth
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Tampilan Mobile --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">{{ __('Beranda') }}</x-responsive-nav-link>

            {{-- =================================================================== --}}
            {{-- PERUBAHAN 2: Link "Barang" dibuat menjadi dinamis untuk Mobile --}}
            {{-- =================================================================== --}}
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
        <div class="pt-4 pb-1 border-t border-gray-600">
            @auth
                <div class="px-4 flex items-center justify-between">
                    <div>
                        <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="shrink-0">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_path ? asset('storage/'. Auth::user()->profile_photo_path) : 'https://ui-avatars.com/api/?name='. urlencode(Auth::user()->name). '&color=FFFFFF&background=D12E37' }}" alt="{{ Auth::user()->name }}">
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>

                    {{-- =============================================== --}}
                    {{-- PERBAIKAN 2: Menggunakan x-on:click untuk Mobile --}}
                    {{-- =============================================== --}}
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
                <div class="py-1 border-t border-gray-600">
                    <x-responsive-nav-link :href="route('login')" :active="false">{{ __('Log in') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" :active="false">{{ __('Register') }}</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>

{{-- Tombol Scroll to Top --}}
<button id="scrollTopBtn" class="fixed bottom-6 right-6 bg-red-700 text-white p-3 rounded-full shadow-lg hover:bg-red-800 transition-opacity opacity-0 duration-300">
    ↑
</button>

{{-- Script Scroll (INI SUDAH BENAR, JANGAN DIUBAH) --}}
<script nonce="{{ $csp_nonce }}">
    const scrollBtn = document.getElementById('scrollTopBtn');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 200) { // muncul setelah scroll 200px
            scrollBtn.classList.remove('opacity-0');
        } else {
            scrollBtn.classList.add('opacity-0');
        }
    });

    scrollBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
