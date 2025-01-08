@extends('layouts.admin.master')

@section('isi-konten-dashboard')
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-end mb-4">
                    <div class="col-md-10">
                        <h5 class="card-title d-flex align-items-center  ">
                            {{$event->nama_event}}
                        </h5>
                    </div>
                    <div class="col-md d-flex">
                        <a type="button" class="btn btn-warning p-2 rounded-1 " href="{{ route('event-edit',['event'=>$event->id]) }}">
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
                                <th scope="col">Tiket</th>
                                <th scope="col">Tiket Terjual</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailPembelians as $bayar)
                            <tr>
                                <td>{{$bayar->updated_at}}</td>
                                <td>Rp. {{$bayar->total}}</td>
                                <td>{{$bayar->id_user}}</td>
                                <td>{{$bayar->id_tiket}}</td>
                                <td>{{$bayar->jumlah}}</td>
                                @if($bayar->status == 1){
                                    <td>Terjual</td>
                                }@else{
                                    <td>Belum</td>
                                }
                                @endif
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
