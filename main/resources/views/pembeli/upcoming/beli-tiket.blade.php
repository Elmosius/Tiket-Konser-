@extends('layouts.pembeli-penjual-guess.master3')

@section('beli-tiket')
    <section class="container my-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pembeli-index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pemesanan-index') }}">Pemesanan Tiket</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('pemesanan-create', ['pembelian' => $pembelian->id]) }}">
                        {{ $event->nama_event }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Detail Pemesanan -->
            <div class="col-lg-8 ">
                <h5 class="fw-bold mb-3">Detail Pemesanan</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
                    <div class="row g-0">
                        <!-- Gambar -->
                        <div class="col-md-4">
                            @if ($event->banner)
                                <img src="{{ $event->banner }}" class="card-img-top" alt="Event Image">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                    style="height: 150px;">
                                    <span>(Gambar Event)</span>
                                </div>
                            @endif
                        </div>
                        <!-- Info Tanggal, Waktu, Lokasi -->
                        <div class="col-md-8">
                            <div class="card-body ">
                                <p class="mb-2">
                                    <i class="fa fa-calendar-alt me-2"></i>
                                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->locale('id')->format('d F') }}
                                    -
                                    {{ \Carbon\Carbon::parse($event->tanggal_selesai)->locale('id')->format('d F Y') }}
                                </p>
                                <p class="mb-2">
                                    <i class="fa fa-clock me-2"></i>
                                    {{ \Carbon\Carbon::parse($event->tanggal_mulai)->locale('id')->format('H:i') }}
                                    - {{ \Carbon\Carbon::parse($event->tanggal_selesai)->locale('id')->format('H:i') }}
                                </p>
                                <p class="mb-2">
                                    <i class="fa fa-map-marker-alt me-2"></i> {{ $event->lokasi }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <h5 class="fw-bold mb-3 mt-5">Metode Pembayaran</h5>
                <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">

                    <form action="{{ route('pemesanan-update', ['pembelian' => $pembelian->id]) }}" method="post"
                        id="ticketForm">
                        @csrf
                        <div class="accordion" id="paymentMethods">
                            <!-- Accordion Item: E-Wallet -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEwallet">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseEwallet" aria-expanded="true"
                                        aria-controls="collapseEwallet">
                                        E-Wallet
                                    </button>
                                </h2>
                                <div id="collapseEwallet" class="accordion-collapse collapse show"
                                    aria-labelledby="headingEwallet" data-bs-parent="#paymentMethods">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="paymentMethod"
                                                    value="DANA" required>
                                                <label class="form-check-label d-flex align-items-center">
                                                    <img src="{{ asset('assets/icons/dana.svg') }}" alt="DANA"
                                                        style="width: 50px;" class="me-2">
                                                    DANA
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="paymentMethod"
                                                    value="GoPay" required>
                                                <label class="form-check-label d-flex align-items-center">
                                                    <img src="{{ asset('assets/icons/gopay.png') }}" alt="GoPay"
                                                        style="width: 50px;" class="me-2">
                                                    GoPay
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="paymentMethod"
                                                    value="OVO" required>
                                                <label class="form-check-label d-flex align-items-center">
                                                    <img src="{{ asset('assets/icons/ovo.svg') }}" alt="OVO"
                                                        style="width: 50px;" class="me-2">
                                                    OVO
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="paymentMethod"
                                                    value="PayPal" required>
                                                <label class="form-check-label d-flex align-items-center">
                                                    <img src="{{ asset('assets/icons/paypal.png') }}" alt="PayPal"
                                                        style="width: 20px;" class="me-2">
                                                    PayPal
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item: Virtual Account -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingVA">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseVA" aria-expanded="false" aria-controls="collapseVA">
                                        Virtual Account
                                    </button>
                                </h2>
                                <div id="collapseVA" class="accordion-collapse collapse" aria-labelledby="headingVA"
                                    data-bs-parent="#paymentMethods">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="paymentMethod"
                                                    value="BCA VA" required>
                                                <label class="form-check-label d-flex align-items-center">
                                                    <img src="{{ asset('assets/icons/bca.png') }}" alt="BCA"
                                                        style="width: 50px;" class="me-2">
                                                    BCA VA
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="paymentMethod"
                                                    value="Mandiri VA" required>
                                                <label class="form-check-label d-flex align-items-center">
                                                    <img src="{{ asset('assets/icons/mandiri.svg') }}" alt="Mandiri"
                                                        style="width: 50px;" class="me-2">
                                                    Mandiri VA
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="paymentMethod"
                                                    value="BNI VA" required>
                                                <label class="form-check-label d-flex align-items-center">
                                                    <img src="{{ asset('assets/icons/bni.svg') }}" alt="BNI"
                                                        style="width: 50px;" class="me-2">
                                                    BNI VA
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item: Credit Card -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingCreditCard">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseCreditCard" aria-expanded="false"
                                        aria-controls="collapseCreditCard">
                                        Credit Card
                                    </button>
                                </h2>
                                <div id="collapseCreditCard" class="accordion-collapse collapse"
                                    aria-labelledby="headingCreditCard" data-bs-parent="#paymentMethods">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="paymentMethod"
                                                    value="VISA" required>
                                                <label class="form-check-label d-flex align-items-center">
                                                    <img src="{{ asset('assets/icons/visa.png') }}" alt="VISA"
                                                        style="width: 50px;" class="me-2">
                                                    VISA
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="paymentMethod"
                                                    value="MasterCard" required>
                                                <label class="form-check-label d-flex align-items-center">
                                                    <img src="{{ asset('assets/icons/mastercard.svg') }}"
                                                        alt="MasterCard" style="width: 50px;" class="me-2">
                                                    MasterCard
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Accordion -->
                    </form>
                </div>
            </div>

            <!-- Detail Harga -->
            <div class="col-lg-4">
                <div class="card p-3  shadow  mb-5 bg-body-tertiary rounded">
                    <h5 class="fw-bold mb-3">Detail Harga</h5>
                    @foreach ($detailPembelian as $detail)
                        <div class="mb-3 border-bottom pb-2">
                            <p class="mb-1 fw-bold">ID: {{ $detail->id }}</p>
                            <p class="mb-0">
                                {{ $detail->tiket->nama_tiket }} - Jumlah: {{ $detail->jumlah }}
                            </p>
                            <span class="d-block">
                                Rp. {{ number_format($detail->tiket->harga, 0, ',', '.') }}
                            </span>
                            <span class="fw-semibold text-success">
                                Total: Rp. {{ number_format($detail->jumlah * $detail->tiket->harga, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Total Bayar</span>
                        <span class="fw-bold text-primary">
                            Rp. {{ number_format($pembelian->total, 0, ',', '.') }}
                        </span>
                    </div>
                    <hr>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="agreeTerms">
                        <label class="form-check-label" for="agreeTerms">
                            Saya setuju dengan
                            <a href="#" class="text-decoration-underline">Syarat & Ketentuan</a>
                            yang berlaku di YukNonton.com
                        </label>
                    </div>
                    <button class="btn btn-primary w-100" disabled id="payButton" onclick="submitForm()">
                        Beli Sekarang
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra-js')
    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const agreeTerms = document.getElementById('agreeTerms');
            const payButton = document.getElementById('payButton');

            // Aktifkan tombol jika checkbox dicentang
            agreeTerms.addEventListener('change', function() {
                payButton.disabled = !this.checked;
            });

            // Tombol "Beli Sekarang"
            payButton.addEventListener('click', function() {
                Swal.fire({
                    title: 'Konfirmasi Pembayaran',
                    text: 'Apakah Anda yakin ingin melanjutkan pembayaran?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Lanjutkan',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Pembayaran Berhasil',
                            text: 'Terima kasih, pembayaran Anda telah berhasil.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('ticketForm').submit();
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
