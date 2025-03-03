@extends('dashboard.restaurantDashboard')

@section('title', 'Home')

@section('content')
    <div class="container">
        <h3>Welcome to Dashboard, {{ $restaurant->restaurantName }}</h3>
        <p>This is the home page content.</p>
    </div>
@endsection
