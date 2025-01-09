<section class="container my-5 px-24">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 fw-bolder">Acara Mendatang</h2>

        <!-- Dropdowns -->
        <div class="d-flex gap-2">
            <!-- Kategori Dropdown -->
            <select class="form-select warna-primary text-light rounded-pill border border-dark custom-select-arrow"
                aria-label="kategori" id="filterKategori">
                <option selected>Kategori</option>
                <option value="all">Semua</option>
                <option value="bayar">Berbayar</option>
                <option value="gratis">Gratis</option>
            </select>

            <!-- Hari Dropdown -->
            <select class="form-select warna-primary text-light rounded-pill custom-select-arrow" aria-label="hari"
            id="filterHari">
                <option selected>Hari</option>
                <option value="all">Semua</option>
                <option value="2">Senin</option>
                <option value="3">Selasa</option>
                <option value="4">Rabu</option>
                <option value="5">Kamis</option>
                <option value="6">Jumat</option>
                <option value="7">Sabtu</option>
                <option value="1">Minggu</option>
            </select>
        </div>
    </div>

    <!-- Event Cards -->
    <div class="row mt-5">
        <!-- Event Card 1 -->
        @foreach ($events as $event)
            <div class="col-sm-6 col-lg-4 mb-4">
                    <a href="{{ route('upcoming.detail',['event'=>$event->id]) }}">
                        <div class="card">
                            @if($event->banner)
                                <img src="{{$event->banner}}" class="card-img-top" alt="Event Image" width="400" height="200">
                            @else
                                <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Event Image">
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted font-weight-bold mb-1">{{\Carbon\Carbon::parse($event->tanggal_mulai)->format('d-m-Y')}}</p>
                                    <p class="text-muted font-weight-bold mb-1">{{\Carbon\Carbon::parse($event->tanggal_mulai)->diffForHumans()}}</p>
                                </div>
                                <h5 class="card-title">{{$event->nama_event}}</h5>
                                <p class="card-text">{{$event->deskripsi}}</p>
                             </div>
                        </div>
                    </a>
            </div>
        @endforeach

        {{-- <!-- Event Card 2 -->
        <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card">
                <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Event Image">
                <div class="card-body">
                    <p class="text-muted font-weight-bold mb-1">16 APR</p>
                    <h5 class="card-title">Quisquam mollitia repellat deserunt</h5>
                    <p class="card-text">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.
                    </p>
                </div>
            </div>
        </div>

        <!-- Event Card 3 -->
        <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card">
                <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Event Image">
                <div class="card-body">
                    <p class="text-muted font-weight-bold mb-1">20 APR</p>
                    <h5 class="card-title">Excepteur sint occaecat cupidatat</h5>
                    <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        doloremque.</p>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="text-center">
        <!-- Button with rounded-full -->
        <button class="btn btn-primary px-4 py-2 shadow">Lainnya</button>
    </div>
</section>

@section('filter-js')
    <script>
        const kategoriDropdown = document.getElementById('filterKategori')
        const hariDropdown = document.getElementById('filterHari')
        var kategori =''
        var hari=''

        kategoriDropdown.addEventListener('change',function(){
            kategori = kategoriDropdown.value; // Ambil nilai kategori
            updateURL();
        })

        hariDropdown.addEventListener('change',function(){
            hari = hariDropdown.value;
            updateURL();
        })

        function updateURL() {
            const url = new URL(window.location.href);
            // Hanya set parameter kategori jika ada nilai
            if (kategori) {
                url.searchParams.set('kategori', kategori); // Set parameter kategori
            }
            if(kategori == 'all'){
                url.searchParams.delete('kategori'); // Hapus jika kosong atau 'all'
            }

            // Hanya set parameter hari jika ada nilai
            if (hari) {
                url.searchParams.set('hari', hari); // Set parameter hari
            } 

            if(hari == 'all'){
                url.searchParams.delete('hari'); // Hapus jika kosong
            }
            window.location.href = url.toString(); // Reload halaman
        }
    </script>
@endsection
