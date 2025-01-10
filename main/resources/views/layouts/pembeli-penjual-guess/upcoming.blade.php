<section class="container my-5 px-24">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 fw-bolder">Acara Mendatang</h2>

    </div>

    <!-- Event Cards -->
    <div class="row mt-5">
        @include('partials.event-cards', ['events' => $events])
    </div>

    <div class="text-center">
        <!-- Button with rounded-full -->
        <a href="{{route('pembeli-listTiket')}}" class="btn btn-primary px-4 py-2 shadow">Lainnya</a>
    </div>
</section>
