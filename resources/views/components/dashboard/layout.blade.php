<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite([
        'resources/css/app.css',
    ])
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">

        <x-dashboard.sidebar />

        <main class="flex-1 overflow-y-auto">
            
            <x-dashboard.header />

            {{ $slot }}

        </main>

    </div>

    <script>
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

            document.addEventListener('click', function(e) {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.remove('scale-100');
                    menu.classList.add('scale-0');
                    arrow.classList.remove('rotate-180');
                }
            });
        });
    </script>

</body>
</html>