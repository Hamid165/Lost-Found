import './bootstrap';

// === TAMBAHKAN KODE DI BAWAH INI ===

// Pastikan DOM sudah siap sebelum menjalankan script
document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.getElementById('main-nav');
    if (navbar) {
        let lastScrollTop = 0;

        window.addEventListener("scroll", function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                // Saat scroll ke bawah, sembunyikan navbar dengan menggesernya ke atas
                navbar.classList.add('-translate-y-full');
            } else {
                // Saat scroll ke atas, tampilkan lagi
                navbar.classList.remove('-translate-y-full');
            }
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Handle untuk scroll di iOS
        }, false);
    }
});
