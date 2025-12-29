<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',

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

</body>

</html>