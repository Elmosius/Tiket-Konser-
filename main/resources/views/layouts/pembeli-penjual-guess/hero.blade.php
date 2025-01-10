<section class="container my-5 px-24">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators mt-5">
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner rounded">
            <div class="carousel-item active rounded-5">
                <a href="#">
                    <img src="{{ asset('assets/images/backgrounds/1.png') }}" class="rounded-5 d-block w-100 py-2"
                        alt="contoh">
                </a>
            </div>
            <div class="carousel-item rounded-5">
                <img src="{{ asset('assets/images/backgrounds/2.png') }}" class="rounded-5 d-block w-100 py-2"
                    alt="contoh">
            </div>
            <div class="carousel-item rounded-5">
                <img src="{{ asset('assets/images/backgrounds/3.png') }}" class="rounded-5 d-block w-100 py-2"
                    alt="contoh">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
