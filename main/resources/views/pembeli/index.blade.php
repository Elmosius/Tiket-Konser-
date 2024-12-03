<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YukNonton.com</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .btn-primary {
            background-color: #007AB9;
            color: white;
        }
        .btn-primary:hover {
            background-color: #005f8c;
        }
    </style>
</head>
<body class="bg-gray-100">

<!-- Header -->
<header class="bg-[#007AB9] text-white">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center max-w-7xl"> <!-- Contoh max-w-7xl untuk memberi batasan konten -->
        <!-- Logo with Font Awesome Icon -->
        <div class="flex items-center space-x-2"> <!-- Space between icon and text -->
            <i class="fas fa-ticket-alt text-2xl"></i>
            <h1 class="text-lg font-bold">YukNonton.com</h1>
        </div>

        <!-- Navbar Links -->
        <nav class="flex space-x-6"> <!-- Hapus margin kiri, cukup space-x-6 untuk jarak antar elemen -->
            <a href="#" class="hover:underline">Tiket</a>
            <a href="#" class="hover:underline">Jadwal</a>

            <!-- Profile Icon Only -->
            <a href="#" class="hover:underline">
                <i class="fas fa-user-circle text-xl"></i>
            </a>
        </nav>
    </div>
</header>

<!-- Hero Section -->
<section class="container mx-auto my-10 px-24"> <!-- Tambahkan px-4 untuk padding horizontal -->
    <div class="bg-gray-200 h-64 rounded-lg relative">
        <!-- Navigation Buttons -->
        <button class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-100">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-100">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</section>


