import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// --- Script untuk Animasi Scroll dan FAQ ---

document.addEventListener('DOMContentLoaded', function () {

    // 1. Logika untuk Accordion FAQ
    const faqToggles = document.querySelectorAll('.faq-toggle');
    faqToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const answer = toggle.nextElementSibling;
            const icon = toggle.querySelector('.faq-icon');

            // Tutup semua item FAQ lain yang mungkin terbuka
            document.querySelectorAll('.faq-answer').forEach(ans => {
                if (ans !== answer && ans.classList.contains('active')) {
                    ans.classList.remove('active');
                    ans.style.maxHeight = '0px';
                    ans.style.opacity = '0';
                    ans.previousElementSibling.querySelector('.faq-icon').classList.remove('rotate-180');
                }
            });

            // Buka atau tutup item yang di-klik
            if (answer.classList.contains('active')) {
                answer.classList.remove('active');
                answer.style.maxHeight = '0px';
                answer.style.opacity = '0';
                icon.classList.remove('rotate-180');
            } else {
                answer.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
                answer.style.opacity = '1';
                icon.classList.add('rotate-180');
            }
        });
    });


    // 2. Logika untuk Animasi 'Fade In' saat Scroll
    const animatedElements = document.querySelectorAll('.feature-card, .stat-card');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove('opacity-0', '-translate-x-10', 'translate-x-10');
                observer.unobserve(entry.target); // Hentikan observasi setelah animasi berjalan
            }
        });
    }, {
        threshold: 0.1 // Animasi berjalan saat 10% elemen terlihat
    });

    animatedElements.forEach(el => {
        observer.observe(el);
    });

});