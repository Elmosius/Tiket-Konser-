@extends('layouts.admin.master')

@section('isi-konten-dashboard')
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="card-title d-flex align-items-center gap-2 ">
                        Add Rekening
                    </h5>

                    <a type="button" class="btn btn-primary p-2 rounded-1" href="{{ route('rekening') }}">
                        Cancel
                    </a>
                </div>
                <form method="post" action="/dashboard/rekening" class="p-4">
                    @csrf
                    <div class="mb-3 input-group">
                        <div class="col-4">
                            <label for="bank" class="form-label fw-semibold">Bank</label>
                            <select class="form-select" name="bank" required>
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="ps-4 col-8 mb-3">
                            <label for="nama" class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control " id="nama" name="nama" autofocus required
                                value="" placeholder="Nama Pemiliki Rekening">
                            <div class=" invalid-feedback">
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="no_rekening" class="form-label fw-semibold">No Rekening</label>
                            <input type="text" class="form-control " id="no_rekening" name="no_rekening" autofocus
                                required value="" placeholder="xxx">
                            <div class=" invalid-feedback">
                            </div>
                        </div>

                        <div class="ps-4 col-6">
                            <label for="kota" class="form-label fw-semibold">Kota</label>
                            <input type="text" class="form-control " id="kota" name="kota" autofocus required
                                value=""
                                placeholder="Kota tempat kantor cabang saat kamu membuka rekening. Contoh: Yogyakarta.">
                            <div class=" invalid-feedback">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
