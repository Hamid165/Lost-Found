{{-- Container Section. space-y-6: Memberikan jarak vertikal antar elemen sebesar 1.5rem (24px). --}}
<section class="space-y-6">

    {{-- Header Section --}}
    <header>
        {{-- Judul. text-lg: Ukuran font besar (1.125rem). font-medium: Ketebalan font sedang (500). text-gray-900: Warna teks abu gelap. --}}
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        {{-- Deskripsi. mt-1: Margin atas 0.25rem. text-sm: Ukuran font kecil (0.875rem). text-gray-600: Warna teks abu sedang. --}}
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    {{-- Tombol Hapus Akun (Trigger Modal). x-data: Menginisialisasi komponen Alpine.js. x-on:click: Event handler klik membuka modal. --}}
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    {{-- Modal Konfirmasi. name: Nama modal untuk dipanggil. show: Kondisi menampilkan modal jika ada error. focusable: Fitur aksesibilitas. --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

        {{-- Form Hapus. method="post": Metode kirim data. action: Route tujuan. class="p-6": Padding dalam 1.5rem. --}}
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            {{-- Judul Modal. --}}
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            {{-- ==================================================================== --}}
            {{-- PERBAIKAN: Tampilkan pesan & form password secara kondisional --}}
            {{-- ==================================================================== --}}
            @if (Auth::user()->password)
                {{-- Tampilkan ini jika user punya password --}}
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                {{-- Input Password Wrapper. mt-6: Margin atas 1.5rem. --}}
                <div class="mt-6">
                    {{-- Label Password (Hidden/Sr-only). --}}
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                    {{-- Input Password Field. mt-1: Margin atas. block: Display block. w-3/4: Lebar 75%. --}}
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Password') }}"
                    />

                    {{-- Pesan Error. mt-2: Margin atas error. --}}
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>
            @else
                {{-- Tampilkan ini jika user TIDAK punya password (Login Google) --}}
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Because you signed in using Google, no password is required. Please confirm you would like to permanently delete your account.') }}
                </p>
            @endif
            {{-- ==================================================================== --}}

            {{-- Tombol Aksi. mt-6: Jarak atas. flex justify-end: Flexbox rata kanan. --}}
            <div class="mt-6 flex justify-end">
                {{-- Tombol Batal. --}}
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                {{-- Tombol Hapus Konfirmasi. ms-3: Margin start (kiri) 0.75rem. --}}
                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

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
