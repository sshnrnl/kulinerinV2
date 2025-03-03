<!DOCTYPE html>
<html>

<head>
    <title>Reservation Details</title>
</head>

<body>
    <h3>Dear {{ $reservation['username'] }},</h3>
    <p>Thank you for your reservation. Here are the details:</p>
    <ul>
        <li><strong>Reservation ID:</strong> {{ $reservation['bookingCode'] }}</li>
        <li><strong>Guests:</strong> {{ $reservation['guest'] }}</li>
        <li><strong>Date:</strong> {{ $reservation['reservationDate'] }}</li>
        <li><strong>Time:</strong> {{ $reservation['reservationTime'] }}</li>
    </ul>

    <h4>Ordered Menu:</h4>
    @if (!empty($reservation['menuDetails']))
        <ul>
            @foreach (explode(', ', $reservation['menuDetails']) as $menuItem)
                <li>{{ $menuItem }}</li>
            @endforeach
        </ul>
    @else
        <p><em>No menu items were ordered.</em></p>
    @endif

    <p>We look forward to seeing you!</p>
</body>

</html>
