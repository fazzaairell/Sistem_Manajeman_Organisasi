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

<body class="bg-white ">

    <x-homepage.navbar />

    <x-homepage.hero />

    <x-homepage.about />

    <x-homepage.events />

    <x-homepage.announcements />

    <x-homepage.gallery />
   
    <x-homepage.footer />
    
</body>

</html>