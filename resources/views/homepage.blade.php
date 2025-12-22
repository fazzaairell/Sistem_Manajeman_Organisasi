<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    @vite([
        'resources/css/app.css',
    ])
</head>

<body class="bg-white ">

    <div class="flex justify-center items-center">
        <div class="w-[70%] relative flex justify-between p-8 border-b border-gray-300/40">
            <h1>InTech</h1>
            <nav>
                <ul class="flex justify-center items-center space-x-10">
                    <li>
                        <a href="#" class="hover:text-purple-500">Beranda</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-purple-500">Event</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-purple-500">Pengumuman</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-purple-500">Galeri</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-purple-500">Kontak</a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>

    <div id="home" class="relative flex justify-center items-center mt-20">

        <div class="w-[70%] flex rounded-tr-[150px] overflow-hidden">
            <div class="w-[50%] p-2 space-y-2">
                <p class="p-2 bg-gradient-to-r from-purple-500 to-indigo-600 w-fit rounded-2xl text-[12px] ml-3 text-white">Mengenal Kami lebih jauh disini!</p>
                <h1 class="font-bold text-[55px] p-2 text-[#181E4B]">Mewujudkan organisasi yang aktif,solid, dan berdaya guna.</h1>
                <p class="p-2 w-[80%] text-[#181E4B]/85">kami merupakan wadah kolaborasi yang bertujuan untuk
                    mengembangkan potensi anggota, memperkuat kebersamaan, serta memberikan kontribusi positif bagi
                    lingkungan dan masyarakat.</p>
                <button
                    class="py-4 px-8 shadow-2xl bg-gradient-to-r from-purple-500 to-indigo-600 rounded-[8px] text-white font-bold ml-3 mt-5 hover:scale-110 transition-transform duration-500">
                    <a href="#">Lihat Event →</a>
                </button>
            </div>
            <div class="w-[50%]">
                <div
                    class="w-full bg-[url('/public/storage/photos/page.png')] bg-cover bg-center h-full rounded-bl-full">

                </div>
            </div>
        </div>

    </div>

    <div class="relative flex justify-center items-center mt-[100px]">
        <div class="w-[70%] flex border border-gray-300 rounded-3xl">
            <div class="w-[50%] p-20 space-y-2">
                <p class="text-white w-fit p-2 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl">Sejak 2025</p>
                <h1 class="text-[50px] text-[#181E4B] font-bold">Tentang KAMI</h1>
                <p class="text-[#181E4B]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Non facere officia ab
                    autem. Dolor ipsa
                    blanditiis animi officiis obcaecati accusantium nemo accusamus impedit excepturi maiores, in, est
                    quam dolores odio.</p>
                <button class="bg-gradient-to-r from-purple-500 to-indigo-600 rounded-[8px] text-white font-bold py-4 px-8 mt-5 hover:scale-110 transition-transform duration-500">
                    <a href="#home">Pelajari Lebih lanjut →</a>
                </button>
            </div>
            <div class="w-[50%] flex justify-center items-center">
                <div class="w-[85%] h-[70%] rounded-2xl overflow-hidden shadow-md">
                    <div
                        class="w-full h-full bg-[url('/public/storage/photos/page.png')] bg-cover bg-center transition-transform duration-500 hover:scale-110">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative flex justify-center items-center mt-[100px]">
        <div class="w-[70%] space-y-2">
            <h2 class="text-purple-950 text-2xl font-semibold">Event Kami</h2>
            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold">🎉 • Event - event KAMI</h1>
                <p class="text-blue-800"><a href="#">Lihat semua →</a></p>
            </div>

            <div class="flex justify-center items-center mt-5">
                <div class="max-w-sm bg-white rounded-lg shadow-md p-6 space-y-4">
                    <img src="/storage/photos/page.png" alt="Event Image" class="rounded-lg object-cover w-full h-48" />

                    <p class="text-green-600 text-sm font-semibold">Telah Selesai</p>

                    <h3 class="text-lg font-bold text-gray-900 hover:text-purple-600 cursor-pointer transition-colors">
                        Festival Music Unpas 2025
                    </h3>

                    <p class="text-sm text-gray-600">
                        11 - 26 October 2025
                    </p>

                    <p class="flex items-center text-gray-600 text-sm space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline-block" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                        </svg>
                        <span>10 Band Terbaik</span>
                    </p>

                    <button
                        class="w-full py-2 bg-purple-300 rounded-md font-semibold hover:bg-purple-400 transition">
                        <a href="#">Lihat Event →</a>
                    </button>
                </div>

                <div class="max-w-sm bg-white rounded-lg shadow-md p-6 space-y-4">
                    <img src="/storage/photos/page.png" alt="Event Image" class="rounded-lg object-cover w-full h-48" />

                    <p class="text-green-600 text-sm font-semibold">Telah Selesai</p>

                    <h3 class="text-lg font-bold text-gray-900 hover:text-purple-600 cursor-pointer transition-colors">
                        Festival Music Unpas 2025
                    </h3>

                    <p class="text-sm text-gray-600">
                        11 - 26 October 2025
                    </p>

                    <p class="flex items-center text-gray-600 text-sm space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline-block" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                        </svg>
                        <span>10 Band Terbaik</span>
                    </p>

                    <button
                        class="w-full py-2 bg-purple-300 rounded-md font-semibold hover:bg-purple-400">
                        <a href="#">Lihat Event →</a>
                    </button>
                </div>

                <div class="max-w-sm bg-white rounded-lg shadow-md p-6 space-y-4">
                    <img src="/storage/photos/page.png" alt="Event Image" class="rounded-lg object-cover w-full h-48" />

                    <p class="text-green-600 text-sm font-semibold">Telah Selesai</p>

                    <h3 class="text-lg font-bold text-gray-900 hover:text-purple-600 cursor-pointer transition-colors">
                        Festival Music Unpas 2025
                    </h3>

                    <p class="text-sm text-gray-600">
                        11 - 26 October 2025
                    </p>

                    <p class="flex items-center text-gray-600 text-sm space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline-block" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                        </svg>
                        <span>10 Band Terbaik</span>
                    </p>

                    <button
                        class="w-full py-2 bg-purple-300 rounded-md font-semibold hover:bg-purple-400 transition">
                        <a href="#">Lihat Event →</a>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <div class="relative flex justify-center items-center mt-20">
        <div class="w-[70%] space-y-2">
            <h2 class="text-purple-950 text-2xl font-semibold">Info Terkini</h2>
            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold">📰 • Pengumuman Terkini</h1>
                <p class="text-blue-800"><a href="#">Lihat semua →</a></p>
            </div>

            <div class="max-w-7xl mx-auto px-4 py-8">
                <div class="grid gap-6 md:grid-cols-3">

                <div class="relative rounded-lg overflow-hidden shadow-lg group cursor-pointer">
                        <img src="/storage/photos/page.png" alt=""
                            class="w-full h-[30rem] object-cover brightness-75 transition duration-300 group-hover:brightness-90" />
                        <div
                            class="absolute top-3 left-3 bg-black bg-opacity-40 text-white text-xs font-semibold rounded-md px-2 py-1 border border-white">
                            Libur
                        </div>

                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="text-xs mb-1">19 December 2025</p>
                            <h3 class="text-lg font-bold leading-snug">
                                Libur dari 2025 hingga 2027
                            </h3>
                        </div>
                    </div>

                    <div class="relative rounded-lg overflow-hidden shadow-lg group cursor-pointer">
                        <img src="/storage/photos/page.png" alt=""
                            class="w-full h-[30rem] object-cover brightness-75 transition duration-300 group-hover:brightness-90" />
                        <div
                            class="absolute top-3 left-3 bg-black bg-opacity-40 text-white text-xs font-semibold rounded-md px-2 py-1 border border-white">
                            Libur
                        </div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="text-xs mb-1">19 December 2025</p>
                            <h3 class="text-lg font-bold leading-snug">
                                Libur dari 2025 hingga 2027
                            </h3>
                        </div>
                    </div>

                    <div class="relative rounded-lg overflow-hidden shadow-lg group cursor-pointer">
                        <img src="/storage/photos/page.png" alt="Berita 3"
                            class="w-full h-[30rem] object-cover brightness-75 transition duration-300 group-hover:brightness-90" />
                        <div
                            class="absolute top-3 left-3 bg-black bg-opacity-40 text-white text-xs font-semibold rounded-md px-2 py-1 border border-white">
                            Libur
                        </div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="text-xs mb-1">19 December 2025</p>
                            <h3 class="text-lg font-bold leading-snug">
                                libur dari 2025 hingga 2027
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="relative flex justify-center items-center mt-20 mb-20">
        <div class="w-[70%] space-y-2">
            <h2 class="text-purple-800 text-2xl font-semibold">Koleksi terbaru</h2>
            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold">📰 • Galeri KAMI</h1>
                <p class="text-blue-800"><a href="#">Lihat semua →</a></p>
            </div>

            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mt-5">
                <img src="/storage/photos/page.png" alt="Foto 1"
                    class="w-full h-48 object-cover rounded-2xl shadow-md" />
                <img src="/storage/photos/page.png" alt="Foto 2"
                    class="w-full h-48 object-cover rounded-2xl shadow-md" />
                <img src="/storage/photos/page.png" alt="Foto 3"
                    class="w-full h-48 object-cover rounded-2xl shadow-md" />
                <img src="/storage/photos/page.png" alt="Foto 4"
                    class="w-full h-48 object-cover rounded-2xl shadow-md" />
                <img src="/storage/photos/page.png" alt="Foto 5"
                    class="w-full h-48 object-cover rounded-2xl shadow-md" />
                <img src="/storage/photos/page.png" alt="Foto 6"
                    class="w-full h-48 object-cover rounded-2xl shadow-md" />
            </div>

        </div>
    </div>

    <footer class="bg-white  mt-20">
        <div class="w-[70%] mx-auto px-6 py-10 text-center border-t border-gray-300/40">

            <div class="flex flex-col items-center gap-3">
                <img src="/images/koni-logo.png" alt="Intech logo" class="h-16">
                <h2 class="text-lg font-bold text-blue-900 leading-tight">
                    SISTEM<br>
                    MANAJEMEN<br>
                    ORGANISASI
                </h2>
            </div>

            <p class="mt-4 text-sm text-gray-600 max-w-3xl mx-auto">
                kami merupakan wadah kolaborasi yang bertujuan untuk
                    mengembangkan potensi anggota, memperkuat kebersamaan, serta memberikan kontribusi positif bagi
                    lingkungan dan masyarakat...
                <a href="#" class="text-blue-700 hover:underline">Baca Selengkapnya</a>
            </p>

            <div class="mt-6 flex flex-wrap justify-center gap-6 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    <span>📞</span>
                    <span>(081) 777777</span>
                </div>
                <div class="flex items-center gap-2">
                    <span>✉️</span>
                    <span>intech@gmail.com</span>
                </div>
                <div class="flex items-center gap-2">
                    <span>📍</span>
                    <span>Jl. Haji Ridho 1, Bandung</span>
                </div>
            </div>

            <nav class="mt-8">
                <ul class="flex flex-wrap justify-center gap-6 text-sm font-medium text-gray-800">
                    <li><a href="#" class="hover:text-red-500">Beranda</a></li>
                    <li><a href="#" class="hover:text-red-500">Tentang KAMI</a></li>
                    <li><a href="#" class="hover:text-red-500">Galeri</a></li>
                    <li><a href="#" class="hover:text-red-500">Event</a></li>
                    <li><a href="#" class="hover:text-red-500">Pengumuman</a></li>
                    <li><a href="#" class="hover:text-red-500">Kontak</a></li>
                </ul>
            </nav>

            <!-- Copyright -->
            <div class="mt-8 text-xs text-gray-500">
                © 2025 Sistem Manajemen Organisasi. All Rights Reserved.
                <br>
                Made with <span class="text-red-500">♥</span> by
                <span class="text-red-500">Intech~</span>
            </div>

        </div>
    </footer>



</body>

</html>