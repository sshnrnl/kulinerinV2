<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Guest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<style>
    .card {
        cursor: pointer;
    }

    .line-break {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<body>
    @extends('master.masterGuest')
    @section('content')
        <main class="main-content">
            {{-- <div class="greeting">Hello, {{ Auth::user()->username }}</div> --}}

            <!-- Updated Advertisement Section -->
            <div class="ad-container">
                <div class="ad-slide active">
                    <img src="{{ asset('asset/imageRestaurant6.webp') }}" alt="Special Offer" class="ad-image">
                </div>
                <div class="ad-slide">
                    <img src="{{ asset('asset/imageRestaurant4.jpg') }}" alt="New Restaurant" class="ad-image">
                </div>
                <div class="ad-slide">
                    <img src="{{ asset('asset/imageRestaurant3.avif') }}" alt="Free Delivery" class="ad-image">
                </div>

                <!-- Navigation Arrows -->
                <button class="slide-nav prev-slide" onclick="changeSlide(-1)">❮</button>
                <button class="slide-nav next-slide" onclick="changeSlide(1)">❯</button>

                <!-- Dot indicators -->
                <div class="slide-controls">
                    <button class="slide-dot active" onclick="goToSlide(0)"></button>
                    <button class="slide-dot" onclick="goToSlide(1)"></button>
                    <button class="slide-dot" onclick="goToSlide(2)"></button>
                </div>
            </div>

            <section>
                <h2 class="section-title">Recommendation Restaurant For You</h2>
                <div class="container" style="max-width: 100%; padding-left: 0rem;padding-right: 0rem">
                    <div class="row">
                        @foreach ($restaurants as $restaurant)
                            <div class="col-12 col-md-4 mb-4">
                                <div class="card"
                                    onclick="window.location='{{ route('indexRestaurants', $restaurant->id) }}'">
                                    <div class="restaurant-image">
                                        <!-- Use asset() to generate the correct URL for the image -->
                                        <img src="{{ asset('storage/' . $restaurant->firstImage) }}" class="card-img-top"
                                            alt="Restaurant Name" style="height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title line-break">{{ $restaurant->restaurantName }}</h5>
                                        <p class="card-text">{{ $restaurant->restaurantCity }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section>
                <h2 class="section-title">Dine, Save & Reserve</h2>
                <div class="container" style="max-width: 100%; padding-left: 0rem;padding-right: 0rem">
                    <div class="row">
                        @foreach ($restaurantsDine as $restaurant)
                            <div class="col-12 col-md-4 mb-4">
                                <div class="card"
                                    onclick="window.location='{{ route('indexRestaurants', $restaurant->id) }}'">
                                    <div class="restaurant-image">
                                        <!-- Use asset() to generate the correct URL for the image -->
                                        <img src="{{ asset('storage/' . $restaurant->firstImage) }}" class="card-img-top"
                                            alt="Restaurant Name" style="height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title line-break">{{ $restaurant->restaurantName }}</h5>
                                        <p class="card-text">{{ $restaurant->restaurantCity }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section>
                <h2 class="section-title">Candle Light Dinner</h2>
                <div class="container" style="max-width: 100%; padding-left: 0rem;padding-right: 0rem">
                    <div class="row">
                        @foreach ($restaurantsHoliday as $restaurant)
                            <div class="col-12 col-md-4 mb-4">
                                <div class="card"
                                    onclick="window.location='{{ route('indexRestaurants', $restaurant->id) }}'">
                                    <div class="restaurant-image">
                                        <!-- Use asset() to generate the correct URL for the image -->
                                        <img src="{{ asset('storage/' . $restaurant->firstImage) }}" class="card-img-top"
                                            alt="Restaurant Name" style="height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title line-break">{{ $restaurant->restaurantName }}</h5>
                                        <p class="card-text">{{ $restaurant->restaurantCity }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>
        <script>
            let currentSlide = 0;
            const slides = document.querySelectorAll('.ad-slide');
            const dots = document.querySelectorAll('.slide-dot');
            let slideInterval = setInterval(nextSlide, 3000); // Change slide in seconds

            function showSlide(n) {
                // Remove active class from all slides and dots
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));

                // Update current slide index
                currentSlide = (n + slides.length) % slides.length;

                // Add active class to current slide and dot
                slides[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active');
            }

            function changeSlide(direction) {
                clearInterval(slideInterval); // Reset timer when manually changed
                showSlide(currentSlide + direction);
                slideInterval = setInterval(nextSlide, 5000); // Restart timer
            }

            function goToSlide(n) {
                clearInterval(slideInterval);
                showSlide(n);
                slideInterval = setInterval(nextSlide, 5000);
            }

            function nextSlide() {
                showSlide(currentSlide + 1);
            }

            // Pause slideshow when hovering over container
            document.querySelector('.ad-container').addEventListener('mouseenter', () => {
                clearInterval(slideInterval);
            });

            document.querySelector('.ad-container').addEventListener('mouseleave', () => {
                slideInterval = setInterval(nextSlide, 5000);
            });
        </script>
    @endsection
</body>

</html>
<!-- </form>
        <form action="/logout" method="POST">
    @csrf
    <button type="submit" class="logout-btn">Logout</button>
</form> -->
