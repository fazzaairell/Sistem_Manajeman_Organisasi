const container = document.getElementById('container');
const signUpBtn = document.getElementById('signUp');
const signInBtn = document.getElementById('signIn');

signUpBtn.addEventListener('click', () => {
    container.classList.add('right-panel-active')
});

signInBtn.addEventListener('click', () => {
    container.classList.remove('right-panel-active')
});







document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('userDropdownButton');
    const menu = document.getElementById('userDropdownMenu');
    const arrow = document.getElementById('userDropdownArrow');

    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const isOpen = menu.classList.contains('scale-100');

        if (isOpen) {
            menu.classList.remove('scale-100');
            menu.classList.add('scale-0');
            arrow.classList.remove('rotate-180');
        } else {
            menu.classList.remove('scale-0');
            menu.classList.add('scale-100');
            arrow.classList.add('rotate-180');
        }
    });

    // Klik di luar menu tutup dropdown
    document.addEventListener('click', function(e) {
        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.remove('scale-100');
            menu.classList.add('scale-0');
            arrow.classList.remove('rotate-180');
        }
    });
});
