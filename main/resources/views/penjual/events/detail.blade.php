@extends('layouts.admin.master')

@section('isi-konten-dashboard')
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-end mb-4">
                    <div class="col-md-10">
                        <h5 class="card-title d-flex align-items-center  ">
                            (Nama Eventnya)
                        </h5>
                    </div>
                    <div class="col-md ">
                        <a type="button" class="btn btn-warning p-2 rounded-1 " href="{{ route('event-edit') }}">
                            Edit Event
                        </a>

                        <a type="button" class="btn btn-primary p-2 rounded-1 ms-2" href="{{ route('events') }}">
                            Back
                        </a>
                    </div>


                </div>
                <div class="table-responsive small px-3">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal & waktu</th>
                                <th scope="col">Pendapatan</th>
                                <th scope="col">Pengujung</th>
                                <th scope="col">Tiket Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>xx - xx</td>
                                <td>Rp. 0</td>
                                <td>0</td>
                                <td>0 / 20</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
