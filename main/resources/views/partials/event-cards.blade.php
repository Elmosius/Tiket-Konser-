@foreach ($events as $event)
    <div class="col-sm-6 col-lg-4 mb-4">
        <a href="{{ route('upcoming.detail', ['event' => $event->id]) }}">
            <div class="card">
                @if ($event->banner)
                    <img src="{{ $event->banner }}" class="card-img-top" alt="Event Image"
                        style="object-fit: cover; height:200px">
                @else
                    <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Event Image">
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="text-muted font-weight-bold mb-1">
                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d-m-Y') }}</p>
                        <p class="text-muted font-weight-bold mb-1">
                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->diffForHumans() }}</p>
                    </div>
                    <h5 class="card-title">{{ $event->nama_event }}</h5>
                    <p class="card-text">{{ $event->deskripsi }}</p>
                </div>
            </div>
        </a>
    </div>
@endforeach
