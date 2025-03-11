<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #DECEB0ff;
        }

        .filter-card {
            background-color: #F0D4A3;
            border-radius: 8px;
            padding: 20px;
        }

        .transaction-card {
            border-radius: 8px;
            margin-bottom: 15px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .apply-button {
            background-color: #D67B47ff;
            color: white;
            border: none;
        }

        .image-placeholder {
            width: 100%;
            height: 150px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        .rating-stars {
            color: #000;
        }

        .rating-stars .filled {
            color: #000;
        }

        .rating-stars .empty {
            color: #dee2e6;
        }

        .location-icon {
            margin-right: 5px;
            color: #6c757d;
        }

        .address-text {
            font-size: 0.9rem;
        }

        .status-label {
            font-weight: bold;
        }

        /* Custom css for image placement */
        .transaction-image {
            width: 200px;
            min-width: 200px;
        }

        .transaction-details {
            flex: 1;
            position: relative;
            padding-bottom: 40px;
            /* Space for the rating */
        }

        /* Rating positioning */
        .rating-container {
            position: absolute;
            bottom: 10px;
            right: 15px;
        }

        .rating-container:hover {
            transform: scale(1.1);
            /* Perbesar saat hover */
            transition: transform 0.3s ease-in-out;
        }

        /* Overlay filter button */
        .filter-toggle {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: auto;
            z-index: 1000;
            border-radius: 50px;
            padding: 10px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            background-color: #D67B47ff;
            color: white;
            border: none;
            font-weight: 500;
        }

        /* Positioning for filter section when shown as overlay */
        .filter-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
            justify-content: center;
            align-items: center;
        }

        .filter-content {
            width: 90%;
            max-width: 350px;
            max-height: 90vh;
            overflow-y: auto;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            position: relative;
        }

        .close-filter {
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            border: none;
            font-size: 1.5rem;
            line-height: 1;
        }

        .stars {
            color: #f97e0a;
            font-size: 24px;
        }

        @media (max-width: 767.98px) {
            .transaction-card {
                display: flex;
                flex-direction: row;
            }

            .transaction-image {
                width: 160px;
                min-width: 160px;
            }

            .filter-section {
                display: none;
            }

            .filter-toggle {
                display: block;
            }

            .filter-overlay.active {
                display: flex;
            }
        }
    </style>
</head>

<body>
    @extends('master.masterCustomer')
    @section('content')
        <div class="container py-4">
            <!-- Desktop Filter Section -->
            <div class="row">
                <div class="col-md-3 mb-3 filter-section ms-n2" id="filterSection">
                    <div class="filter-card">
                        <form>
                            <div class="mb-3">
                                <label for="fromDate" class="form-label">From Date</label>
                                <input type="date" class="form-control" id="fromDate">
                            </div>
                            <div class="mb-3">
                                <label for="toDate" class="form-label">To Date</label>
                                <input type="date" class="form-control" id="toDate">
                            </div>
                            <button type="submit" class="btn apply-button w-100">Apply</button>
                        </form>
                    </div>
                </div>


                <!-- Transaction History Section -->
                <div class="col-md-9">
                    <h2 class="mb-4 fw-bold">Transaction History</h2>

                    <hr>
                    @if ($reservations->isEmpty())
                        <p class="text-muted" style="text-align: center">No reservations found.</p>
                    @else
                        @foreach ($reservations as $reservation)
                            <div class="transaction-card bg-white d-flex mb-3">
                                @php
                                    $imagePaths = explode(',', $reservation->restaurant->restaurantImage);
                                    $firstImage = trim($imagePaths[0]);
                                @endphp
                                <div class="transaction-image">
                                    <div class="image-placeholder h-100">
                                        <img src="{{ asset('storage/' . $firstImage) }}" alt="Restaurant Image"
                                            class="img-fluid image-cover">
                                    </div>
                                </div>
                                <div class="transaction-details p-3">
                                    <h4 class="card-title mb-2">
                                        {{ $reservation->restaurantName ?? ($reservation->restaurantName ?? 'Unknown Restaurant') }}
                                    </h4>
                                    {{-- Kl mau statusnya di kanan atas
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-2">
                                            {{ $reservation->restaurantName ?? 'Unknown Restaurant' }}
                                        </h4>
                                        <div class="status">
                                            <p class="card-text mb-0">
                                                <span class="status-label badge
                                                    {{ $reservation->reservationStatus == 'CONFIRMED' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $reservation->reservationStatus }}
                                                </span>
                                            </p>
                                        </div>
                                    </div> --}}
                                    <p class="card-text mb-1">
                                        <span>📍
                                            {{ $reservation->restaurant->restaurantAddress ?? 'Address Not Available' }}
                                        </span>
                                    </p>
                                    <p class="card-text mb-1 fst-italic">
                                        Booking Code : {{ $reservation->bookingCode }}
                                    </p>
                                    <p class="card-text mb-3 fst-italic">
                                        Date:
                                        {{ \Carbon\Carbon::parse($reservation->reservationDate)->locale('en')->translatedFormat('j F Y') }}
                                        |
                                        Time: {{ \Carbon\Carbon::parse($reservation->reservationTime)->format('H:i') }} WIB
                                    </p>
                                    {{-- <p class="card-text mb-1">
                                    <strong>Guests:</strong> {{ $reservation->guest }}
                                </p>
                                <p class="card-text mb-1">
                                    <strong>Menu Ordered:</strong>
                                    @if (!empty($reservation->menuData) && is_string($reservation->menuData))
                                        @php
                                            $menuItems = json_decode($reservation->menuData, true);
                                        @endphp

                                        @if (is_array($menuItems))
                                            <p class="card-text mb-1"><strong>Menu Ordered:</strong></p>
                                            <ul>
                                                @foreach ($menuItems as $menu)
                                                    <li>{{ $menu['qty'] }}x {{ $menu['menuName'] }} - Rp
                                                        {{ number_format($menu['menuPrice'], 0, ',', '.') }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No menu ordered</p>
                                        @endif
                                    @else
                                        <p>No menu ordered</p>
                                    @endif

                                </p>
                                <p class="card-text">
                                    <strong>Total Price:</strong> Rp
                                    {{ number_format($reservation->priceTotal, 0, ',', '.') }}
                                </p> --}}
                                    <div class="status">
                                        <p class="card-text">
                                            <span
                                                class="status-label badge
                                                    {{ $reservation->reservationStatus == 'On Going' ? 'bg-warning' : '' }}
                                                    {{ $reservation->reservationStatus == 'Arrived' ? 'bg-primary' : '' }}
                                                    {{ $reservation->reservationStatus == 'Finished' ? 'bg-success' : '' }}
                                                    {{ $reservation->reservationStatus == 'Cancelled' ? 'bg-danger' : '' }}">
                                                {{ $reservation->reservationStatus }}
                                            </span>
                                        </p>
                                        <div class="rating-container mb-3">
                                            @if ($reservation->reservationStatus == 'On Going')
                                                <button class="btn btn-sm btn-outline-danger cancel-order"
                                                    data-id="{{ $reservation->id }}">
                                                    Cancel Order <i class="fas fa-times ms-1"></i>
                                                </button>
                                            @elseif ($reservation->reservationStatus == 'Arrived')
                                                <button class="btn btn-sm btn-outline-primary finish-order"
                                                    data-id="{{ $reservation->id }}">
                                                    Finish Order <i class="fas fa-check ms-1"></i>
                                                </button>
                                            @elseif ($reservation->reservationStatus == 'Finished')
                                                @php
                                                    $userRating = $reservation->restaurant->ratingRestaurants
                                                        ->where('user_id', auth()->id())
                                                        ->where('reservation_id', $reservation->id)
                                                        ->first();
                                                @endphp
                                                @if ($userRating)
                                                    <p class="stars mb-1" style="margin-top: 1rem; font-size: 24px;">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if ($i < $userRating->score)
                                                                <span style="color: #f97e0a;">&#9733;</span>
                                                                <!-- Bintang terisi -->
                                                            @else
                                                                <span style="color: gray;">&#9733;</span>
                                                                <!-- Bintang kosong -->
                                                            @endif
                                                        @endfor
                                                    </p>
                                                @else
                                                    <button class="btn btn-sm border-dark give-rating-btn"
                                                        data-reservation-id="{{ $reservation->id }}"
                                                        data-restaurant-id="{{ $reservation->restaurant_id }}"
                                                        data-bs-toggle="modal" data-bs-target="#ratingModal">
                                                        Give Rating <i class="fas fa-edit ms-1"></i>
                                                    </button>
                                                @endif
                                            @endif


                                        </div>
                                    </div>



                                </div>
                            </div>
                        @endforeach
                        <!-- See More Link -->
                        <p class="text-center mt-4 text-muted">Display all transaction records...</p>
                    @endif

                    <!-- Transaction Card 1 -->
                    {{-- <div class="transaction-card bg-white d-flex">
                    <div class="transaction-image">
                        <div class="image-placeholder h-100">IMAGE</div>
                    </div>
                    <div class="transaction-details p-3">
                        <h4 class="card-title mb-2">Wing Heng</h4>
                        <p class="card-text mb-1">
                            <i class="fas fa-map-marker-alt location-icon"></i>
                            <span class="address-text">Jl. Danau Sunter Utara Blok D1 No. 12 - 13</span>
                        </p>
                        <p class="card-text mb-1">Date</p>
                        <div class="status">
                            <p class="card-text">
                                <span class="status-label">Status</span>
                            </p>
                        </div>
                        <div class="rating-container">
                            <button class="btn btn-sm btn-outline-dark">
                                Give Rating <i class="fas fa-edit ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                    {{-- DIV TRANSACTION --}}
                    {{-- <div class="transaction-card bg-white d-flex">
                    <div class="transaction-image">
                        <div class="image-placeholder h-100">IMAGE</div>
                    </div>
                    <div class="transaction-details p-3">
                        <h4 class="card-title mb-2">Wing Heng</h4>
                        <p class="card-text mb-1">
                            <i class="fas fa-map-marker-alt location-icon"></i>
                            <span class="address-text">Jl. Danau Sunter Utara Blok D1 No. 12 - 13</span>
                        </p>
                        <p class="card-text mb-1">Date</p>
                        <div class="status">
                            <p class="card-text">
                                <span class="status-label">Status</span>
                            </p>
                        </div>
                        <div class="rating-container">
                            <div class="rating-stars">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star empty"></i>
                            </div>
                        </div>
                    </div>
                </div> --}}

                    {{-- <!-- See More Link -->
                    <p class="text-center mt-4 text-muted">Display all transaction records...</p> --}}
                </div>
            </div>
        </div>

        <!-- Overlay Filter Toggle Button -->
        <button class="filter-toggle" id="filterToggle">
            <i class="fas fa-filter me-2"></i>Filters
        </button>

        <!-- Overlay Filter Section -->
        <div class="filter-overlay" id="filterOverlay">
            <div class="filter-content">
                <button class="close-filter" id="closeFilter">×</button>
                <h5 class="mb-3">Filter Transactions</h5>
                <form>
                    <div class="mb-3">
                        <label for="overlayFromDate" class="form-label">From Date</label>
                        <input type="date" class="form-control" id="overlayFromDate">
                    </div>
                    <div class="mb-3">
                        <label for="overlayToDate" class="form-label">To Date</label>
                        <input type="date" class="form-control" id="overlayToDate">
                    </div>
                    <button type="submit" class="btn apply-button w-100">Apply</button>
                </form>
            </div>
        </div>

        <!-- Modal Rating -->
        <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ratingModalLabel">Give Rating</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="ratingForm">
                            @csrf
                            <input type="hidden" id="restaurant_id" name="restaurant_id">
                            <input type="hidden" id="reservation_id" name="reservation_id">

                            <div class="mb-3">
                                <label for="score" class="form-label">Rating</label>
                                <div id="starRating" class="star-rating d-flex align-items-center mb-2">
                                    <!-- Stars -->
                                    <span class="stars" data-value="1">&#9734;</span>
                                    <span class="stars" data-value="2">&#9734;</span>
                                    <span class="stars" data-value="3">&#9734;</span>
                                    <span class="stars" data-value="4">&#9734;</span>
                                    <span class="stars" data-value="5">&#9734;</span>
                                </div>
                                <input type="hidden" id="score" name="score" value="">
                                <span id="ratingDescription" class=""></span>
                            </div>

                            <div class="mb-3">
                                <label for="review" class="form-label">Review</label>
                                <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Rating</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Toggle filter overlay
            document.getElementById('filterToggle').addEventListener('click', function() {
                document.getElementById('filterOverlay').classList.add('active');
            });

            // Close filter overlay
            document.getElementById('closeFilter').addEventListener('click', function() {
                document.getElementById('filterOverlay').classList.remove('active');
            });

            // Close overlay when clicking outside the filter content
            document.getElementById('filterOverlay').addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('active');
                }
            });

            $(document).ready(function() {
                $(".cancel-order").click(function() {
                    let reservationId = $(this).data("id"); // Ambil ID reservasi dari tombol

                    // Tampilkan SweetAlert untuk konfirmasi
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Do you really want to cancel this reservation?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, confirm it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika dikonfirmasi, jalankan AJAX
                            $.ajax({
                                url: `/reservation/${reservationId}/cancel`,
                                type: "DELETE",
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                        "content") // CSRF Token
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: "Cancelled!",
                                        text: response.message,
                                        icon: "success",
                                        confirmButtonText: "OK"
                                    }).then(() => {
                                        location
                                            .reload(); // Reload halaman setelah sukses
                                    });
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        title: "Error!",
                                        text: xhr.responseJSON.message ||
                                            "Something went wrong!",
                                        icon: "error",
                                        confirmButtonText: "OK"
                                    });
                                }
                            });
                        }
                    });
                });
            });

            $(document).ready(function() {
                $(".finish-order").click(function() {
                    let reservationId = $(this).data("id"); // Ambil ID reservasi dari tombol

                    // Tampilkan SweetAlert untuk konfirmasi
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Do you really want to finished this reservation?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, confirm it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika dikonfirmasi, jalankan AJAX
                            $.ajax({
                                url: `/reservation/${reservationId}/finish`,
                                type: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                        "content") // CSRF Token
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: "Finished!",
                                        text: response.message,
                                        icon: "success",
                                        confirmButtonText: "OK"
                                    }).then(() => {
                                        location
                                            .reload(); // Reload halaman setelah sukses
                                    });
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        title: "Error!",
                                        text: xhr.responseJSON.message ||
                                            "Something went wrong!",
                                        icon: "error",
                                        confirmButtonText: "OK"
                                    });
                                }
                            });
                        }
                    });
                });
            });

            document.addEventListener("DOMContentLoaded", function() {
                const stars = document.querySelectorAll("#starRating .stars");
                const ratingDescription = document.getElementById("ratingDescription");

                // Define rating descriptions
                const descriptions = {
                    1: "Very Bad",
                    2: "Bad",
                    3: "Average",
                    4: "Good",
                    5: "Very Good"
                };

                stars.forEach((stars, index) => {
                    stars.addEventListener("click", () => {
                        const rating = index + 1;
                        updateStars(rating);
                        ratingDescription.textContent = descriptions[rating]; // Update description
                        score.value = rating;
                    });
                });

                function updateStars(rating) {
                    stars.forEach((stars, idx) => {
                        if (idx < rating) {
                            stars.classList.add("filled-star");
                            stars.innerHTML = "&#9733;";
                        } else {
                            stars.classList.remove("filled-star");
                            stars.innerHTML = "&#9734;";
                        }
                    });
                }
            });

            $(document).ready(function() {
                $(".give-rating-btn").click(function() {
                    let restaurantId = $(this).data("restaurant-id");
                    let reservationId = $(this).data("reservation-id");

                    console.log(reservationId);
                    $("#restaurant_id").val(restaurantId);
                    $("#reservation_id").val(reservationId);
                });

                $("#ratingForm").on("submit", function(e) {
                    e.preventDefault();

                    let formData = {
                        _token: "{{ csrf_token() }}",
                        restaurant_id: $("#restaurant_id").val(),
                        reservation_id: $("#reservation_id").val(),
                        score: $("#score").val(),
                        review: $("#review").val()
                    };
                    console.log(formData);

                    $.ajax({
                        url: @json(route('rating.store')),
                        method: "POST",
                        data: formData,
                        dataType: "json",
                        success: function(response) {
                            Swal.fire({
                                title: "Success!",
                                text: response.message,
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => {
                                $("#ratingModal").modal("hide");
                                location.reload();

                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: "Error!",
                                text: xhr.responseJSON.message || "Something went wrong!",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    });
                });
            });
        </script>
    @endsection
</body>

</html>
