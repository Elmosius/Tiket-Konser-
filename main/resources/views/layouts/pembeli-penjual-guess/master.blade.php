<!DOCTYPE html>
<html lang="en">

{{-- header --}}
@include('layouts.pembeli-penjual-guess.header')

<body class="bg-gray-100 ">
    {{-- Navbar --}}
    @include('layouts.pembeli-penjual-guess.navbar')

    <!-- Hero Section -->
    {{-- Carousel tiket --}}
    @include('layouts.pembeli-penjual-guess.hero')

    
    <!-- Upcoming-->
    @include('layouts.pembeli-penjual-guess.upcoming')


    <!-- Iklan -->
    @include('layouts.pembeli-penjual-guess.ads')

    <!-- berita -->
    @include('layouts.pembeli-penjual-guess.article')

    <!-- Footer -->
    @include('layouts.pembeli-penjual-guess.footer')

    <!-- Extra JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="{{ asset('/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    @yield('extra-js')
    @yield('filter-js')
</body>

</html>
