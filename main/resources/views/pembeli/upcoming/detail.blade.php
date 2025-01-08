@extends('layouts.pembeli-penjual-guess.master2') <!-- Ganti sesuai dengan layout Anda -->

@section('tiket')
    <section class="container my-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('pembeli-index')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('upcoming.detail',['event'=>$event->id])}}">Pertunjukan Konser</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$event->nama_event}}</li>
            </ol>
        </nav>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Konten Utama -->
        <div class="row">
            <!-- Bagian Kiri -->
            <div class="col-lg-8">
                <div class="rounded shadow-sm p-4 bg-white">
                    @if($event->denah)
                        <img src="{{$event->denah}}" class="card-img-top" alt="Event Image">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                            <span>(TEMPAT DUDUK)</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Bagian Kanan -->
            <div class="col-lg-4">
                <div class="rounded shadow-sm p-4 bg-white mb-4">
                    <h5 class="fw-bold mb-2">{{$event->nama_event}}</h5>
                    <p class="mb-2"><i class="fa fa-calendar-alt"></i>
                        {{\Carbon\Carbon::parse($event->tanggal_mulai)->locale('id')->format('d F')}} - 
                        {{\Carbon\Carbon::parse($event->tanggal_selesai)->locale('id')->format('d F Y')}}
                    </p>
                    <p class="mb-2"><i class="fa fa-clock"></i> <a href="#" class="text-primary">Lihat jadwal</a></p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt"></i> {{$event->lokasi}}</p>
                    <hr>
                    <p class="text-muted mt-3">Diselenggarakan oleh:</p>
                    <p><strong><i class="fa-solid fa-user"></i> {{$event->nama_kontak}}</strong></p>
                    <p><strong><i class="fa-solid fa-envelope"></i> {{$event->email_kontak}}</strong></p>
                    <p><strong><i class="fa-solid fa-phone"></i> {{$event->tlp_kontak}}</strong></p>
                </div>
                <div class="rounded shadow-sm p-4 bg-white">
                    <div id="pilih-tiket" class="text-center">
                        <p class="text-muted mb-2">Kamu belum memilih tiket. Silahkan pilih terlebih dahulu.</p>
                        <p class="fw-bold">Harga mulai dari</p>
                        <h4 class="fw-bold text-primary">Rp. xxx.xxx,xx</h4>
                    </div>
                    <h2 class="text-center mt-2 font-weight-bold">Setiap Pembeli hanya dapat membeli 
                        <span class="text-danger mx-2">{{$event->pembelian_maksimum}}</span> Tiket
                    </h2>
                    <button type="button" id="beli-tiket-btn" 
                    class="btn btn-primary w-100 py-2 mt-3" onclick="submitForm()" disabled>Beli Tiket</button>

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
                    <h6 class="fw-bold mb-3">Syarat & Ketentuan</h6>
                    {{-- <ul>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Minus quis asperiores similique quo modi.</li>
                        <li>Fugit modi vel praesentium sunt, minima culpa atque.</li>
                    </ul> --}}
                    {{$event->syarat_ketentuan}}
                </div>

                <!-- Tiket -->
                <div id="tiket" class="tab-pane fade">
                    <form action="{{ route('simpan-pembelian') }}" method="post" id="ticketForm">
                        @csrf
                        @foreach ($tikets as $index=>$tiket)
                            <h6 class="fw-bold my-3">
                                <i class="fa fa-calendar-alt"></i> DAY - {{$index+1}} 
                                ({{\Carbon\Carbon::parse($tiket->tanggal_mulai)->locale('id')->format('d F - h:m')}})
                            </h6>
                            <!-- Tiket Card -->
                            <div class="d-flex flex-column shadow rounded-lg p-4 mb-4" style="background: #fff; border: 1px solid #ddd;">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5 class="fw-bold mb-1">{{$tiket->nama_tiket}}</h5>
                                        <p class="text-muted mb-0"><i class="fa fa-calendar-alt"></i> {{\Carbon\Carbon::parse($tiket->tanggal_mulai)->locale('id')->format('d F Y - h:m')}}</p>
                                    </div>
                                    <div>
                                        <h4 class="fw-bold text-primary mb-0">Rp. {{ number_format($tiket->harga, 0, ',', '.') }}</h4>
                                    </div>
                                </div>

                                <hr style="margin: 20px 0; border-top: 1px dashed #ddd;">

                                <div class="d-flex justify-content-between align-items-center" id="ticket-{{$tiket->id}}">
                                    <div>
                                        <p class="text-muted mb-0">Kode Tiket: <span class="fw-bold">{{$tiket->id}}</span></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-outline-primary btn-sm mx-2" onclick="updateTicketCount('{{$tiket->id}}', -1)">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input type="number" class="no-spinner" name="tickets[{{ $tiket->id }}]" 
                                        id="ticket-count-{{ $tiket->id }}" max="{{$event->pembelian_maksimum}}" value="{{old('tickets.' . $tiket->id,0)}}">
                                        <button type="button" class="btn btn-outline-primary btn-sm mx-2" onclick="updateTicketCount('{{$tiket->id}}', 1)">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>                            
                            </div>
                        @endforeach
                    </form>                    
                </div>
            </div>
        </div>
    </section>

    <script>
        function submitForm() {
            document.getElementById('ticketForm').submit();
        }

        function showTab(tabId) {
            document.querySelectorAll('.tab-pane').forEach(tab => tab.classList.remove('show', 'active'));
            document.getElementById(tabId).classList.add('show', 'active');

            document.querySelectorAll('.btn-outline-primary').forEach(btn => btn.classList.remove('active'));
            document.getElementById(`${tabId}-tab`).classList.add('active');
        }

        var ticketCounts = {};

        function updateTicketCount(ticketId, value) {
            const inputElement = document.getElementById(`ticket-count-${ticketId}`);
            const currentValue = parseInt(inputElement.value) || 0;
            const maxValue = parseInt(inputElement.max) || 5;
            const minValue = parseInt(inputElement.min) || 0;

            // Hitung nilai baru
            let newValue = currentValue + value;

            // Batasi nilai di antara min dan max
            if (newValue > maxValue) newValue = maxValue;
            if (newValue < minValue) newValue = minValue;

            // Perbarui nilai input dan objek ticketCounts
            inputElement.value = newValue;
            ticketCounts[ticketId] = newValue;

            // Hapus dari objek jika nilai 0
            if (newValue === 0) {
                delete ticketCounts[ticketId];
            }

            updateBeliTiketButton();
        }
        
        function updateBeliTiketButton() {
            const beliTiketBtn = document.getElementById('beli-tiket-btn');
            const pilihTiket = document.getElementById('pilih-tiket');
            if (Object.values(ticketCounts).some(count => count > 0)) {
                pilihTiket.style.display = 'none';
                beliTiketBtn.disabled = false;
            } else {
                pilihTiket.style.display = 'block';
                beliTiketBtn.disabled = true;
            }
        }
    </script>
@endsection
