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
                    <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
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
                let confirmButton = deleteModal.querySelector('#confirmDelete');

                confirmButton.onclick = function() {
                    console.log('Item dengan ID ' + itemId + ' akan dihapus.');
                    let modal = bootstrap.Modal.getInstance(deleteModal);
                    modal.hide();
                };
            });
        });
    </script>
@endsection
