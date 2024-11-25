@extends('layouts.admin.master')

@section('isi-konten-dashboard')
    {{-- Role Admin --}}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                    Traffic Overview
                    <span>
                        <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-custom-class="tooltip-success"
                            data-bs-title="Traffic Overview"></iconify-icon>
                    </span>
                </h5>   
                <div id="traffic-overview">
                </div>
            </div>
        </div>
    </div>

    {{-- Role Penjual --}}
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title d-flex align-items-center gap-2">
                        Home
                    </h5>

                    <a type="button" class="btn btn-primary p-2 rounded-1" href="{{ route('users-create') }}">
                        <span class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                <path d="M16 3l0 4" />
                                <path d="M8 3l0 4" />
                                <path d="M4 11l16 0" />
                                <path d="M8 15h2v2h-2z" />
                            </svg>
                        </span>
                        Buat Event
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-time">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                                <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M15 3v4" />
                                <path d="M7 3v4" />
                                <path d="M3 11h16" />
                                <path d="M18 16.496v1.504l1 1" />
                            </svg>
                        </div>
                        <div class="col">
                            <h6 class="mb-0">Event Aktif</h6>
                        </div>
                        <div class="col-auto">
                            <a href="">detail</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col text-center">
                            <h4>0</h4>
                            <p class="mb-0">Event</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-off">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M9 5h9a2 2 0 0 1 2 2v9m-.184 3.839a2 2 0 0 1 -1.816 1.161h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 1.158 -1.815" />
                                <path d="M16 3v4" />
                                <path d="M8 3v1" />
                                <path d="M4 11h7m4 0h5" />
                                <path d="M3 3l18 18" />
                            </svg>
                        </div>
                        <div class="col">
                            <h6 class="mb-0">Event Tidak Aktif</h6>
                        </div>
                        <div class="col-auto">
                            <a href="">detail</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col text-center">
                            <h4>0</h4>
                            <p class="mb-0">Event</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-cash-register">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M21 15h-2.5c-.398 0 -.779 .158 -1.061 .439c-.281 .281 -.439 .663 -.439 1.061c0 .398 .158 .779 .439 1.061c.281 .281 .663 .439 1.061 .439h1c.398 0 .779 .158 1.061 .439c.281 .281 .439 .663 .439 1.061c0 .398 -.158 .779 -.439 1.061c-.281 .281 -.663 .439 -1.061 .439h-2.5" />
                                <path d="M19 21v1m0 -8v1" />
                                <path
                                    d="M13 21h-7c-.53 0 -1.039 -.211 -1.414 -.586c-.375 -.375 -.586 -.884 -.586 -1.414v-10c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h2m12 3.12v-1.12c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2" />
                                <path
                                    d="M16 10v-6c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-4c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414v6m8 0h-8m8 0h1m-9 0h-1" />
                                <path d="M8 14v.01" />
                                <path d="M8 17v.01" />
                                <path d="M12 13.99v.01" />
                                <path d="M12 17v.01" />
                            </svg>
                            </span>
                        </div>
                        <div class="col">
                            <h6 class="mb-0">Total Transaksi</h6>
                        </div>

                    </div>
                    <hr>
                    <div class="row mb-4">
                        <div class="col text-center">
                            <h4>0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-ticket">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M15 5l0 2" />
                                <path d="M15 11l0 2" />
                                <path d="M15 17l0 2" />
                                <path
                                    d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
                            </svg>
                        </div>
                        <div class="col">
                            <h6 class="mb-0">Total Tiket Terjual</h6>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col text-center">
                            <h4>0</h4>
                            <p class="mb-0">Tiket</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-moneybag">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z" />
                                <path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                            </svg>
                        </div>
                        <div class="col">
                            <h6 class="mb-0">Total Penjualan</h6>
                        </div>

                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col text-center">
                            <h4>Rp. 0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                            </span>
                        </div>
                        <div class="col">
                            <h6 class="mb-0">Total Pengunjung</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col text-center ">
                            <h4>0</h4>
                            <p class="mb-0">Orang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
