<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
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

        /* .image-placeholder {
            background-color: #dee2e6;
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        } */
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
            background-color: #6c757d;
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

        @media (max-width: 767.98px) {
            .transaction-card {
                display: flex;
                flex-direction: row;
            }

            .transaction-image {
                width: 150px;
                min-width: 150px;
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
                <div class="col-md-3 mb-3 filter-section" id="filterSection">
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
                        <p>No reservations found.</p>
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


                                {{-- <div class="image-placeholder h-100">
                                    <img src="{{ asset('storage/' . $reservation->restaurant->restaurantImage) }}">
                                </div> --}}
                                <div class="transaction-details p-3">
                                    <h4 class="card-title mb-2">
                                        {{ $reservation->restaurantName ?? ($reservation->restaurantName ?? 'Unknown Restaurant') }}
                                    </h4>
                                    <p class="card-text mb-1">
                                        <i class="fas fa-map-marker-alt location-icon"></i>
                                        <span class="address-text">
                                            {{ $reservation->restaurant->restaurantAddress ?? 'Address Not Available' }}
                                        </span>
                                    </p>
                                    <p class="card-text mb-1">
                                        <strong>Date:</strong> {{ $reservation->reservationDate }} |
                                        <strong>Time:</strong> {{ $reservation->reservationTime }}
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
                                            {{ $reservation->reservationStatus == 'CONFIRMED' ? 'bg-success' : 'bg-warning' }}">
                                                {{ $reservation->reservationStatus }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="rating-container">
                                        <button class="btn btn-sm btn-outline-dark">
                                            Give Rating <i class="fas fa-edit ms-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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

                    <!-- See More Link -->
                    <p class="text-center mt-4 text-muted">Display all transaction records...</p>
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
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
    </script>
</body>

</html>
