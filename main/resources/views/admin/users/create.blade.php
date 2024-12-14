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
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{implode('',$errors->all(':message'))}}
                    </div>
                @endif
                <form method="post" action="{{route('user-store')}}" class="p-4">
                    @csrf
                    <div class="mb-3 input-group">
                        <div class="col-4">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required
                                value="" placeholder="Not be greater than 10 Character">

                            <div class="invalid-feedback">

                            </div>
                        </div>
                        <div class="ps-4 col-4">
                            <label for="nama" class="form-label fw-semibold">Name</label>
                            <input type="text" class="form-control " id="nama" name="nama"
                                value="" placeholder="John Doe">

                            <div class=" invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="mb-3 input-group">
                        <div class="col-4">
                            <label for="telepon" class="form-label fw-semibold">Phone Number</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" required autofocus
                                value="" placeholder="08XXXXXXXXX">

                            <div class="invalid-feedback">

                            </div>
                        </div>
                        <div class="ps-4 col-4">
                            <label for="tanggal_lahir" class="form-label fw-semibold">Birth Date</label>
                            <input type="date" class="form-control " id="tanggal_lahir" name="tanggal_lahir"
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
                            <input type="text" class="form-control" id="password" name="password" autofocus
                                value="" placeholder="Must greater than 8 Character">

                        </div>
                        <div class="col-6 ps-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                            <input type="text" class="form-control " id="password_confirmation"
                                name="password_confirmation" autofocus value="" placeholder="Rewrite the password">

                        </div>
                    </div>
                    <div class="mb-3 input-group">
                        <div class="col-6 pe-3">
                            <label for="role" class="form-label fw-semibold">Role</label>
                            <select class="form-select" name="role" required>
                                <option class="text-secondary">Pick Role</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->id}}-{{$role->nama_role}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 ps-3">
                            <label for="jenis_kelamin" class="form-label fw-semibold">Gender</label>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option class="text-secondary">Pick Gender</option>
                                <option value="0">Pria</option>
                                <option value="1">Wanita</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
            </div>
        </div>
    </div>
@endsection
