@extends('layouts.admin.master')

@section('isi-konten-dashboard')
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="card-title d-flex align-items-center gap-2 ">
                        Users
                    </h5>

                    <a type="button" class="btn btn-primary p-2 rounded-1" href="{{ route('user-create') }}">
                        Create User Baru
                    </a>
                </div>
                <div class="table-responsive small px-3">
                    @auth
                        <p>Welcome, {{ auth()->user()->nama }}</p>
                    @endauth

                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">ID User</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->nama}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->cariRole->nama_role}}</td>
                                    <td>
                                        <a href="{{ route('user-edit',['user' =>$user->id]) }}" class="btn btn-warning pt-1 pb-1 px-2">
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
                                        {{-- tombol delete --}}
                                        <button class="btn btn-danger pt-1 pb-1 px-2" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{$user->id}}">
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
                    <a href="#" type="button" class="btn btn-danger" id="confirmDelete">Hapus</a>
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
                console.log("berhasil")
                let button = event.relatedTarget;
                let itemId = button.getAttribute('data-id');
                let confirmButton = deleteModal.querySelector('#confirmDelete');
                confirmButton.setAttribute('href', `/dashboard/users/delete/${itemId}`);

                confirmButton.onclick = function() {
                    console.log('Item dengan ID ' + itemId + ' akan dihapus.');
                    let modal = bootstrap.Modal.getInstance(deleteModal);
                    modal.hide();
                };
            });
        });
    </script>
@endsection
