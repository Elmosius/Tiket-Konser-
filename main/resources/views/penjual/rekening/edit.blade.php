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
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- actionnya {{route('rekening-update')}} --}}
                <form method="post" action="{{route('rekening-update',['rekening'=>$rekenings->id])}}" class="p-4">
                    @csrf
                    <div class="mb-3 input-group">
                        <div class="col-4">
                            <label for="nama_bank" class="form-label fw-semibold">Bank</label>
                            <select class="form-select" name="nama_bank" required>
                                <option>Open this select menu</option>
                                @foreach ($banks as $bank)
                                <option value="{{ $bank['code'] }}" {{ $rekenings->nama_bank == $bank['code'] ? 'selected' : '' }}>
                                    {{ $bank['name'] }}
                                </option>
                            @endforeach
                            </select>

                        </div>
                        <div class="ps-4 col-8 mb-3">
                            <label for="nama_rekening" class="form-label fw-semibold">Nama Rekening</label>
                            <input type="text" class="form-control " id="nama_rekening" name="nama_rekening" autofocus required
                                value="{{$rekenings->nama_rekening}}" placeholder="Nama Pemiliki Rekening">
                            <div class=" invalid-feedback">
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="no_rekening" class="form-label fw-semibold">No Rekening</label>
                            <input type="text" class="form-control " id="no_rekening" name="no_rekening" autofocus
                                required value="{{$rekenings->no_rekening}}" placeholder="xxx">
                            <div class=" invalid-feedback">
                            </div>
                        </div>

                        <div class="ps-4 col-6">
                            <label for="kantor" class="form-label fw-semibold">Kota</label>
                            <input type="text" class="form-control " id="kantor" name="kantor" autofocus required
                                value="{{$rekenings->kantor}}"
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
