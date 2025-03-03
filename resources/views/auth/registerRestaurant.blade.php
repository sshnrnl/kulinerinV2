<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Kuliner IN</title>
    <link rel="icon" href="{{ asset('asset/kulinerinLogo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('css/authStyle.css') }}" rel="stylesheet">
</head>

<body>
    @extends('toastr.message')
    <div class="container">
        <!-- Logo is placed outside the login form box -->
        <div class="logo-container">
            <img src="{{ asset('asset/kulinerinLogo.png') }}" alt="Logo">
        </div>
        <!-- Login form box starts here -->
        <div class="login-container">
            <h1>Register Restaurant</h1>

            <!-- Login form -->
            <form action="{{ url('registerrestaurant') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}"
                        required>
                </div>

                {{-- <div class="input-group">
                <input type="text" name="restaurantName" id="restaurantName" placeholder="Restaurant Name" value="{{ old('restaurantName') }}" required>
            </div> --}}

                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>

                <div class="input-group">
                    <input type="password" name="confirmation_password" id="confirmation_password"
                        placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="login-button">Register</button>
            </form>

            <form action="/register" method="GET">
                <button type="submit" class="google-button">Back</button>
            </form>
        </div>
    </div>

</body>

</html>
