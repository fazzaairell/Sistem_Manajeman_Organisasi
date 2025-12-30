<!DOCTYPE html>
<html class="scroll-smooth" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
</head>

<body class="bg-white">

    <x-homepage.navbar />

    {{ $slot }}

    <x-homepage.footer />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>