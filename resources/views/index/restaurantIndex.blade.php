<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View | {{ $restaurants->restaurantName }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('asset/kulinerinLogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body style="background-color: #DECEB0ff">
    <style>
        .stars {
            color: #f97e0a;
        }

        .fade-out {
            opacity: 0;
            transition: opacity 0.25s ease-in-out;
        }

        .fade-in {
            opacity: 1;
            transition: opacity 0.25s ease-in-out;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .reservation-details {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .reservation-text {
            color: #333;
            font-size: 16px;
            line-height: 1.5;
            margin: 0 0 4px 0;
        }

        .button-group {
            display: flex;
            padding-top: 2.5rem;
            gap: 12px;
            margin-top: 20px;
            justify-content: flex-end;
        }

        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .cancel-button {
            background-color: #e0e0e0;
            color: #333;
        }

        .cancel-button:hover {
            background-color: #d0d0d0;
        }

        .book-button {
            background-color: #007AFF;
            color: white;
        }

        .book-button:hover {
            background-color: #0066CC;
        }

        .image_style {
            height: 148px;
            width: 180px;
            border-radius: 20px 0px 0px 20px;
        }

        header {
            position: sticky;
            top: 0;
            left: 0;
            width: 100%;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            /* max-width: 1200px; */
            margin: 0 auto;
        }

        nav a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            transition: all 0.3s ease;
        }

        nav a.active {
            color: #007bff;
            font-weight: bold;
            border-bottom: 2px solid #007bff;
        }

        nav a:hover:not(.active) {
            color: #0056b3;
        }

        nav nav {
            padding-top: 1rem;
            display: flex;
            gap: 20px;
        }
    </style>
    @extends('master.masterCustomer')
    @section('content')
        <div class="container py-4" style="max-width: 100%; padding-left: 2rem;padding-right: 2rem; padding-top: 130px">
            <div class="card shadow-sm border-dark" style="border-radius: 15px; margin-bottom:20px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2 class="card-title mb-3">{{ $restaurants->restaurantName }}</h2>
                            <div class="mb-3">
                                {{-- Generate star ratings dynamically --}}
                                @php
                                    $averageScore = $ratingData['averageScore'];
                                    $totalReviewers = $ratingData['totalReviewers'];

                                    $fullStars = floor($averageScore); // Full stars (integer part)
                                    $halfStar = $averageScore - $fullStars >= 0.5 ? true : false; // Check if there's a half star
                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Remaining empty stars
                                @endphp

                                {{-- Display full stars --}}
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <span class="stars">★</span>
                                @endfor

                                {{-- Display half star if applicable --}}
                                @if ($halfStar)
                                    <span class="stars">⯪</span>
                                @endif

                                {{-- Display empty stars --}}
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <span class="text-muted">☆</span>
                                @endfor

                                <span class="ms-2 text-muted">({{ $totalReviewers }} Reviews)</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="padding-left: 1.5rem; padding-right:0rem">
                            <div class="col-md-8">
                                <div class="bg-light mb-3 border overflow-hidden"
                                    style="height: 500px; border-radius: 8px; transition: opacity 0.5s ease-in-out;">
                                    <div class="h-100">
                                        <img id="mainImage" src="{{ URL::to('/') . '/' . 'storage/' . $images[0] }}"
                                            style="width: 100%; height: 100%; object-fit: fill;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @foreach ($images as $image)
                                    <div class="bg-light mb-3 overflow-hidden" style="height: 155px; border-radius: 8px;">
                                        <div class="h-100">
                                            <img src="{{ URL::to('/') . '/' . 'storage/' . $image }}"
                                                style="width: 100%; height: 100%; object-fit: fill; cursor: pointer;"
                                                onclick="changeImage('{{ 'storage/' . $image }}')">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <header>
                <nav>
                    <a href="#Overview">Overview</a>
                    <a href="#Review">Review</a>
                    <a href="#BookTable">Book Table</a>
                    <a href="#Menu">Menu</a>
                </nav>
            </header>
            <section class="section" id="Overview">
                <!-- Overview content -->
                <div class="tab-pane p-3 fade show active border" style="margin-bottom: 3rem; margin-top:1.5rem"
                    id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <div class="row" style="padding:5px 0px 5px 20px">
                        <div class="col-md-6">
                            <h5>About</h5>
                            <p><strong>Location:</strong> {{ $restaurants->restaurantAddress }}</p>
                            <p><strong>Opening Hours:</strong> Mon-Sun: 6am-9pm</p>
                            <p><strong>Contact:</strong> {{ $restaurants->restaurantPhoneNumber }} |
                                {{ $restaurants->restaurantEmail }}</p>
                        </div>
                    </div>
                </div>
            </section>
            <hr>
            <section class="section" id="Review">
                <!-- Review content -->
                <div class="col-md-8 border" style="margin: 3rem 0rem">
                    <div class="card p-3 h-auto">
                        <h5><strong>Customer Reviews</strong></h5>
                        <hr>
                        @if ($ratingData['reviews']->isEmpty())
                            <p class="text-muted text-center">No reviews yet. Be the first to review!</p>
                        @else
                            <div id="reviews-container">
                                @foreach ($ratingData['reviews'] as $index => $review)
                                    <div class="card p-2 mb-2 h-auto review-item"
                                        style="height: auto; display: {{ $index < 5 ? 'block' : 'none' }};">
                                        <!-- User and Time -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="fst-italic m-0"><strong>By {{ $review->user->username }} :</strong>
                                            </p>
                                            <span
                                                class="fw-light text-muted small">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>

                                        <!-- Rating -->
                                        <p class="m-0 stars">
                                            <strong>
                                                @for ($i = 0; $i < $review->score; $i++)
                                                    &#9733;
                                                @endfor
                                                @for ($i = $review->score; $i < 5; $i++)
                                                    &#9734;
                                                @endfor
                                            </strong>
                                        </p>

                                        <!-- Review Content -->
                                        <p class="m-0">{{ $review->review }}</p>
                                    </div>
                                @endforeach
                            </div>

                            @if (count($ratingData['reviews']) > 5)
                                <button id="see-more-btn" class="btn btn-primary mt-3">See More</button>
                            @endif
                        @endif
                    </div>
                </div>
            </section>
            <hr>
            <section class="section" id="BookTable" style="margin-bottom: 5rem">
                <!-- Book Table content -->
                <div class="row" style="margin: 3rem 0rem">
                    <div class="col">
                        <h5 style="padding-top:1rem">Reserve a Table</h5>
                        <div class="mb-3">
                            <label for="inputGuest" class="form-label">Number of People</label>
                            <select id="inputGuest" name="guest" class="form-control" required>
                                @foreach ($capacities as $capacity)
                                    <option value="{{ $capacity }}">{{ $capacity }} People</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="restaurantId" value="{{ $restaurants->id }}">
                        {{-- <p>*Available Tables: <span id="availableTables">{{ $totalAvailableTables }}</span></p> --}}
                        <p><span id="availableTables"></span></p>

                        <div class="mb-3">
                            <label for="inputDate" class="form-label">Reservation Date</label>
                            <input type="date" id="inputDate" name="reservationDate" class="form-control"
                                required="required" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}">
                        </div>

                        @php
                            use Carbon\Carbon;
                            $currentTime = Carbon::now()->format('H:i');
                            $currentHour = Carbon::now()->hour;
                            $currentMinute = Carbon::now()->minute;
                        @endphp

                        <div class="mb-3">
                            <label for="inputTime" class="form-label">Reservation Time</label>
                            <select id="inputTime" name="reservationTime" class="form-control" required>
                                {{-- <option value="">Select Time</option> --}}
                                @foreach (range(0, 23) as $hour)
                                    @foreach (['00', '15', '30', '45'] as $minute)
                                        @php
                                            $time = sprintf('%02d:%s', $hour, $minute);
                                        @endphp
                                        @if ($hour > $currentHour || ($hour == $currentHour && (int) $minute > $currentMinute))
                                            <option value="{{ $time }}">{{ $time }} WIB</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="hidden" id="inputRestaurantName" name="restaurantName"
                                value={{ $restaurants->restaurantName }}>
                        </div>
                        <button id="myBtn" onclick="myBtnClick()" class="btn btn-primary">Reserve Now</button>
                    </div>

                    <div class="col">
                        <h5 style="padding-top:2rem">Table Reservation Terms and Conditions</h5>
                        <ol>
                            <li><strong>Reservation Confirmation</strong><br>
                                All table reservations must be confirmed by the restaurant before being finalized.
                            </li>
                            <li><strong>Reservation Time</strong><br>
                                The reserved table will be held for up to 15 minutes from the scheduled reservation time.
                            </li>
                            <li><strong>Group Size</strong><br>
                                The number of people specified during the reservation must match the actual number of
                                guests.
                            </li>
                            <li><strong>Cancellation Policy</strong><br>
                                Cancellations must be made at least 24 hours before the scheduled reservation time.
                            </li>
                            <li><strong>Deposit or Pre-payment</strong><br>
                                A deposit or pre-payment may be required for large groups or special events.
                            </li>
                        </ol>
                    </div>
                </div>
            </section>
            <hr>
            <section class="section" id="Menu">
                <h3 class="text-center">{{ $restaurants->restaurantName }} - Menu</h3>
                <hr>
                @foreach ($menuItems as $category => $menus)
                    <p class="mb-2 fs-2 fw-semibold" style="padding-top:1rem">{{ $category }}</p>
                    <div class="row mb-3 g-4">
                        @foreach ($menus as $menu)
                            <div class="col-lg-6 d-flex">
                                <div class="card d-flex align-items-stretch"
                                    style="max-height: 150px; border-radius: 20px; width: 100%; background-color: #DECEB0ff; border-color: white; overflow: hidden;">
                                    <div class="row d-flex g-0">
                                        <div class="col-4 col-md-4 d-flex align-items-stretch">
                                            <img src="{{ asset('storage/' . $menu->menuImage) }}"
                                                class="image_style img-fluid"
                                                style="width: 100%; height: 100%; max-height: 150px; object-fit: cover; border-radius: 15px;"
                                                alt="Menu Image">
                                        </div>
                                        <div class="col-8 d-flex flex-column justify-content-between"
                                            style="padding: 10px 15px 10px 10px; flex-grow: 1; min-height: 150px;">
                                            <h5
                                                style="margin: 0 5px 5px 0; padding-right: 10px; white-space: normal; word-wrap: break-word;">
                                                {{ $menu->menuName }}
                                            </h5>
                                            <p
                                                style="margin: 0 5px 5px 0; padding-right: 10px; flex-grow: 1; white-space: normal; word-wrap: break-word;">
                                                {{ $menu->description }}
                                            </p>
                                            <p class="fw-semibold fst-italic"
                                                style="padding: 5px 10px 5px 0; margin-bottom: 5px; min-height: 20px; display: block;">
                                                {{ number_format($menu->menuPrice, 0, '.', ',') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </section>

        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <hr>
                <p class="reservation-text">You are making a reservation for</p>
                <p class="reservation-text" id="guest-info"></p>
                <p class="reservation-text" id="restaurantInfo">{{ $restaurants->restaurantName }}
                    ({{ $restaurants->restaurantCity }}) on</p>
                <p class="reservation-text" id="reservation-info"></p>
                <div class="button-group">
                    <button class="button cancel-button" onclick="spanClick()">Cancel</button>
                    <form action="{{ route('booking', $restaurants->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="guest" id="guest_hidden">
                        <input type="hidden" name="tableType" id="area_hidden">
                        <input type="hidden" name="restaurantName" value="{{ $restaurants->restaurantName }}">
                        <input type="hidden" name="reservationDate" id="date_hidden">
                        <input type="hidden" name="reservationTime" id="time_hidden">
                        <input type="hidden" name="priceTotal" id="price_hidden">
                        <input type="hidden" name="menuData" id="menu_hidden">
                        <input type="hidden" name="tableRestaurantId" value="">
                        <input type="hidden" name="restaurantId" value="{{ $restaurants->id }}">
                        <button type="submit" class="button book-button">Book Table</button>
                    </form>

                    <form action="{{ route('indexMenu', $restaurants->id) }}" id="bookMenuForm" method="POST">
                        @csrf
                    </form>
                    <button class="button book-button" onclick="redirectToMenu()">Book Menu</button>
                </div>
            </div>
        </div>
        <script>
            //Clear Button buat reset date now
            document.addEventListener("DOMContentLoaded", function() {
                let dateInput = document.getElementById("inputDate");

                dateInput.addEventListener("input", function() {
                    if (!this.value) {
                        let today = new Date().toISOString().split('T')[0];
                        this.value = today;
                    }
                });
            });

            // document.getElementById('inputDate').addEventListener('change', function() {
            //     let selectedDate = this.value;
            //     const restaurantId = document.querySelector('input[name="restaurantId"]').value;

            //     fetch('/available-tables', {
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json',
            //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
            //                     'content') // Laravel CSRF token
            //             },
            //             body: JSON.stringify({
            //                 date: selectedDate,
            //                 restaurant_id: restaurantId
            //             }) // Kirim data sebagai JSON
            //         })
            //         .then(response => response.json())
            //         .then(data => {
            //             let availableTablesText = data.map(table =>
            //                 `*Available Table(s) : Capacity: ${table.capacity}, Available: ${table.available}`
            //             ).join("<br>");

            //             document.getElementById('availableTables').innerHTML = availableTablesText;
            //         })
            //         .catch(error => console.error('Error fetching available tables:', error));
            // });

            //Cek Available Tables
            document.addEventListener('DOMContentLoaded', function() {
                // Ambil nilai restaurant_id dari input hidden
                const restaurantId = document.querySelector('input[name="restaurantId"]').value;

                const guestSelect = document.getElementById('inputGuest');
                const dateInput = document.getElementById('inputDate');
                const timeSelect = document.getElementById('inputTime');
                const availableTablesSpan = document.getElementById('availableTables');

                function checkAvailableTables() {
                    const guest = guestSelect.value;
                    const reservationDate = dateInput.value;
                    const reservationTime = timeSelect.value;

                    if (!guest || !reservationDate || !reservationTime) {
                        return;
                    }

                    fetch('/check-available-tables', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                guest: guest,
                                reservationDate: reservationDate,
                                reservationTime: reservationTime,
                                restaurant_id: restaurantId
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Failed to fetch available tables');
                            }
                            return response.json();
                        })
                        .then(data => {
                            availableTablesSpan.innerHTML =
                                `<strong><em>*Available Tables :</em></strong> <strong><em>${data.availableTables}</em></strong>`;
                            // availableTablesSpan.textContent = data.availableTables;
                        })
                        .catch(error => {
                            console.error('Error checking available tables:', error);
                            availableTablesSpan.textContent = "Error!";
                        });
                }

                // Event listener untuk setiap input
                guestSelect.addEventListener('change', checkAvailableTables);
                dateInput.addEventListener('change', checkAvailableTables);
                timeSelect.addEventListener('change', checkAvailableTables);

                // Panggil saat halaman pertama kali dimuat
                checkAvailableTables();
            });



            // Select all navigation links and sections
            const navLinks = document.querySelectorAll('nav a[href^="#"]');
            const sections = Array.from(document.querySelectorAll('section[id]'));

            // Function to determine which section is currently most visible in the viewport
            function highlightActiveLink() {
                // Get current scroll position
                const scrollPosition = window.scrollY + window.innerHeight / 6;

                // Find the section that is currently most visible
                let currentSection = null;

                // Go through all sections and check if they're in view
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;

                    // Check if we've scrolled to this section
                    if (scrollPosition >= sectionTop && scrollPosition <= sectionTop + sectionHeight) {
                        currentSection = section;
                    }
                });

                // If we're before the first section, highlight the first nav link
                if (!currentSection && scrollPosition < sections[0].offsetTop) {
                    currentSection = sections[0];
                }

                // Remove 'active' class from all links
                navLinks.forEach(link => {
                    link.classList.remove('active');
                });

                // Add 'active' class to the appropriate link
                if (currentSection) {
                    const id = currentSection.getAttribute('id');
                    const activeLink = document.querySelector(`nav a[href="#${id}"]`);
                    if (activeLink) {
                        activeLink.classList.add('active');
                    }
                }
            }

            // Add scroll event listener with throttling for better performance
            let isScrolling = false;
            window.addEventListener('scroll', () => {
                if (!isScrolling) {
                    window.requestAnimationFrame(() => {
                        highlightActiveLink();
                        isScrolling = false;
                    });
                    isScrolling = true;
                }
            });

            // Run once on page load to set initial state
            document.addEventListener('DOMContentLoaded', () => {
                // Make sure sections are properly defined before running
                if (sections.length > 0) {
                    highlightActiveLink();
                }

                // Add smooth scrolling for better UX
                navLinks.forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        const targetId = link.getAttribute('href').substring(1);
                        const targetSection = document.getElementById(targetId);

                        if (targetSection) {
                            window.scrollTo({
                                top: targetSection.offsetTop,
                                behavior: 'smooth'
                            });
                        }
                    });
                });
            });


            document.addEventListener("DOMContentLoaded", function() {
                let reviews = document.querySelectorAll(".review-item");
                let seeMoreBtn = document.getElementById("see-more-btn");
                let visibleCount = 5;

                seeMoreBtn?.addEventListener("click", function() {
                    let hiddenReviews = Array.from(reviews).slice(visibleCount, visibleCount + 5);
                    hiddenReviews.forEach(review => review.style.display = "block");
                    visibleCount += 5;

                    if (visibleCount >= reviews.length) {
                        seeMoreBtn.style.display = "none";
                    }
                });
            });

            document.addEventListener("DOMContentLoaded", function() {
                let reviews = document.querySelectorAll(".review-item");
                let seeMoreBtn = document.getElementById("see-more-btn");
                let visibleCount = 5;

                seeMoreBtn?.addEventListener("click", function() {
                    let hiddenReviews = Array.from(reviews).slice(visibleCount, visibleCount + 5);
                    hiddenReviews.forEach(review => review.style.display = "block");
                    visibleCount += 5;

                    if (visibleCount >= reviews.length) {
                        seeMoreBtn.style.display = "none";
                    }
                });
            });
            var modal = document.getElementById("myModal");
            var span = document.getElementsByClassName("close")[0];
            const inputGuest = document.getElementById("inputGuest");
            // const inputArea = document.getElementById("inputArea");
            // document.getElementById('inputRestaurantName').value = "{{ $restaurants->restaurantName }}";

            const inputRestaurantName = document.getElementById("restaurantInfo");
            const inputDate = document.getElementById("inputDate");
            const inputTime = document.getElementById("inputTime");

            // console.log(inputArea);
            const guestInfo = document.getElementById("guest-info");
            const reservationInfo = document.getElementById("reservation-info");


            function myBtnClick(event) {
                // event.preventDefault(); // Prevent form submission
                // console.log("test")
                const guestValue = inputGuest.value;
                // const areaValue = inputArea.value;
                const restaurantNameValue = inputRestaurantName.value;
                const dateValue = inputDate.value;
                const timeValue = inputTime.value;

                const dateObject = new Date(dateValue);

                const formattedDate = dateObject.toLocaleDateString('en-GB', {
                    weekday: 'short', // "Tue"
                    day: '2-digit', // "31"
                    month: 'short', // "Dec"
                    year: 'numeric' // "2024"
                });

                // guestInfo.textContent = `${guestValue} guests at `;
                guestInfo.textContent = `${guestValue} Peoples at`;
                reservationInfo.innerHTML = `${formattedDate}, ${timeValue}WIB`;

                const guest_hidden = document.getElementById("guest_hidden");
                guest_hidden.value = inputGuest.value;

                // const area_hidden = document.getElementById("area_hidden");
                // area_hidden.value = inputArea.value;

                const restaurantName_hidden = document.getElementById("inputRestaurantName");
                restaurantName_hidden.value = inputRestaurantName.value;

                const date_hidden = document.getElementById("date_hidden");
                date_hidden.value = inputDate.value;

                const time_hidden = document.getElementById("time_hidden");
                time_hidden.value = inputTime.value;

                modal.style.display = "block";
            }

            const restaurantName = "{!! addslashes($restaurants->restaurantName) !!}";
            const restaurantCity = "{!! addslashes($restaurants->restaurantCity) !!}";
            const restaurantId = "{{ $restaurants->id }}";

            // function redirectToMenu() {
            //     const guestInfo = document.getElementById('guest-info').textContent;
            //     const restaurantName = '{{ $restaurants->restaurantName }}';
            //     const restaurantCity = '{{ $restaurants->restaurantCity }}';
            //     const reservationInfo = document.getElementById('reservation-info').textContent;

            //     // console.log(restaurantName);
            //     const restaurantId = '{{ $restaurants->id }}';
            //     // const nextPageUrl = `/restaurantMenu/${restaurantId}?guest_info=${encodeURIComponent(guestInfo)}&reservation_info=${encodeURIComponent(reservationInfo)}&restaurant_name=${encodeURIComponent(restaurantName)}&restaurant_city=${encodeURIComponent(restaurantCity)}`;
            //     const nextPageUrl =
            //         `{{ route('indexMenu', '') }}/${restaurantId}?guest_info=${encodeURIComponent(guestInfo)}&reservation_info=${encodeURIComponent(reservationInfo)}&restaurant_name=${encodeURIComponent(restaurantName)}&restaurant_city=${encodeURIComponent(restaurantCity)}`;

            //     window.location.href = nextPageUrl;
            // }

            function redirectToMenu() {
                const guestInfo = inputGuest.value;
                // const areaInfo = inputArea.value;
                // const reservationInfo = document.getElementById('reservation-info').textContent;
                const reservationDate = inputDate.value;
                const reservationTime = inputTime.value;

                const form = document.getElementById('bookMenuForm');

                const giForm = document.createElement('input');
                giForm.type = 'hidden';
                giForm.name = 'guestInfo';
                giForm.value = guestInfo;
                form.appendChild(giForm);

                // const aiForm = document.createElement('input');
                // aiForm.type = 'hidden';
                // aiForm.name = 'areaInfo';
                // aiForm.value = areaInfo;
                // form.appendChild(aiForm);

                const rdForm = document.createElement('input');
                rdForm.type = 'hidden';
                rdForm.name = 'reservationDate';
                rdForm.value = reservationDate;
                form.appendChild(rdForm);

                const rtForm = document.createElement('input');
                rtForm.type = 'hidden';
                rtForm.name = 'reservationTime';
                rtForm.value = reservationTime;
                form.appendChild(rtForm);

                const rnForm = document.createElement('input');
                rnForm.type = 'hidden';
                rnForm.name = 'restaurantName';
                rnForm.value = restaurantName;
                form.appendChild(rnForm);

                const rcForm = document.createElement('input');
                rcForm.type = 'hidden';
                rcForm.name = 'restaurantCity';
                rcForm.value = restaurantCity;
                form.appendChild(rcForm);

                const riForm = document.createElement('input');
                riForm.type = 'hidden';
                riForm.name = 'restaurantId';
                riForm.value = restaurantId;
                form.appendChild(riForm);


                form.submit();
            }

            function spanClick() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }


            function changeImage(newSrc) {
                // Get the main image element
                const mainImage = document.getElementById('mainImage');

                mainImage.classList.remove('fade-in');
                // Add the fade-out class to initiate the fade-out effect
                mainImage.classList.add('fade-out');

                // Wait for the fade-out animation to complete (0.5s duration)
                setTimeout(function() {
                    // Change the image source
                    mainImage.src = "{{ URL::to('/') . '/' }}" + newSrc;

                    // Remove fade-out and add fade-in for the new image
                    mainImage.classList.remove('fade-out');
                    mainImage.classList.add('fade-in');
                }, 500); // This timeout corresponds to the fade-out duration
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Include Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            $(document).ready(function() {
                // Display error messages if any
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        toastr.error("{{ $error }}");
                    @endforeach
                @endif

                // Display success message if session has success message
                @if (session('success'))
                    toastr.success("{{ session('success') }}");
                @endif
            });
        </script>
    @endsection
</body>

</html>
