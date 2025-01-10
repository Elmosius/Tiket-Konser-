@extends('pembeli.landing2')

@section('element')
    <div class="container my-5 px-5">
        <h1 class="w-full text-2xl font-bold mb-3">Riwayat Pembelian</h1>
        <div class="row mt-4">
            @if (count($pembelians) > 0)
                @foreach ($pembelians as $pembelian)
                    <div class="col-sm-6 col-lg-4 mb-4">
                        <div class="card shadow">
                            @if ($pembelian->details->first()->tiket->event->banner ?? false)
                                <img src="{{ $pembelian->details->first()->tiket->event->banner }}" class="card-img-top"
                                    alt="Event Banner" style="object-fit: cover; height:200px">
                            @else
                                <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Default Banner"
                                    style="object-fit: cover; height:200px">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">Pembelian ID: {{ $pembelian->id }}</h5>
                                <p>Total: Rp{{ number_format($pembelian->total, 2, ',', '.') }}</p>
                                <p>Status:
                                    @if ($pembelian->status == 0)
                                        <span class="badge bg-danger mb-2">Belum Lunas</span>
                                    @else
                                        <span class="badge bg-success">Lunas</span>

                                        @foreach ($pembelian->details as $detail)
                                            <p>
                                                {{ $detail->tiket->nama_tiket }} : {{ $detail->jumlah }}
                                            </p>
                                        @endforeach
                                    @endif
                                </p>
                                @if ($pembelian->status == 0)
                                    <a href="{{ route('pemesanan-create', ['pembelian' => $pembelian->id]) }}"
                                        class="btn btn-outline-dark mt-2">
                                        Lakukan Pembayaran
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center ">
                    <div class="alert alert-info">
                        <h5 class="alert-heading">Belum Ada Pembelian</h5>
                        <p>Anda belum memiliki riwayat pembelian tiket. Klik tombol di bawah untuk melakukan pembelian
                            tiket.</p>
                        <a href="{{ route('pembeli-index') }}" class="btn btn-primary mt-3">
                            Beli Tiket Sekarang
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
