@extends('pembeli.landing')

@section('element')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 fw-bolder">Acara yang tersedia</h2>

        <!-- Dropdowns -->
        <div class="d-flex gap-2">
            <!-- Kategori Dropdown -->
            <select class="form-select warna-primary text-light rounded-pill border border-dark custom-select-arrow"
                aria-label="kategori" id="filterKategori">
                <option selected>Kategori</option>
                <option value="all">Semua</option>
                <option value="bayar">Berbayar</option>
                <option value="gratis">Gratis</option>
            </select>

            <!-- Hari Dropdown -->
            <select class="form-select warna-primary text-light rounded-pill custom-select-arrow" aria-label="hari"
                id="filterHari">
                <option selected>Hari</option>
                <option value="all">Semua</option>
                <option value="2">Senin</option>
                <option value="3">Selasa</option>
                <option value="4">Rabu</option>
                <option value="5">Kamis</option>
                <option value="6">Jumat</option>
                <option value="7">Sabtu</option>
                <option value="1">Minggu</option>
            </select>
        </div>
    </div>

    <!-- Event Cards -->
    <div class="row mt-5">
        <!-- Event Card 1 -->
        @include('partials.event-cards', ['events' => $events])
    </div>
@endsection

@section('extra-js')
    <script>
        const kategoriDropdown = document.getElementById('filterKategori');
        const hariDropdown = document.getElementById('filterHari');
        let kategori = '';
        let hari = '';

        kategoriDropdown.addEventListener('change', function() {
            kategori = kategoriDropdown.value;
            updateContent();
        });

        hariDropdown.addEventListener('change', function() {
            hari = hariDropdown.value;
            updateContent();
        });

        function updateContent() {
            const url = new URL(window.location.href);
            const params = new URLSearchParams();

            if (kategori && kategori !== 'all') {
                params.append('kategori', kategori);
            }
            if (hari && hari !== 'all') {
                params.append('hari', hari);
            }

            // Kirim permintaan AJAX
            fetch(`${url.pathname}?${params.toString()}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    // Cari elemen container untuk event cards
                    const container = document.querySelector('.row.mt-5');
                    container.innerHTML = html; // Perbarui HTML konten
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