<!-- Upcoming Events with Dropdown -->
<section class="container mx-auto my-10 px-24">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Acara Mendatang</h2>

        <!-- Dropdowns -->
        <div class="flex space-x-4">
            <!-- Kategori Dropdown -->
            <div class="relative">
                <select class="bg-[#007AB9] text-white border border-[#007AB9] rounded-lg py-2 px-4 text-sm
                hover:bg-[#005f8c] hover:border-[#005f8c] focus:ring-2 focus:ring-[#005f8c] focus:outline-none">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="1">Kategori 1</option>
                    <option value="2">Kategori 2</option>
                    <option value="3">Kategori 3</option>
                </select>
            </div>

            <!-- Hari Dropdown -->
            <div class="relative">
                <select class="bg-[#007AB9] text-white border border-[#007AB9] rounded-lg py-2 px-4 text-sm
                hover:bg-[#005f8c] hover:border-[#005f8c] focus:ring-2 focus:ring-[#005f8c] focus:outline-none">
                    <option value="" disabled selected>Pilih Hari</option>
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jumat</option>
                    <option value="sabtu">Sabtu</option>
                    <option value="minggu">Minggu</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Event Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Event Card 1 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="https://via.placeholder.com/400x200" alt="Event Image" class="w-full h-40 object-cover">
            <div class="p-4">
                <p class="text-sm text-gray-500 font-semibold">14 APR</p>
                <h3 class="font-semibold text-lg mt-2">Velit animi quas unde suscipit</h3>
                <p class="text-gray-600 mt-2 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Velit animi quas unde.</p>
            </div>
        </div>

        <!-- Event Card 2 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="https://via.placeholder.com/400x200" alt="Event Image" class="w-full h-40 object-cover">
            <div class="p-4">
                <p class="text-sm text-gray-500 font-semibold">16 APR</p>
                <h3 class="font-semibold text-lg mt-2">Quisquam mollitia repellat deserunt</h3>
                <p class="text-gray-600 mt-2 text-sm">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
            </div>
        </div>

        <!-- Event Card 3 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="https://via.placeholder.com/400x200" alt="Event Image" class="w-full h-40 object-cover">
            <div class="p-4">
                <p class="text-sm text-gray-500 font-semibold">20 APR</p>
                <h3 class="font-semibold text-lg mt-2">Excepteur sint occaecat cupidatat</h3>
                <p class="text-gray-600 mt-2 text-sm">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-6">
        <!-- Button with rounded-full -->
        <button class="btn-primary px-6 py-3 rounded-full shadow hover:bg-[#005f8c]">Lainnya</button>
    </div>
</section>


<!-- Divider Section -->
<section class="bg-white py-10 px-24">
    <div class="container mx-auto text-center">
        <!-- Heading Text -->
        <h2 class="text-3xl font-semibold text-gray-800">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </h2>

        <!-- Subheading Text -->
        <p class="text-gray-600 mt-4 text-lg">
            Velit animi quas unde suscipit fugiat facilis ad quod.
        </p>

        <!-- Button below the text -->
        <div class="mt-8">
            <button class="btn-primary px-10 py-4 rounded-full text-white shadow-lg hover:bg-[#005f8c] focus:outline-none focus:ring-2 focus:ring-black">
                Lihat Selengkapnya
            </button>
        </div>
    </div>
</section>


<!-- Interesting Articles -->
<section class="bg-white py-10 px-24">
    <div class="container mx-auto">
        <h2 class="text-2xl font-semibold mb-6 text-left text-gray-800">
            Berita Menarik
        </h2>

        <!-- Grid layout for article cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Article Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x200" alt="Article Image" class="w-full">
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-800">6 Strategies to Find Your Conference Keynote</h3>
                    <p class="text-gray-600 mt-2 text-sm">Sekarang, kamu bisa produksi tiket fisik untuk eventmu bersama Bostikbox...</p>
                    <p class="text-gray-500 mt-4 text-xs">12 Mar 2024</p>
                </div>
            </div>
            <!-- Article Card 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x200" alt="Article Image" class="w-full">
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-800">How Successfully Used Paid Marketing</h3>
                    <p class="text-gray-600 mt-2 text-sm">Sekarang, kamu bisa produksi tiket fisik untuk eventmu bersama Bostikbox...</p>
                    <p class="text-gray-500 mt-4 text-xs">12 Mar 2024</p>
                </div>
            </div>
            <!-- Article Card 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x200" alt="Article Image" class="w-full">
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-800">Introducing Workspaces</h3>
                    <p class="text-gray-600 mt-2 text-sm">Sekarang, kamu bisa produksi tiket fisik untuk eventmu bersama Bostikbox...</p>
                    <p class="text-gray-500 mt-4 text-xs">12 Mar 2024</p>
                </div>
            </div>
        </div>

        <!-- Button to load more articles -->
        <div class="text-center mt-6">
            <button class="btn-primary px-8 py-3 rounded-full text-white shadow-lg hover:bg-[#005f8c] focus:outline-none focus:ring-2 focus:ring-black">
                Lainnya
            </button>
        </div>
    </div>
</section>

<<!-- Footer -->
<footer class="bg-[#007AB9] text-white py-10 px-24">
    <div class="container mx-auto grid grid-cols-2 gap-8">
        <!-- Left Side: Logo, Deskripsi, Social Media Icons -->
        <div class="flex flex-col items-start">
            <h1 class="text-3xl font-bold">YukNonton.com</h1>
            <p class="text-xs mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <!-- Social Media Icons -->
            <div class="flex space-x-6 mt-4">
                <a href="#" class="text-white hover:text-[#005f8c]">
                    <i class="fab fa-facebook fa-lg"></i>
                </a>
                <a href="#" class="text-white hover:text-[#005f8c]">
                    <i class="fab fa-twitter fa-lg"></i> <!-- Twitter Icon -->
                </a>
                <a href="#" class="text-white hover:text-[#005f8c]">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
            </div>
        </div>

        <!-- Right Side: Bantuan and Lorem Ipsum -->
        <div class="text-xs">
            <h2 class="text-lg font-semibold">Bantuan</h2>
            <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>

    <!-- Divider Line -->
    <div class="border-t border-gray-400 my-4"></div>

    <!-- Copyright Text -->
    <div class="text-right px-24 text-sm">
        <p>© 2024 YukNonton.com. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
