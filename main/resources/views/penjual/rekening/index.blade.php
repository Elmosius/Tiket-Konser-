@extends('layouts.admin.master')

@section('isi-konten-dashboard')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title d-flex align-items-center gap-2">
                        Rekening Kamu
                    </h5>
                </div>
                <hr>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="card">
            <div class="card-body ">
                {{-- Ini kalau misalnya belum buat rekening --}}
                <div class="h-5 mt-3">
                    (ini kalau misalnya tidak ada event)
                </div>
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-md-12">
                        <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card-pay">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
                            <path d="M3 10h18" />
                            <path d="M16 19h6" />
                            <path d="M19 16l3 3l-3 3" />
                            <path d="M7.005 15h.005" />
                            <path d="M11 15h2" />
                        </svg>
                    </div>
                    <div class="col-md-12 mt-2">
                        Silakan masukkan rekening kamu terlebih dahulu untuk dapat memproses penarikan penjualan.
                    </div>
                    <div class="col-md-4 mt-3">
                        <a type="button" class="btn btn-primary p-2 rounded-1" href="">
                            Masukkan Rekening
                        </a>
                    </div>
                </div>
                {{-- Ini kalau misalnya belum buat rekening --}}
                <div class="h-5 mt-5">
                    (ini kalau misalnya rekeningnya sudah ada)
                </div>

                <div class="row d-flex justify-content-center mt-3">
                    <div class="col-md-6">
                        <div class="card border border-black rounded">
                            <div
                                class="fs-3 card-header border-bottom border-black d-flex justify-content-between align-items-center">
                                <span>BCA misalnya</span>
                                <div>
                                    <a href="{{ route('users-edit') }}" class="btn btn-warning pt-1 pb-1 px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                    </a>
                                    <button class="btn btn-danger pt-1 pb-1 px-2" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-id="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7h16" />
                                            <path d="M10 11v6" />
                                            <path d="M14 11v6" />
                                            <path d="M5 7l1 -4h12l1 4" />
                                            <path d="M6 7v13a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2v-13" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body bg-light">
                                <p class="fs-3 card-title">(Nama Rekening)</p>
                                <p class="fs-3 card-title">(No Rekening)</p>
                                <p class="fs-3 card-title">(Kota)</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="card border border-black rounded ">
                            <a href="#" class="primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <p class="h-5">Tambah rekening lainnya...</p>
                            </a>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
