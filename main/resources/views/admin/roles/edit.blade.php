@extends('layouts.admin.master')

@section('isi-konten-dashboard')
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="card-title d-flex align-items-center gap-2 ">
                        Create Role
                    </h5>

                    <a type="button" class="btn btn-primary p-2 rounded-1" href="{{ route('roles') }}">
                        Cancel
                    </a>
                </div>
                <form method="post" action="{{route('role-update',['role'=>$roles->id])}}" class="p-4">
                    @csrf
                    <div class="mb-3 input-group">
                        <div class="col-4">
                            <label for="id" class="form-label fw-semibold">ID Role</label>
                            <input type="text" class="form-control" id="id" name="id" readonly
                                value="{{$roles->id}}" placeholder="Not be greater than 10 Character">

                            <div class="invalid-feedback">

                            </div>

                        </div>
                        <div class="ps-4 col-8">
                            <label for="nama_role" class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control " id="nama_role" name="nama_role" autofocus
                                value="{{$roles->nama_role}}" placeholder="Admin">

                            <div class=" invalid-feedback">

                            </div>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Role</button>
                </form>
            </div>
        </div>
    </div>
@endsection
