<!DOCTYPE html>
<html lang="en">

{{-- header --}}
@include('layouts.pembeli-penjual-guess.header')

<body class="bg-gray-100 ">
    {{-- Navbar --}}
    @include('layouts.pembeli-penjual-guess.navbar')

    <!-- Hero Section -->
    @include('layouts.pembeli-penjual-guess.hero')


    <!-- Upcoming-->
    @include('layouts.pembeli-penjual-guess.upcoming')


    <!-- Iklan -->
    @include('layouts.pembeli-penjual-guess.ads')

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
                        <h3 class="font-semibold text-lg text-gray-800">6 Strategies to Find Your Conference Keynote
                        </h3>
                        <p class="text-gray-600 mt-2 text-sm">Sekarang, kamu bisa produksi tiket fisik untuk eventmu
                            bersama Bostikbox...</p>
                        <p class="text-gray-500 mt-4 text-xs">12 Mar 2024</p>
                    </div>
                </div>
                <!-- Article Card 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://via.placeholder.com/400x200" alt="Article Image" class="w-full">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800">How Successfully Used Paid Marketing</h3>
                        <p class="text-gray-600 mt-2 text-sm">Sekarang, kamu bisa produksi tiket fisik untuk eventmu
                            bersama Bostikbox...</p>
                        <p class="text-gray-500 mt-4 text-xs">12 Mar 2024</p>
                    </div>
                </div>
                <!-- Article Card 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://via.placeholder.com/400x200" alt="Article Image" class="w-full">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800">Introducing Workspaces</h3>
                        <p class="text-gray-600 mt-2 text-sm">Sekarang, kamu bisa produksi tiket fisik untuk eventmu
                            bersama Bostikbox...</p>
                        <p class="text-gray-500 mt-4 text-xs">12 Mar 2024</p>
                    </div>
                </div>
            </div>

            <!-- Button to load more articles -->
            <div class="text-center mt-6">
                <button
                    class="btn-primary px-8 py-3 rounded-full text-white shadow-lg hover:bg-[#005f8c] focus:outline-none focus:ring-2 focus:ring-black">
                    Lainnya
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('layouts.pembeli-penjual-guess.footer')

    <!-- Extra JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="{{ asset('/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    @yield('extra-js')
</body>

</html>
