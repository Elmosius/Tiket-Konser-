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

            </div>
        </div>
    </div>
@endsection
