@extends('layouts.pembeli-penjual-guess.master2') <!-- Ganti sesuai dengan layout Anda -->

@section('tiket')
    <section class="container my-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/pertunjukan">Pertunjukan Konser</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contoh A</li>
            </ol>
        </nav>

        <!-- Konten Utama -->
        <div class="row">
            <!-- Bagian Kiri -->
            <div class="col-lg-8">
                <div class="rounded shadow-sm p-4 bg-white">
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                        <span>(TEMPAT DUDUK)</span>
                    </div>
                </div>
            </div>

            <!-- Bagian Kanan -->
            <div class="col-lg-4">
                <div class="rounded shadow-sm p-4 bg-white mb-4">
                    <h5 class="fw-bold">CONTOH A: TEST</h5>
                    <p class="mb-2"><i class="fa fa-calendar-alt"></i> 02 Nov - 03 Nov 2024</p>
                    <p class="mb-2"><i class="fa fa-clock"></i> <a href="#" class="text-primary">Lihat jadwal</a></p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt"></i> Lokasinya</p>
                    <hr>
                    <p class="text-muted mb-1">Diselenggarakan oleh:</p>
                    <p><strong>Asep</strong></p>
                </div>

                <div class="rounded shadow-sm p-4 bg-white">
                    <div id="pilih-tiket" class="text-center">
                        <p class="text-muted mb-2">Kamu belum memilih tiket. Silahkan pilih terlebih dahulu.</p>
                        <p class="fw-bold">Harga mulai dari</p>
                        <h4 class="fw-bold text-primary">Rp. xxx.xxx,xx</h4>
                    </div>
                    <a id="beli-tiket-btn" class="btn btn-primary w-100 py-2 mt-3" href="{{route('upcoming.beli-tiket')}}">
                        Beli Tiket
                    </a>
                </div>
            </div>
        </div>

        <!-- Tab Menu -->
        <div class="mt-5">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <button class="btn btn-outline-primary px-4 py-2 mx-2 active" id="deskripsi-tab" onclick="showTab('deskripsi')">Deskripsi</button>
                <button class="btn btn-outline-primary px-4 py-2 mx-2" id="tiket-tab" onclick="showTab('tiket')">Tiket</button>
            </div>

            <div class="tab-content">
                <!-- Deskripsi -->
                <div id="deskripsi" class="tab-pane fade show active">
                    <h6 class="fw-bold">Syarat & Ketentuan</h6>
                    <ul>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Minus quis asperiores similique quo modi.</li>
                        <li>Fugit modi vel praesentium sunt, minima culpa atque.</li>
                    </ul>
                </div>

                <!-- Tiket -->
                <div id="tiket" class="tab-pane fade">
                    <h6 class="fw-bold my-3">
                        <i class="fa fa-calendar-alt"></i> DAY - 1 (02 Nov - 17:00)
                    </h6>
                    <!-- Tiket Card -->
                    <div class="d-flex flex-column shadow rounded-lg p-4 mb-4" style="background: #fff; border: 1px solid #ddd;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="fw-bold mb-1">VIP KONSER CONTOH A: TEST</h5>
                                <p class="text-muted mb-0"><i class="fa fa-calendar-alt"></i> 02 Nov 2024 - 17:00</p>
                            </div>
                            <div>
                                <h4 class="fw-bold text-primary mb-0">Rp. 799,000</h4>
                            </div>
                        </div>

                        <hr style="margin: 20px 0; border-top: 1px dashed #ddd;">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-0">Kode Tiket: <span class="fw-bold">VIP12345</span></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-primary btn-sm mx-2" onclick="updateTicketCount(-1)">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <span id="ticket-count" class="fw-bold">0</span>
                                <button class="btn btn-outline-primary btn-sm mx-2" onclick="updateTicketCount(1)">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        let ticketCount = 0;

        function showTab(tabId) {
            document.querySelectorAll('.tab-pane').forEach(tab => tab.classList.remove('show', 'active'));
            document.getElementById(tabId).classList.add('show', 'active');

            document.querySelectorAll('.btn-outline-primary').forEach(btn => btn.classList.remove('active'));
            document.getElementById(`${tabId}-tab`).classList.add('active');
        }

        function updateTicketCount(value) {
            ticketCount += value;
            if (ticketCount < 0) ticketCount = 0;

            document.getElementById('ticket-count').textContent = ticketCount;

            const pilihTiket = document.getElementById('pilih-tiket');
            if (ticketCount > 0) {
                pilihTiket.style.display = 'none';
            } else {
                pilihTiket.style.display = 'block';
            }
        }
    </script>
@endsection
