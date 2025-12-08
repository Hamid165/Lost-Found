{{-- Footer Container. bg-red-800: Latar belakang merah tua. py-16: Padding vertikal 4rem (64px). mt-10: Margin atas 2.5rem (40px). --}}
<footer class="bg-red-800 py-16 mt-10">
  
  {{-- Konten Utama Footer (Wrapper). container: Batas lebar responsif. mx-auto: Rata tengah secara horizontal. px-8: Padding kiri-kanan 2rem (32px). --}}
  <div class="container mx-auto px-8">
    
    {{-- Grid Layout Utama. 
         grid: Display grid. 
         grid-cols-1: Mobile 1 kolom. 
         md:grid-cols-2: Tablet 2 kolom. 
         lg:grid-cols-4: Laptop/Desktop 4 kolom. 
         text-center: Teks rata tengah (default mobile). 
         md:text-left: Teks rata kiri di layar md ke atas. 
         gap-y-10: Jarak vertikal antar baris 2.5rem. 
         md:gap-x-6: Jarak horizontal antar kolom 1.5rem di layar md ke atas. 
    --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 text-center md:text-left gap-y-10 md:gap-x-6">

      <!-- Kolom 1: Kontak -->
      {{-- Wrapper Kolom Kontak. p-4: Padding 1rem. flex flex-col: Flexbox arah kolom. items-center: Rata tengah (mobile). md:items-start: Rata kiri (desktop). --}}
      <div class="p-4 flex flex-col items-center md:items-start">
        {{-- Judul Seksi. text-lg: Ukuran font besar (1.125rem). font-bold: Tebal (700). mb-4: Margin bawah 1rem. text-white: Warna teks putih. --}}
        <h3 class="text-lg font-bold mb-4 text-white">Kontak</h3>
        
        {{-- List Kontak wrapper. flex flex-col: Kolom. items-center: Rata tengah. md:items-start: Rata kiri. space-y-3: Jarak vertikal antar item 0.75rem. --}}
        <div class="flex flex-col items-center md:items-start space-y-3">
          
          {{-- Item Telepon. 
               border border-red-700: Border 1px solid merah agak gelap. 
               rounded-lg: Sudut membulat 0.5rem. 
               px-4 py-2: Padding horizontal 1rem, vertikal 0.5rem. 
               text-sm: Ukuran font kecil (0.875rem). 
               text-white: Teks putih. 
               hover:bg-red-700: Background jadi merah 700 saat hover. 
               transition: Efek transisi halus. 
          --}}
          <a href="#" class="border border-red-700 rounded-lg px-4 py-2 text-sm text-white hover:bg-red-700 transition">
            +62 811 444 8585
          </a>
          
          {{-- Item Email. (Class sama dengan item telepon di atas) --}}
          <a href="#" class="border border-red-700 rounded-lg px-4 py-2 text-sm text-white hover:bg-red-700 transition">
            lostfound@gmail.com
          </a>
        </div>
      </div>

      <!-- Kolom 2: Jelajahi -->
      {{-- Wrapper Kolom Jelajahi. p-4: Padding 1rem. --}}
      <div class="p-4">
        {{-- Judul. text-lg font-bold mb-4 text-white: Font besar, tebal, margin bawah, putih. --}}
        <h3 class="text-lg font-bold mb-4 text-white">Jelajahi</h3>
        
        {{-- List Link. space-y-2: Jarak antar item nav 0.5rem. text-sm: Font kecil. text-gray-200: Warna teks abu terang. --}}
        <ul class="space-y-2 text-sm text-gray-200">
          {{-- Link Individual. hover:text-white: Putih saat hover. hover:underline: Garis bawah saat hover. --}}
          <li><a href="#" class="hover:text-white hover:underline">Kebijakan Privasi</a></li>
          <li><a href="#" class="hover:text-white hover:underline">Syarat dan Ketentuan</a></li>
          <li><a href="#" class="hover:text-white hover:underline">Pusat Bantuan</a></li>
        </ul>
      </div>

      <!-- Kolom 3: Sosial Media -->
      {{-- Wrapper Kolom Sosmed. p-4: Padding. flex flex-col items-center md:items-start: Flex kolom, rata tengah (mobile) -> kiri (desktop). --}}
      <div class="p-4 flex flex-col items-center md:items-start">
        {{-- Judul. --}}
        <h3 class="text-lg font-bold mb-4 text-white">Sosial Media</h3>
        
        {{-- Container Ikon. flex justify-center: Rata tengah (mobile). md:justify-start: Rata kiri (desktop). gap-5: Jarak antar ikon 1.25rem. --}}
        <div class="flex justify-center md:justify-start gap-5">
          <!-- Facebook -->
          {{-- Link. text-white: Default putih. hover:text-gray-300: Abu terang saat hover. --}}
          <a href="#" class="text-white hover:text-gray-300">
            {{-- Lingkaran Ikon. bg-white: Background putih. rounded-full: Bentuk lingkaran penuh. p-2: Padding 0.5rem. flex items-center justify-center: Ikon di tengah lingkaran. --}}
            <div class="bg-white rounded-full p-2 flex items-center justify-center">
              {{-- SVG Icon. w-5 h-5: Lebar & tinggi 1.25rem. text-red-800: Warna ikon merah tua. fill="currentColor": Mengisi warna sesuai class text. --}}
              <svg class="w-5 h-5 text-red-800" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22 12a10 10 0 10-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.16 1.8.16v2h-1c-1 0-1.3.63-1.3 1.27V12h2.3l-.37 3h-1.93v7A10 10 0 0022 12z" />
              </svg>
            </div>
          </a>

          <!-- Instagram -->
          <a href="#" class="text-white hover:text-gray-300">
            <div class="bg-white rounded-full p-2 flex items-center justify-center">
              <svg class="w-5 h-5 text-red-800" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5A4.25 4.25 0 0020.5 16.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 1.5a3.5 3.5 0 100 7 3.5 3.5 0 000-7zm4.88-.88a.88.88 0 110 1.76.88.88 0 010-1.76z" />
              </svg>
            </div>
          </a>

          <!-- TikTok -->
          <a href="#" class="text-white hover:text-gray-300">
            <div class="bg-white rounded-full p-2 flex items-center justify-center">
              <svg class="w-5 h-5 text-red-800" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.75 3c.14 1.08.61 2.07 1.35 2.85A5.4 5.4 0 0016.8 7h.9v2.43a6.6 6.6 0 01-3.15-.78v5.7a4.65 4.65 0 11-4.65-4.65c.18 0 .36.01.54.03v2.43a2.25 2.25 0 102.25 2.25V3h2.06z" />
              </svg>
            </div>
          </a>
        </div>
      </div>

      <!-- Kolom 4: Alamat -->
      {{-- Wrapper Alamat. p-4: Padding. flex flex-col items-center md:items-start: Flex kolom rata tengah (mobile) -> kiri (desktop). --}}
      <div class="p-4 flex flex-col items-center md:items-start">
        {{-- Judul. --}}
        <h3 class="text-lg font-bold mb-4 text-white">Alamat</h3>
        {{-- Teks Alamat. text-sm: Font kecil. text-gray-200: Abu terang. leading-relaxed: Jarak antar baris 1.625 (lega agar mudah dibaca). --}}
        <p class="text-sm text-gray-200 leading-relaxed">
          Jl. DI Panjaitan No.128, Karangreja, Purwokerto Kidul, Kec. Purwokerto Sel., Kabupaten Banyumas,
          Jawa Tengah 53147
        </p>
      </div>
    </div>

    <!-- Copyright -->
    {{-- Footer Copyright. 
         mt-16: Jarak atas 4rem. 
         border-t border-red-700: Garis pemisah atas warna merah 700. 
         pt-8: Padding atas 2rem. 
         text-center: Teks rata tengah. 
         text-sm: Font kecil. 
         text-gray-300: Warna abu lebih gelap dari 200. 
    --}}
    <div class="mt-16 border-t border-red-700 pt-8 text-center text-sm text-gray-300">
      <p>&copy; 2025 Lost & Found Kampus. All Rights Reserved.</p>
    </div>
  </div>
</footer>

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
