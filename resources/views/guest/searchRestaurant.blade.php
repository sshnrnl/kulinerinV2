<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{{ asset('asset/kulinerinLogo.png') }}" type="image/png">
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, sans-serif;
        }

        .main-content {
            display: flex;
            padding: 2rem;
            gap: 2rem;
            background-color: #f9f9f9;
            min-height: 100vh;
        }

        .filters {
            width: 300px;
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            height: fit-content;
        }

        .filter-section {
            margin-bottom: 1.5rem;
        }

        .filter-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }

        .filter-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #333;
            background: #f8f8f8;
        }

        .filter-input:focus {
            outline: none;
            border-color: #999;
            background: white;
        }

        .rating-options {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .rating-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .operational-hours {
            display: flex;
            gap: 0.5rem;
        }

        .time-input {
            width: 50%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .apply-btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #666;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
        }


        .results {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .restaurant-card {
            display: flex;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .restaurant-image-search {
            width: 200px;
            height: 150px;
            background-color: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
        }

        .restaurant-info {
            padding: 1.5rem;
            flex-grow: 1;
        }

        .restaurant-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .restaurant-address {
            color: #666;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stars {
            color: #ffd700;
        }
    </style>
</head>

<body>
    @extends('master.masterGuest')
    @section('content')
        <main class="main-content">
            <aside class="filters">
                <div class="filter-section">
                    <h3 class="filter-title">Location</h3>
                    <input type="text" class="filter-input" placeholder="Enter location">
                </div>

                <div class="filter-section">
                    <h3 class="filter-title">Rating</h3>
                    <div class="rating-options">
                        <label class="rating-option">
                            <input type="checkbox">
                            <span class="stars">★★★★★</span>
                        </label>
                        <label class="rating-option">
                            <input type="checkbox">
                            <span class="stars">★★★★☆</span>
                        </label>
                        <label class="rating-option">
                            <input type="checkbox">
                            <span class="stars">★★★☆☆</span>
                        </label>
                        <label class="rating-option">
                            <input type="checkbox">
                            <span class="stars">★★☆☆☆</span>
                        </label>
                        <label class="rating-option">
                            <input type="checkbox">
                            <span class="stars">★☆☆☆☆</span>
                        </label>
                    </div>
                </div>

                <div class="filter-section">
                    <h3 class="filter-title">Operational Hour</h3>
                    <div class="operational-hours">
                        <input type="time" class="time-input" placeholder="From">
                        <input type="time" class="time-input" placeholder="To">
                    </div>
                </div>

                <button class="apply-btn">Apply</button>
            </aside>

            <div class="results">
                @foreach ($restaurants as $restaurant)
                    <div class="restaurant-card">
                        <div class="restaurant-image-search">{{ asset($restaurant->restaurantImage) }}</div>
                        <div class="restaurant-info">
                            <h2 class="restaurant-name">{{ $restaurant->restaurantName }}</h2>
                            <p class="restaurant-address">
                                <span>📍</span>
                                {{ $restaurant->restaurantAddress }}
                            </p>
                            <div class="rating">
                                <span class="stars">★★★★☆</span>
                                <span>(100 Reviews)</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    @endsection
</body>

</html>
