<!DOCTYPE html>
<html class="scroll-smooth" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
</head>

<body class="bg-white">

    <x-homepage.navbar />

    {{ $slot }}

    <x-homepage.footer />

    <!-- Alpine.js v3 -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        // di halaman lain
        navigate("/", { state: { scrollTo: "galeri" } });

        // di homepage, cek state dan scroll
        useEffect(() => {
            if (location.state?.scrollTo === "galeri") {
                document.getElementById("galeri").scrollIntoView({ behavior: "smooth" });
            }
        }, []);
    </script>


</body>

</html>