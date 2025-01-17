@extends('layouts.admin.master')

@section('css-tambahan')
    <style>
        .gambar-unggah {
            background-color: gray;
            height: 300px;
            background-size: cover;
            background-position: center;
        }

        .switch-large .form-check-input {
            width: 2rem;
            height: 1rem;
            transform: scale(1.5);
        }
    </style>
@endsection

@section('isi-konten-dashboard')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('event-store') }}" class="p-4" id="event_form" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12">
            <div class="card">
                <div class="card-img-top gambar-unggah text-center d-flex justify-content-center align-items-center"
                    id="gambarUnggah">
                    <div class="row text-white">
                        <div class="col-md-12 mb-3">
                            <a href="#" class="btn btn-dark p-0" id="uploadButton">
                                <svg xmlns="http://www.w3.org/2000/svg" width='50' height="50" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </a>
                            <input type="file" id="fileInput" accept="image/*" style="display: none;" name="banner">
                        </div>
                        <div class="col-md-12">
                            <h5 class="text-white">
                                Unggah gambar/poster/banner
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row mb-3 input-group d-flex justify-content-center">
                        <div class="col-md-5 mb-3">
                            <label for="nama_event" class="form-label fw-semibold">Nama Event</label>
                            <input type="text" class="form-control " id="nama_event" name="nama_event" autofocus required
                                value="{{old('nama_event')}}" placeholder="Masukkan nama eventmu!">
                            <div class=" invalid-feedback">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="jenis_event" class="form-label fw-semibold">Jenis Event</label>
                            <select class="form-select" name="jenis_event" required>
                                <option selected>Open this select menu</option>
                                <option value="1" {{ old('jenis_event') == 1 ? 'selected' : '' }}>Public: Event kamu akan tampil di halaman Cari Event</option>
                                <option value="0" {{ old('jenis_event') == 0 ? 'selected' : '' }}>Private: Event kamu hanya diakses oleh orang tertentu</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md">
                                    <label for="tanggal_mulai" class="form-label fw-semibold">Tanggal & Waktu Mulai</label>
                                    <input type="datetime-local" class="form-control " id="tanggal_mulai"
                                        name="tanggal_mulai" required value="{{old('tanggal_mulai')}}">
                                    <div class="invalid-feedback">
                                        Harap masukkan tanggal dan waktu mulai yang valid.
                                    </div>
                                </div>

                                <div class="col-md">
                                    <label for="tanggal_akhir" class="form-label fw-semibold">Tanggal & Waktu
                                        Selesai</label>
                                    <input type="datetime-local" class="form-control" id="tanggal_akhir"
                                        name="tanggal_akhir" required value="{{old('tanggal_akhir')}}">
                                    <div class="invalid-feedback">
                                        Harap masukkan tanggal dan waktu selesai yang valid.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md"></div>
                            </div>
                            <div class="row">
                                <div class="col-md mt-md-2">
                                    <label for="lokasi" class="form-label fw-semibold">Lokasi lengkap</label>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" required value="{{old('lokasi')}}">
                                    <div class="invalid-feedback">
                                        Harap masukkan lokasi yang valid.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="tiket" class="form-label fw-semibold">Kategori Tiket</label>
                            <div class="row mb-3">
                                <button type="button" class="ms-md-3 rounded btn btn-outline-primary text-start"
                                    id="buatTiket">
                                    <span>
                                        Buat tiket
                                    </span>
                                </button>
                            </div>
                            {{-- <div class="row mb-3">
                                <button type="button" class="ms-md-3 rounded btn btn-outline-primary text-start tombolClick"
                                    id="gratis">
                                    <span>
                                        Buat tiket: Gratis
                                    </span>
                                </button>
                            </div> --}}

                            <div id="tiketContainer" class="row">
                            </div>
                        </div>
                    </div>

                    <!-- Modal untuk tiket -->
                    {{-- <div class="modal fade" id="modalTiket" tabindex="-1" aria-labelledby="modalTiketLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTiketBerbayarLabel">Detail Tiket</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama_tiket[]" class="form-label">Nama Tiket</label>
                                        <input type="text" class="form-control" id="nama_tiket"
                                            name="nama_tiket[]" value="{{old("nama_tiket")}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
                                        <input type="number" class="form-control" id="jumlah_tiket"
                                            name="jumlah_tiket" min="1" value="{{old("jumlah_tiket")}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga_tiket" class="form-label">Harga</label>
                                        <input type="number" class="form-control" id="harga_tiket"
                                            name="harga_tiket" value="0">
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi_tiket" class="form-label">Deskripsi
                                            Tiket</label>
                                        <textarea class="form-control" id="deskripsi_tiket" name="deskripsi_tiket" rows="3"
                                            autofocus></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_mulai_tiket" class="form-label">Tanggal & Waktu
                                            Mulai
                                            Penjualan</label>
                                        <input type="datetime-local" class="form-control"
                                            id="tanggal_mulai_tiket" name="tanggal_mulai_tiket"
                                           >
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_selesai_tiket" class="form-label">Tanggal & Waktu
                                            Selesai Penjualan</label>
                                        <input type="datetime-local" class="form-control"
                                            id="tanggal_selesai_tiket" name="tanggal_selesai_tiket"
                                           >
                                    </div>
                                    <button type="button" class="btn btn-primary" id="simpanTiket">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div id="childTiket">
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-md-11 mt-md-2">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi Event</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required
                                placeholder="Deskripsikan eventmu!">{{ old('deskripsi') }}</textarea>
                            <div class="invalid-feedback">
                                Harap masukkan deskripsi yang valid.
                            </div>
                        </div>

                        <div class="col-md-11 mt-md-2">
                            <label for="syarat_ketentuan" class="form-label fw-semibold">Syarat & Ketentuan</label>
                            <textarea class="form-control" id="syarat_ketentuan" name="syarat_ketentuan" rows="5" required
                                placeholder="Tuliskan syarat dan ketentuan eventmu!">{{ old('syarat_ketentuan') }}</textarea>
                            <div class="invalid-feedback">
                                Harap masukkan deskripsi yang valid.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <span class="h5 fw-bold">
                Informasi Kontak
            </span>
            <p class="">
                Informasi narahubung yang dapat dihubungi oleh pembeli akan muncul di E-Ticket.
            </p>
        </div>


        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center ">
                        <div class="col-md-5 mt-md-2">
                            <label for="nama_kontak" class="form-label fw-semibold">Nama kontak</label>
                            <input type="text" class="form-control" id="nama_kontak" name="nama_kontak"
                                placeholder="Cth. Budi" required value="{{ old('nama_kontak') }}">
                            <div class="invalid-feedback">
                                Harap masukkan nama yang valid.
                            </div>
                        </div>

                        <div class="col-md-5 mt-md-2">
                            <label for="email_kontak" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" id="email_kontak" name="email_kontak"
                                placeholder="xx@gmail.com" required value="{{ old('email_kontak') }}">
                            <div class="invalid-feedback">
                                Harap masukkan email yang valid.
                            </div>
                        </div>

                        <div class="col-md-10 mt-md-2">
                            <label for="tlp_kontak" class="form-label fw-semibold">Nomor Telepon</label>
                            <input type="text" class="form-control" id="tlp_kontak" name="tlp_kontak"
                                placeholder="Cth. 08123123123" required value="{{ old('tlp_kontak') }}">
                            <div class="invalid-feedback">
                                Harap masukkan no Telepon yang valid.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mb-5">
            <label class="h5 mb-4 fw-bold">
                Pengaturan Tambahan
            </label>

            <div class="col-md">
                <label class="h6 fw-bold">
                    Gambar denah lokasi tempat duduk
                </label>
                <input type="file" class="form-control" id="denah" name="denah">
            </div>
            <div class="col-md">
                <label class="h6 fw-bold">
                    Jumlah maks. tiket per transaksi
                </label>
                <select class="form-select" name="pembelian_maksimum" required>
                    <option value="" selected>Open this select menu</option>
                    <option value="5" {{ old('pembelian_maksimum') == 5 ? 'selected' : '' }}>5 tiket</option>
                    <option value="4" {{ old('pembelian_maksimum') == 4 ? 'selected' : '' }}>4 tiket</option>
                    <option value="3" {{ old('pembelian_maksimum') == 3 ? 'selected' : '' }}>3 tiket</option>
                    <option value="2" {{ old('pembelian_maksimum') == 2 ? 'selected' : '' }}>2 tiket</option>
                    <option value="1" {{ old('pembelian_maksimum') == 1 ? 'selected' : '' }}>1 tiket</option>
                </select>
            </div>

            <div class="col-md">
                <label class="h6 fw-bold">
                    Satu email - satu transaksi (coming soon)
                </label>
                <div class="ms-2 form-check form-switch mt-3 switch-large">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="submitTiket">Create Event</button>
    </form>
@endsection


@section('js-tambahan')
    <script src="{{ asset('assets/js/tiket.js') }}"></script>
    <script>
        
        document.getElementById('uploadButton').addEventListener('click', function() {
            document.getElementById('fileInput').click();
        });

        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const gambarUnggah = document.getElementById('gambarUnggah');
                    gambarUnggah.style.backgroundImage = `url(${e.target.result})`;
                }
                reader.readAsDataURL(file);
            }
        });

        /* 
            buat validasi tanggal_mulai dan tanggal_selesai
        */
        const tanggalMulai = document.getElementById('tanggal_mulai');
        const tanggalSelesai = document.getElementById('tanggal_akhir');

        // Set minimum date and time for tanggal_mulai
        const now = new Date();
        const nowISO = now.toISOString().slice(0, 16);
        tanggalMulai.min = nowISO;

        // Set minimum date and time for tanggal_selesai based on tanggal_mulai
        tanggalMulai.addEventListener('change', function() {
            tanggalSelesai.min = tanggalMulai.value;
        });

        // Ensure tanggal_selesai is not before tanggal_mulai
        tanggalSelesai.addEventListener('change', function() {
            if (tanggalSelesai.value < tanggalMulai.value) {
                tanggalSelesai.value = tanggalMulai.value;
            }
        });

        /* 
            buat jenis kategori tiket
        */

        // Set minimum date and time for all datetime-local inputs
        const datetimeInputs = document.querySelectorAll('input[type="datetime-local"]');
        datetimeInputs.forEach(input => {
            input.min = nowISO;
        });

        // Ensure tanggal_selesai is not before tanggal_mulai for both modals
        const tanggalMulaiBerbayar = document.getElementById('tanggal_mulai_tiket_berbayar');
        const tanggalSelesaiBerbayar = document.getElementById('tanggal_selesai_tiket_berbayar');
        const tanggalMulaiGratis = document.getElementById('tanggal_mulai_tiket_gratis');
        const tanggalSelesaiGratis = document.getElementById('tanggal_selesai_tiket_gratis');

        tanggalMulaiBerbayar.addEventListener('change', function() {
            tanggalSelesaiBerbayar.min = tanggalMulaiBerbayar.value;
        });

        tanggalSelesaiBerbayar.addEventListener('change', function() {
            if (tanggalSelesaiBerbayar.value < tanggalMulaiBerbayar.value) {
                tanggalSelesaiBerbayar.value = tanggalMulaiBerbayar.value;
            }
        });

        tanggalMulaiGratis.addEventListener('change', function() {
            tanggalSelesaiGratis.min = tanggalMulaiGratis.value;
        });

        tanggalSelesaiGratis.addEventListener('change', function() {
            if (tanggalSelesaiGratis.value < tanggalMulaiGratis.value) {
                tanggalSelesaiGratis.value = tanggalMulaiGratis.value;
            }
        });
    </script>
@endsection
