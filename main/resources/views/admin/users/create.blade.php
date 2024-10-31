@extends('layouts.admin.master')

@section('isi-konten-dashboard')
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="card-title d-flex align-items-center gap-2 ">
                        Create User
                    </h5>

                    <a type="button" class="btn btn-primary p-2 rounded-1" href="{{ route('users') }}">
                        Cancel
                    </a>
                </div>
                <form method="post" action="/dashboard/users" class="p-4">
                    @csrf
                    <div class="mb-3 input-group">
                        <div class="col-4">
                            <label for="id_user" class="form-label fw-semibold">ID User</label>
                            <input type="text" class="form-control" id="id_user" name="id_user" required autofocus
                                value="" placeholder="Not be greater than 10 Character">

                            <div class="invalid-feedback">

                            </div>

                        </div>
                        <div class="ps-4 col-8">
                            <label for="nama_user" class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control " id="nama_user" name="nama_user" autofocus
                                value="" placeholder="John Doe">

                            <div class=" invalid-feedback">

                            </div>

                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold ">Email</label>
                        <input type="email" class="form-control" id="email" name="email" autofocus value=""
                            placeholder="JohnDoe@gmail.com">
                    </div>

                    <div class="mb-3 input-group">
                        <div class="col-6 pe-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control" id="password" name="password" autofocus
                                value="" placeholder="Must greater than 8 Character">

                        </div>
                        <div class="col-6 ps-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" class="form-control " id="password_confirmation"
                                name="password_confirmation" autofocus value="" placeholder="Rewrite the password">

                        </div>
                    </div>
                    <div class="mb-3 input-group">
                        <div class="col-6 pe-3">
                            <label for="id_role" class="form-label fw-semibold">Role</label>
                            <select class="form-select" name="id_role" required>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
            </div>
        </div>
    </div>
@endsection
