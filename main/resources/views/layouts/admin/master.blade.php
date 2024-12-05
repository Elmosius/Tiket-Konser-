<!doctype html>
<html lang="en">

{{-- Head --}}
@include('layouts.admin.head')
{{-- End Head --}}


<body class="d-flex flex-column min-vh-100">
    <!--  Body Wrapper -->
    <div class="page-wrapper flex-grow-1" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
        data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.admin.sidebar')
        <!--  Sidebar End -->

        <div class="body-wrapper flex-grow-1">
            <!--  Header Start -->
            @include('layouts.admin.header')
            <!--  Header End -->
            <div class="container-fluid flex-grow-1">
                <div class="row flex-grow-1">
                    @yield('isi-konten-dashboard')
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('layouts.admin.footer')
    {{-- End Footer --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="{{ asset('../assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('../assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('../assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('../assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('../assets/js/app.min.js') }}"></script>
    <script src="{{ asset('../assets/js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    @yield('js-tambahan')
</body>

</html>
