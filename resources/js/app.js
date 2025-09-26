import './bootstrap';

// Fungsi untuk menjalankan kode setelah DOM siap
function onReady(callback) {
    if (document.readyState !== 'loading') {
        callback();
    } else {
        document.addEventListener('DOMContentLoaded', callback);
    }
}

onReady(function() {

    // === 1. Navbar Scroll Logic ===
    const navbar = document.getElementById('main-nav');
    if (navbar) {
        let lastScrollTop = 0;
        window.addEventListener("scroll", function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > lastScrollTop && scrollTop > navbar.offsetHeight) {
                navbar.classList.add('opacity-0');
            } else {
                navbar.classList.remove('opacity-0');
            }
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }, false);
    }

    // === 2. FAQ Accordion Logic ===
    const faqToggles = document.querySelectorAll('.faq-toggle');
    faqToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const answer = toggle.nextElementSibling;
            const icon = toggle.querySelector('.faq-icon');
            if (answer.style.maxHeight) {
                answer.style.maxHeight = null;
                answer.classList.add('opacity-0');
                icon.classList.remove('rotate-180');
            } else {
                answer.classList.remove('opacity-0');
                answer.style.maxHeight = answer.scrollHeight + "px";
                icon.classList.add('rotate-180');
            }
        });
    });

    // === 3. Scroll Animation for Feature Cards (Kontrol Penuh di JS) ===
const featureCards = document.querySelectorAll('.feature-card');
if (featureCards.length) {

    // --- DI SINI ANDA MENGATUR TITIK AWAL ANIMASI ---
    // Atur kondisi awal untuk setiap kartu (buat tidak terlihat dan bergeser)
    featureCards.forEach((card, index) => {
        card.style.opacity = '0'; // Semua kartu mulai tidak terlihat
        if (index === 0) { // Kartu Kiri
            card.style.transform = 'translateX(-10px)'; // Mulai dari kiri 50px
        } else if (index === 1) { // Kartu Tengah
            card.style.transform = 'translateY(-10px)'; // Mulai dari atas 50px
        } else if (index === 2) { // Kartu Kanan
            card.style.transform = 'translateX(10px)';  // Mulai dari kanan 50px
        }
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const card = entry.target;
                
                // --- DI SINI ANDA MENGATUR TITIK AKHIR ANIMASI ---
                card.style.opacity = '1'; // Buat kartu terlihat
                
                // Kembalikan ke posisi semula atau posisi kustom
                if (card === featureCards[0]) { // Kartu Kiri
                    card.style.transform = 'translateX(0)'; // Berhenti di x=0
                } else if (card === featureCards[1]) { // Kartu Tengah
                    card.style.transform = 'translateY(0)'; // Berhenti di y=0
                } else if (card === featureCards[2]) { // Kartu Kanan
                    card.style.transform = 'translateX(0)'; // Berhenti di x=0
                }
                
                observer.unobserve(card);
            }
        });
    }, {
        threshold: 0.1
    });

    featureCards.forEach(card => {
        observer.observe(card);
    });
    }
});