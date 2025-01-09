@extends('pembeli.landing')

@section('element')
    <div class="flex justify-between items-center">
        <!-- Judul -->
        <h2 class="text-xl font-bold">Acara yang tersedia</h2>

        <!-- Dropdowns (Di sebelah kanan) -->
        <div class="flex gap-2 ml-auto">
            <!-- Kategori Dropdown -->
            <select class="bg-blue-500 text-white rounded-full border border-gray-700 px-4 py-2 focus:ring focus:ring-blue-300" 
                aria-label="kategori" id="filterKategori">
                <option selected>Kategori</option>
                <option value="all">Semua</option>
                <option value="bayar">Berbayar</option>
                <option value="gratis">Gratis</option>
            </select>

            <!-- Hari Dropdown -->
            <select class="bg-blue-500 text-white rounded-full border border-gray-700 px-4 py-2 focus:ring focus:ring-blue-300" 
                aria-label="hari" id="filterHari">
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
        @foreach ($events as $event)
        <div class="col-sm-6 col-lg-4 mb-4">
                <a href="{{ route('upcoming.detail',['event'=>$event->id]) }}">
                    <div class="card">
                        @if($event->banner)
                            <img src="{{$event->banner}}" class="card-img-top" alt="Event Image" width="400" height="200">
                        @else
                            <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Event Image">
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="text-muted font-weight-bold mb-1">{{\Carbon\Carbon::parse($event->tanggal_mulai)->format('d-m-Y')}}</p>
                                <p class="text-muted font-weight-bold mb-1">{{\Carbon\Carbon::parse($event->tanggal_mulai)->diffForHumans()}}</p>
                            </div>
                            <h5 class="card-title">{{$event->nama_event}}</h5>
                            <p class="card-text">{{$event->deskripsi}}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
    </div>
@endsection