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
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <hr>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="card">
            <div class="card-body ">
                @if($rekenings->isEmpty())
                    
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
                            <a type="button" class="btn btn-primary p-2 rounded-1" href="{{ route('rekening-add') }}">
                                Masukkan Rekening
                            </a>
                        </div>
                    </div>
                @else
                
                {{-- {$data = array_search($rekening->nama_bank, array_column($banks, 'code')),$banks[$data]['name']}}  --}}
                <div class="row d-flex justify-content-center mt-3">
                    <div class="col-md-6">
                        @foreach ($rekenings as $rekening)
                            <div class="card border border-black rounded">
                                <div class="fs-3 card-header border-bottom border-black d-flex justify-content-between align-items-center">
                                    {{-- Jadi status tuh maksudnya buat kalau ada event nanti uangnya ke rekening yang aktif  --}}
                                    <span>{{$rekening->searchBank($rekening->nama_bank)}} &nbsp; &nbsp;

                                        @if($rekening->status == 1)
                                            (Status : Aktif)
                                        @else
                                            (Status : Tidak Aktif)
                                        @endif
                                    </span>
                                    <div>
                                        <a href="{{route('rekening-status-update',['id'=>$rekening->id])}}" type="button" class="btn btn-dark p-1 fs-2"
                                            >Aktif/Nonaktif</a>

                                        {{-- tombol edit --}}
                                        <a href="{{ route('rekening-edit',['rekening'=>$rekening->id]) }}" class="btn btn-warning pt-1 pb-1 px-2">
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
                                        {{-- tombol delete --}}
                                        <button class="btn btn-danger pt-1 pb-1 px-2" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{$rekening->id}}" data-url="{{ route('rekening-delete', ['rekening' => $rekening->id]) }}">
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
                                <p class="fs-3 card-title">{{$rekening->nama_rekening}}</p>
                                <p class="fs-3 card-title">{{$rekening->no_rekening}}</p>
                                <p class="fs-3 card-title">{{$rekening->kantor}}</p>

                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="card border border-black rounded ">
                            <a href="{{ route('rekening-add') }}" class="primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <p class="h-5">Tambah rekening lainnya...</p>
                            </a>
                        </div>
                    </div>
                </div>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="" type="button" class="btn btn-danger" id="confirmDelete">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js-tambahan')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
