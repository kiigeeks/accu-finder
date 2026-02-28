<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            AOS.init({
                duration: 800,
                once: true,
                offset: 50,
            });
        }, 100);

        // Fungsionalitas untuk Tombol Navigasi Mobile
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if(menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
            const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');

            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', () => {
            
                    mobileMenu.classList.add('hidden');
                });
            });

        }

        
    });
</script>