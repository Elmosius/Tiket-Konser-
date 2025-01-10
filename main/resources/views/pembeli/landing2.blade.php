<!DOCTYPE html>
<html lang="en">

@include('layouts.pembeli-penjual-guess.header')

<body class="bg-gray-100">
    @include('layouts.pembeli-penjual-guess.navbar')


    <!-- Event Cards -->
    <!-- Event Cards Container -->
    <section class="container my-5 px-24" style="min-height: 55vh;>
        @yield('element')
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
