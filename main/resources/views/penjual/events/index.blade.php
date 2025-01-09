@extends('layouts.admin.master')

@php
    $activeEvent = 'aktif';
@endphp

@section('css-tambahan')
    <style>
        .active {
            color: black;
        }

        .inactive {
            color: gray;
        }

        .border-primary {
            border-color: #007ab9 !important;
        }

        .border-secondary {
            border-color: gray !important;
        }
    </style>
@endsection

@section('isi-konten-dashboard')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Cari Event Saya" aria-label="Search">
                            <button class="btn btn-primary " type="submit">Search</button>
                        </form>
                    </div>
                    <div class="col-md">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">Waktu mulai (terdekat)</option>
                            <option value="2">Waktu mulai (terlama)</option>
                            <option value="3">Urutan nama event (A-Z)</option>
                            <option value="4">Urutan nama event (Z-A)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3">
                        @if($events)
                       <a type="button" class="btn btn-primary p-2 rounded-1" href="{{ route('event-create') }}">
                            Buat Event!
                        </a> 
                        @endif
                    </div>
                    <div class="col-lg">
                        <a href="#" class="event-link" data-event="aktif">
                            <div class="h5 {{ $activeEvent == 'aktif' ? 'active' : 'inactive' }}">
                                Event Aktif
                            </div>
                            <div
                                class=" mt-3 border-bottom {{ $activeEvent == 'aktif' ? 'border-primary' : 'border-secondary' }}">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg">
                        <a href="#" class="event-link" data-event="tidak_aktif">
                            <div class="h5 {{ $activeEvent == 'tidak_aktif' ? 'active' : 'inactive' }}">
                                Event Tidak Aktif
                            </div>
                            <div
                                class=" mt-3 border-bottom {{ $activeEvent == 'tidak_aktif' ? 'border-primary' : 'border-secondary' }}">
                            </div>
                        </a>
                    </div>
                </div>

                @if($events->isEmpty())
                
                    <div class="row d-flex justify-content-center text-center mt-5 ">
                        <div class="col-md-12">
                            <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>

                        </div>
                        <div class="col-md-12 mt-2">
                            Silakah buat event mu dengan menekan tombol di bawah ini.
                        </div>
                        <div class="col-md-4 mt-3">
                            <a type="button" class="btn btn-primary p-2 rounded-1" href="{{ route('event-create') }}">
                                Buat Event!
                            </a>
                        </div>
                    </div>
                @elseif($events->isNotEmpty())
                    {{-- kalau ada table biasa --}}
                    <div class="h-5 mt-3">
                        (ini kalau misalnya ada event tabel biasa)
                    </div>
                    <div class="table-responsive small ">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Event</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Publish/Unpublish</th>
                                    <th scope="col">Lihat Detail</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{$event->id}}</td>
                                        <td>{{$event->nama_event}}</td>
                                        @if($event->status== 1)
                                            <td>Publish</td>
                                        @elseif($event->status== 0)
                                            <td>Unpublish</td>
                                        @else
                                            <td>{{$event->status}}</td>
                                        @endif
                                        <td>{{$event->tanggal_mulai}}</td>
                                        <td>
                                            {{-- Merubah Status Aktif(Publish)/Tidak(Unpublish) --}}
                                            <a href="{{ route('event-status-update',['id' =>$event->id]) }}" class="btn btn-success pt-1 pb-1 px-2 ms-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="15"
                                                    height="15"viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                                </svg>

                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('event-detail',['event' =>$event->id]) }}" class="btn btn-primary pt-1 pb-1 px-2 ms-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="15" height="15"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('event-edit',['event'=>$event->id]) }}" class="btn btn-warning pt-1 pb-1 px-2">
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
                                        </td>
                                        <td>
                                            {{-- tombol deelete --}}
                                            <button class="btn btn-danger pt-1 pb-1 px-2" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{$event->id}}" data-url="{{ route('event-delete', ['event' => $event->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus item ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                    <a href="#" class="btn btn-danger" id="confirmDelete">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-tambahan')
    <script>
        localStorage.removeItem("allTikets");
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.event-link');
            links.forEach(link => {
                link.addEventListener('click', function() {
                    links.forEach(l => {
                        l.querySelector('.h5').classList.remove('active');
                        l.querySelector('.h5').classList.add('inactive');
                        l.querySelector('.border-bottom').classList.remove(
                            'border-primary');
                        l.querySelector('.border-bottom').classList.add('border-secondary');
                    });
                    this.querySelector('.h5').classList.remove('inactive');
                    this.querySelector('.h5').classList.add('active');
                    this.querySelector('.border-bottom').classList.remove('border-secondary');
                    this.querySelector('.border-bottom').classList.add('border-primary');
                });
            });


            let deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                let button = event.relatedTarget;
                let itemId = button.getAttribute('data-id');
                let deleteUrl = button.getAttribute('data-url');
                let confirmButton = deleteModal.querySelector('#confirmDelete');

                confirmButton.setAttribute('href', deleteUrl)

                confirmButton.onclick = function() {
                    console.log('Item dengan ID ' + itemId + ' akan dihapus.');
                    let modal = bootstrap.Modal.getInstance(deleteModal);
                    modal.hide();
                };
            });
        });
    </script>
@endsection
