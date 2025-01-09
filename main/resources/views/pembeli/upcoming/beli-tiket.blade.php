@extends('layouts.pembeli-penjual-guess.master3')

@section('beli-tiket')
    <section class="container my-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('pembeli-index')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('pemesanan-index')}}">Pemesanan Tiket</a></li>
                <li class="breadcrumb-item"><a href="{{route('pemesanan-create',['pembelian'=>$pembelian->id])}}">{{$event->nama_event}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
            </ol>
        </nav>
        
        <div class="row">
            <!-- Detail Pemesanan -->
            <div class="col-lg-8">
                <h5 class="fw-bold mb-3">Detail Pemesanan</h5>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="rounded shadow-sm p-4 bg-white mb-4 d-flex">
                    <!-- Gambar -->
                    <div class="me-4" style="flex: 1;">
                        @if($event->banner)
                            <img src="{{$event->banner}}" class="card-img-top" alt="Event Image">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                <span>(Gambar Event)</span>
                            </div>
                        @endif
                    </div>
                    <!-- Tanggal, Waktu, dan Lokasi -->
                    <div style="flex: 2;">
                        <p class="mb-3"><i class="fa fa-calendar-alt"></i>
                            {{\Carbon\Carbon::parse($event->tanggal_mulai)->locale('id')->format('d F')}} - 
                            {{\Carbon\Carbon::parse($event->tanggal_selesai)->locale('id')->format('d F Y')}}
                        </p>
                        <p class="mb-3"><i class="fa fa-clock"></i> 
                            {{\Carbon\Carbon::parse($event->tanggal_mulai)->locale('id')->format('h:m')}} 
                            - {{\Carbon\Carbon::parse($event->tanggal_selesai)->locale('id')->format('h:m')}}</p>
                         <p class="mb-3"><i class="fa fa-map-marker-alt"></i> {{$event->lokasi}}</p>
                    </div>
                </div>

                {{-- <h5 class="fw-bold mb-3 mt-5">Metode Pembayaran</h5>
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
                </div> --}}
                
                <!-- Metode Pembayaran -->
                <h5 class="fw-bold mb-3 mt-5">Metode Pembayaran</h5>
                <div class="accordion" id="paymentMethods">
                    <form action="{{ route('pemesanan-update',['pembelian'=>$pembelian->id]) }}" method="post" id="ticketForm">
                        @csrf
                        <!-- E-Wallet -->
                        <div class="payment-method mb-3">
                            <h3>E-Wallet</h3>
                            <div class="d-flex mt-2">
                                <input type="radio" name="paymentMethod" value="DANA" class="form-check-input" required>
                                <label class="form-check-label d-flex">
                                    <img src="{{ asset('assets/icons/dana.svg') }}" alt="DANA" style="width: 50px;" class="ms-3">
                                    <span class="ms-3">DANA</span>
                                </label>
                            </div>
                            <div class="d-flex mt-2">
                                <input type="radio" name="paymentMethod" value="GoPay" class="form-check-input" required>
                                <label class="form-check-label d-flex">
                                    <img src="{{ asset('assets/icons/gopay.png') }}" alt="GoPay" style="width: 50px;" class="ms-3">
                                    <span class="ms-3">GoPay</span>
                                </label>
                            </div>
                            <div class="d-flex mt-2">
                                <input type="radio" name="paymentMethod" value="OVO" class="form-check-input" required>
                                <label class="form-check-label d-flex">
                                    <img src="{{ asset('assets/icons/ovo.svg') }}" alt="OVO" style="width: 50px;" class="ms-3">
                                    <span class="ms-3">OVO</span>
                                </label>
                            </div>
                            <div class="d-flex mt-2">
                                <input type="radio" name="paymentMethod" value="PayPal" class="form-check-input" required>
                                <label class="form-check-label d-flex">
                                    <img src="{{ asset('assets/icons/paypal.png') }}" alt="PayPal" style="width: 20px;" class="ms-3">
                                    <span class="ms-3">PayPal</span>
                                </label>
                            </div>
                        </div>
                    
                        <!-- Virtual Account -->
                        <div class="payment-method mb-3">
                            <h3>Virtual Account</h3>
                            <div class="d-flex mt-3">
                                <input type="radio" name="paymentMethod" value="BCA VA" class="form-check-input" required>
                                <label class="form-check-label d-flex">
                                    <img src="{{ asset('assets/icons/bca.png') }}" alt="BCA" style="width: 50px;" class="ms-3">
                                    <span class="ms-3">BCA VA</span>
                                </label>
                            </div>
                            <div class="d-flex mt-2">
                                <input type="radio" name="paymentMethod" value="Mandiri VA" class="form-check-input" required>
                                <label class="form-check-label d-flex">
                                    <img src="{{ asset('assets/icons/mandiri.svg') }}" alt="Mandiri" style="width: 50px;" class="ms-3">
                                    <span class="ms-3">Mandiri VA</span>
                                </label>
                            </div>
                            <div class="d-flex mt-2">
                                <input type="radio" name="paymentMethod" value="BNI VA" class="form-check-input" required>
                                <label class="form-check-label d-flex">
                                    <img src="{{ asset('assets/icons/bni.svg') }}" alt="BNI" style="width: 50px;" class="ms-3">
                                    <span class="ms-3">BNI VA</span>
                                </label>
                            </div>
                        </div>
                    
                        <!-- Credit Card -->
                        <div class="payment-method mb-3">
                            <h3>Credit Card</h3>
                            <div class="d-flex mt-2">
                                <input type="radio" name="paymentMethod" value="VISA" class="form-check-input" required>
                                <label class="form-check-label d-flex">
                                    <img src="{{ asset('assets/icons/visa.png') }}" alt="VISA" style="width: 50px;" class="ms-3">
                                    <span class="ms-3">VISA</span>
                                </label>
                            </div>
                            <div class="d-flex mt-2">
                                <input type="radio" name="paymentMethod" value="MasterCard" class="form-check-input" required>
                                <label class="form-check-label d-flex">
                                    <img src="{{ asset('assets/icons/mastercard.svg') }}" alt="MasterCard" style="width: 50px;" class="ms-3">
                                    <span class="ms-3">MasterCard</span>
                                </label>
                            </div>
                        </div>
                    </form>     
                </div>
            </div>

            <!-- Detail Harga -->
            <div class="col-lg-4">
                <h5 class="font-bold mb-3">Detail Harga</h5>
                <div class="rounded-lg shadow-sm p-4 bg-white">
                    @foreach ($detailPembelian as $detail)
                        <div class="mb-4 p-4 border-b border-gray-200">
                            <p class="text-sm font-bold text-gray-700">ID: {{ $detail->id }}</p>
                            <p class="text-md text-blue-800">{{ $detail->tiket->nama_tiket }} - Jumlah: {{ $detail->jumlah }}</p>
                            <span class="text-sm text-gray-600">Rp. {{ number_format($detail->tiket->harga, 0, ',', '.') }}</span>
                            <br>
                            <span class="font-semibold text-green-700">Total : Rp. {{ number_format($detail->jumlah * $detail->tiket->harga, 0, ',', '.') }}</span>
                        </div>
                    @endforeach 

                    <div class="flex justify-between items-center mt-2">
                        <span>Total Bayar</span>
                        <span class="font-bold text-blue-600">Rp. {{number_format($pembelian->total, 0, ',', '.')}}</span>
                    </div>
                    <hr class="my-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="agreeTerms">
                        <label class="form-check-label text-sm" for="agreeTerms">
                            Saya setuju dengan <a href="#" class="text-blue-600 hover:text-blue-800">Syarat & Ketentuan</a> yang berlaku di YukNonton.com
                        </label>
                    </div>
                    <button class="btn btn-primary w-full" disabled id="payButton" onclick="submitForm()">Beli Sekarang</button>
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
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('ticketForm').submit(); // Pastikan ini benar ID formnya
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
