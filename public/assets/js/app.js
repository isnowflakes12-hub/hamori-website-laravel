/**
 * RS Hamori - Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function () {

    // ---- Navbar scroll effect ----
    const navbar = document.getElementById('mainNavbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 80) {
            navbar?.classList.add('scrolled');
        } else {
            navbar?.classList.remove('scrolled');
        }
    });

    // ---- Animate counter numbers ----
    const counters = document.querySelectorAll('[data-count]');
    const observerOptions = { threshold: 0.5 };
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.getAttribute('data-count'));
                let current = 0;
                const increment = target / 60;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    entry.target.textContent = Math.floor(current) + '+';
                }, 16);
                counterObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    counters.forEach(c => counterObserver.observe(c));

    // ---- Appointment modal ----
    const appointmentBtns = document.querySelectorAll('[data-appointment]');
    appointmentBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('appointmentModal'));
            if (modal) modal.show();
        });
    });

    // ---- Copy number ----
    document.querySelectorAll('.copy-number').forEach(btn => {
        btn.addEventListener('click', function () {
            const num = this.dataset.number;
            navigator.clipboard.writeText(num).then(() => {
                const original = this.innerHTML;
                this.innerHTML = '<i class="bi bi-check2"></i> Tersalin!';
                setTimeout(() => { this.innerHTML = original; }, 2000);
            });
        });
    });

    // ---- Smooth scroll ----
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ---- Alert auto-dismiss ----
    document.querySelectorAll('.alert-dismissible').forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

});

// ============================================
// POPUP PROMO
// ============================================
(function () {
    const STORAGE_KEY = 'rshamori_promo_hidden';
    const overlay    = document.getElementById('promoOverlay');
    const closeBtn   = document.getElementById('promoClose');
    const dontShow   = document.getElementById('promoDontShow');
    const countdown  = document.getElementById('promoCountdown');

    if (!overlay) return;

    // Check if user dismissed today
    function isDismissedToday() {
        const val = localStorage.getItem(STORAGE_KEY);
        if (!val) return false;
        const dismissed = new Date(val);
        const now = new Date();
        return dismissed.toDateString() === now.toDateString();
    }

    function closePromo() {
        overlay.classList.remove('show');
        if (dontShow && dontShow.checked) {
            localStorage.setItem(STORAGE_KEY, new Date().toISOString());
        }
    }

    // Show popup after 1.5s delay if not dismissed today
    if (!isDismissedToday()) {
        setTimeout(function () {
            overlay.classList.add('show');
        }, 1500);
    }

    // Close on X button
    if (closeBtn) closeBtn.addEventListener('click', closePromo);

    // Close on overlay click (outside popup)
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closePromo();
    });

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closePromo();
    });

    // ---- Countdown timer ----
    if (countdown) {
        // End of today
        const endTime = new Date();
        endTime.setHours(23, 59, 59, 0);

        function updateCountdown() {
            const now  = new Date();
            const diff = Math.max(0, endTime - now);
            const h = String(Math.floor(diff / 3600000)).padStart(2, '0');
            const m = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
            const s = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
            countdown.textContent = h + ':' + m + ':' + s;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    }
})();
