@extends('layouts.admin.master')

@section('css-tambahan')
    <style>
        .gambar-unggah {
            background-color: gray;
            height: 300px;
            background-size: cover;
            background-position: center;
        }
    </style>
@endsection

@section('isi-konten-dashboard')
    <form method="post" action="/dashboard/rekening" class="p-4">
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
                            <input type="file" id="fileInput" accept="image/*" style="display: none;">
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
                            <label for="nama" class="form-label fw-semibold">Nama Event</label>
                            <input type="text" class="form-control " id="nama" name="nama" autofocus required
                                value="" placeholder="Masukkan nama eventmu!">
                            <div class=" invalid-feedback">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="bank" class="form-label fw-semibold">Jenis Event</label>
                            <select class="form-select" name="bank" required>
                                <option selected>Open this select menu</option>
                                <option value="1">Public: Event kamu akan tampil di halaman Cari Event</option>
                                <option value="2">Private: Event kamu hanya diakses oleh orang tertentu</option>
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
                                        name="tanggal_mulai" required>
                                    <div class="invalid-feedback">
                                        Harap masukkan tanggal dan waktu mulai yang valid.
                                    </div>
                                </div>

                                <div class="col-md">
                                    <label for="tanggal_selesai" class="form-label fw-semibold">Tanggal & Waktu
                                        Selesai</label>
                                    <input type="datetime-local" class="form-control" id="tanggal_selesai"
                                        name="tanggal_selesai" required>
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
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                                    <div class="invalid-feedback">
                                        Harap masukkan lokasi yang valid.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="lokasi" class="form-label fw-semibold">Kategori Tiket</label>
                            <div class="row mb-3">
                                <a href="#" class="ms-md-3 rounded btn btn-outline-primary text-start"
                                    data-bs-toggle="modal" data-bs-target="#modalTiketBerbayar">
                                    <span>
                                        Buat tiket: Berbayar
                                    </span>
                                </a>
                            </div>
                            <div class="row">
                                <a href="#" class="ms-md-3 rounded btn btn-outline-primary text-start"
                                    data-bs-toggle="modal" data-bs-target="#modalTiketGratis">
                                    <span>
                                        Buat tiket: Gratis
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Modal untuk tiket berbayar -->
                    <div class="modal fade" id="modalTiketBerbayar" tabindex="-1" aria-labelledby="modalTiketBerbayarLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTiketBerbayarLabel">Detail Tiket Berbayar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama_tiket_berbayar" class="form-label">Nama Tiket</label>
                                        <input type="text" class="form-control" id="nama_tiket_berbayar"
                                            name="nama_tiket_berbayar" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah_tiket_berbayar" class="form-label">Jumlah Tiket</label>
                                        <input type="number" class="form-control" id="jumlah_tiket_berbayar"
                                            name="jumlah_tiket_berbayar" min="1" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga_tiket_berbayar" class="form-label">Harga</label>
                                        <input type="number" class="form-control" id="harga_tiket_berbayar"
                                            name="harga_tiket_berbayar" value="0" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi_tiket_berbayar" class="form-label">Deskripsi
                                            Tiket</label>
                                        <textarea class="form-control" id="deskripsi_tiket_berbayar" name="deskripsi_tiket_berbayar" rows="3" required
                                            autofocus></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_mulai_tiket_berbayar" class="form-label">Tanggal & Waktu
                                            Mulai
                                            Penjualan</label>
                                        <input type="datetime-local" class="form-control"
                                            id="tanggal_mulai_tiket_berbayar" name="tanggal_mulai_tiket_berbayar"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_selesai_tiket_berbayar" class="form-label">Tanggal & Waktu
                                            Selesai Penjualan</label>
                                        <input type="datetime-local" class="form-control"
                                            id="tanggal_selesai_tiket_berbayar" name="tanggal_selesai_tiket_berbayar"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal untuk tiket gratis -->
                    <div class="modal fade" id="modalTiketGratis" tabindex="-1" aria-labelledby="modalTiketGratisLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTiketGratisLabel">Detail Tiket Gratis</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama_tiket_gratis" class="form-label">Nama Tiket</label>
                                        <input type="text" class="form-control" id="nama_tiket_gratis"
                                            name="nama_tiket_gratis" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah_tiket_gratis" class="form-label">Jumlah Tiket</label>
                                        <input type="number" class="form-control" id="jumlah_tiket_gratis"
                                            name="jumlah_tiket_gratis" min="1" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga_tiket_gratis" class="form-label">Harga</label>
                                        <input type="number" class="form-control" id="harga_tiket_gratis"
                                            name="harga_tiket_gratis" value="0" readonly autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi_tiket_gratis" class="form-label">Deskripsi Tiket</label>
                                        <textarea class="form-control" id="deskripsi_tiket_gratis" name="deskripsi_tiket_gratis" rows="3" required
                                            autofocus></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_mulai_tiket_gratis" class="form-label">Tanggal & Waktu
                                            Mulai
                                            Penjualan</label>
                                        <input type="datetime-local" class="form-control" id="tanggal_mulai_tiket_gratis"
                                            name="tanggal_mulai_tiket_gratis" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_selesai_tiket_gratis" class="form-label">Tanggal & Waktu
                                            Selesai Penjualan</label>
                                        <input type="datetime-local" class="form-control"
                                            id="tanggal_selesai_tiket_gratis" name="tanggal_selesai_tiket_gratis"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-md-11 mt-md-2">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi Event</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required
                                placeholder="Deskripsikan eventmu!"></textarea>
                            <div class="invalid-feedback">
                                Harap masukkan deskripsi yang valid.
                            </div>
                        </div>

                        <div class="col-md-11 mt-md-2">
                            <label for="syarat_ketentuan" class="form-label fw-semibold">Syarat & Ketentuan</label>
                            <textarea class="form-control" id="syarat_ketentuan" name="syarat_ketentuan" rows="5" required
                                placeholder="Tuliskan syarat dan ketentuan eventmu!"></textarea>
                            <div class="invalid-feedback">
                                Harap masukkan deskripsi yang valid.
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row d-flex justify-content-center">
                        <div class="col-md-5 mb-3">
                            <label for="lokasi" class="form-label fw-semibold">Lokasi lengkap</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                            <div class="invalid-feedback">
                                Harap masukkan lokasi yang valid.
                            </div>
                        </div>
                    </div> --}}
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
                            <label for="nama_narahubung" class="form-label fw-semibold">Nama Narahubung</label>
                            <input type="text" class="form-control" id="nama_narahubung" name="nama_narahubung"
                                placeholder="Cth. Budi" required>
                            <div class="invalid-feedback">
                                Harap masukkan nama yang valid.
                            </div>
                        </div>

                        <div class="col-md-5 mt-md-2">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="xx@gmail.com" required>
                            <div class="invalid-feedback">
                                Harap masukkan email yang valid.
                            </div>
                        </div>

                        <div class="col-md-10 mt-md-2">
                            <label for="no_telp" class="form-label fw-semibold">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp  "
                                placeholder="Cth. 08123123123" required>
                            <div class="invalid-feedback">
                                Harap masukkan no Telepon yang valid.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <span class="h5 fw-bold">
                    Formulir Data Pemesanan
                </span>
            </div>
            <div class="col-md">
                <span class="h5 fw-bold">
                    Pengaturan Tambahan
                </span>
            </div>
        </div>



    </form>
@endsection


@section('js-tambahan')
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
        const tanggalSelesai = document.getElementById('tanggal_selesai');

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
        const now = new Date();
        const nowISO = now.toISOString().slice(0, 16);

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
