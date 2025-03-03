<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RatingRestaurant;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;


class RatingRestaurantController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'reservation_id' => 'required|exists:reservations,id',
            'score' => 'required|in:1,2,3,4,5',
            'review' => 'required|string|max:255',
        ]);

        // Pastikan pengguna memiliki reservasi yang sesuai
        $reservation = Reservation::where('id', $request->reservation_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$reservation) {
            return response()->json(['message' => 'Unauthorized or invalid reservation'], 403);
        }

        // Simpan rating ke database
        $rating = RatingRestaurant::create([
            'restaurant_id' => $request->restaurant_id,
            'reservation_id' => $request->reservation_id,
            'user_id' => Auth::id(),
            'score' => $request->score,
            'review' => $request->review,
        ]);

        return response()->json(['message' => 'Thanks for your feedback!', 'data' => $rating], 201);
    }

}
