@extends('layouts.pembeli-penjual-guess.master3')

@section('beli-tiket')
    <section class="container my-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/pertunjukan">Pertunjukan Konser</a></li>
                <li class="breadcrumb-item"><a href="/pertunjukan/contoh-a">Contoh A</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Detail Pemesanan -->
            <div class="col-lg-8">
                <h5 class="fw-bold mb-3">Detail Pemesanan</h5>
                <div class="rounded shadow-sm p-4 bg-white mb-4 d-flex">
                    <!-- Gambar -->
                    <div class="me-4" style="flex: 1;">
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                            <span>(Gambar Event)</span>
                        </div>
                    </div>
                    <!-- Tanggal, Waktu, dan Lokasi -->
                    <div style="flex: 2;">
                        <p class="mb-3"><i class="fa fa-calendar-alt"></i> 02 Nov - 03 Nov 2024</p>
                        <p class="mb-3"><i class="fa fa-clock"></i> 07:00 - selesai</p>
                        <p class="mb-3"><i class="fa fa-map-marker-alt"></i> Lokasinya</p>
                    </div>
                </div>

                <!-- Jenis Tiket -->
                <h6 class="fw-bold mt-4">Jenis Tiket</h6>
                <p class="text-muted">Lorem ipsum dolor sit amet</p>

                <!-- Metode Pembayaran -->
                <h5 class="fw-bold mb-3 mt-5">Metode Pembayaran</h5>
                <div class="accordion" id="paymentMethods">
                    <!-- E-Wallet -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="eWalletHeading">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEWallet" aria-expanded="true" aria-controls="collapseEWallet">
                                E-Wallet
                            </button>
                        </h2>
                        <div id="collapseEWallet" class="accordion-collapse collapse show" aria-labelledby="eWalletHeading" data-bs-parent="#paymentMethods">
                            <div class="accordion-body">
                                <ul class="list-unstyled payment-method-list">
                                    <li class="d-flex align-items-center payment-method-item mb-3" data-method="DANA">
                                        <img src="{{ asset('assets/icons/dana.svg') }}" alt="DANA" class="me-3" style="width: 30px;">
                                        <span>DANA</span>
                                    </li>
                                    <li class="d-flex align-items-center payment-method-item mb-3" data-method="GoPay">
                                        <img src="{{ asset('assets/icons/gopay.png') }}" alt="GoPay" class="me-3" style="width: 30px;">
                                        <span>GoPay</span>
                                    </li>
                                    <li class="d-flex align-items-center payment-method-item mb-3" data-method="OVO">
                                        <img src="{{ asset('assets/icons/ovo.svg') }}" alt="OVO" class="me-3" style="width: 30px;">
                                        <span>OVO</span>
                                    </li>
                                    <li class="d-flex align-items-center payment-method-item mb-3" data-method="PayPal">
                                        <img src="{{ asset('assets/icons/paypal.png') }}" alt="PayPal" class="me-3" style="width: 30px;">
                                        <span>PayPal</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Virtual Account -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="virtualAccountHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVirtualAccount" aria-expanded="false" aria-controls="collapseVirtualAccount">
                                Virtual Account
                            </button>
                        </h2>
                        <div id="collapseVirtualAccount" class="accordion-collapse collapse" aria-labelledby="virtualAccountHeading" data-bs-parent="#paymentMethods">
                            <div class="accordion-body">
                                <ul class="list-unstyled payment-method-list">
                                    <li class="d-flex align-items-center payment-method-item mb-3" data-method="BCA VA">
                                        <img src="{{ asset('assets/icons/bca.png') }}" alt="BCA" class="me-3" style="width: 30px;">
                                        <span>BCA VA</span>
                                    </li>
                                    <li class="d-flex align-items-center payment-method-item mb-3" data-method="Mandiri VA">
                                        <img src="{{ asset('assets/icons/mandiri.svg') }}" alt="Mandiri" class="me-3" style="width: 30px;">
                                        <span>Mandiri VA</span>
                                    </li>
                                    <li class="d-flex align-items-center payment-method-item mb-3" data-method="BNI VA">
                                        <img src="{{ asset('assets/icons/bni.svg') }}" alt="BNI" class="me-3" style="width: 30px;">
                                        <span>BNI VA</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Credit Card -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="creditCardHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCreditCard" aria-expanded="false" aria-controls="collapseCreditCard">
                                Credit Card
                            </button>
                        </h2>
                        <div id="collapseCreditCard" class="accordion-collapse collapse" aria-labelledby="creditCardHeading" data-bs-parent="#paymentMethods">
                            <div class="accordion-body">
                                <ul class="list-unstyled payment-method-list">
                                    <li class="d-flex align-items-center payment-method-item mb-3" data-method="VISA">
                                        <img src="{{ asset('assets/icons/visa.png') }}" alt="VISA" class="me-3" style="width: 30px;">
                                        <span>VISA</span>
                                    </li>
                                    <li class="d-flex align-items-center payment-method-item mb-3" data-method="MasterCard">
                                        <img src="{{ asset('assets/icons/mastercard.svg') }}" alt="Master
                                    <img src="{{ asset('assets/icons/mastercard.svg') }}" alt="MasterCard" class="me-3" style="width: 30px;">
                                        <span>MasterCard</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Harga -->
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">Detail Harga</h5>
                <div class="rounded shadow-sm p-4 bg-white">
                    <p class="d-flex justify-content-between">
                        <span>Harga mulai dari</span>
                        <span class="fw-bold">Rp. xxx.xxx,xx</span>
                    </p>
                    <p class="d-flex justify-content-between">
                        <span>Total Bayar</span>
                        <span class="fw-bold text-primary">Rp. xxx.xxx,xx</span>
                    </p>
                    <hr>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="agreeTerms">
                        <label class="form-check-label small" for="agreeTerms">
                            Saya setuju dengan <a href="#" class="text-primary">Syarat & Ketentuan</a> yang berlaku di
                            YukNonton.com
                        </label>
                    </div>
                    <button class="btn btn-primary w-100" disabled id="payButton">Beli Sekarang</button>
                </div>
            </div>
        </div>
    </section>

    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const agreeTerms = document.getElementById('agreeTerms');
            const payButton = document.getElementById('payButton');

            // Aktifkan tombol jika checkbox dicentang
            agreeTerms.addEventListener('change', function () {
                payButton.disabled = !this.checked;
            });

            // Tambahkan event listener untuk tombol "Beli Sekarang"
            payButton.addEventListener('click', function () {
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
                        });
                    }
                });
            });
        });
    </script>
@endsection
