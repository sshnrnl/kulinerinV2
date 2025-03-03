<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function guestDashboard()
    {
        $restaurants = Restaurant::inRandomOrder()->take(3)->get();
        $restaurantsDine = Restaurant::inRandomOrder()->take(3)->get();
        $restaurantsHoliday = Restaurant::inRandomOrder()->take(3)->get();

        foreach ($restaurants as $restaurant) {
            $restaurant->firstImage = $this->getRandomImage($restaurant->restaurantImage);
        }

        foreach ($restaurantsDine as $restaurant) {
            $restaurant->firstImage = $this->getRandomImage($restaurant->restaurantImage);
        }

        foreach ($restaurantsHoliday as $restaurant) {
            $restaurant->firstImage = $this->getRandomImage($restaurant->restaurantImage);
        }
        return view('dashboard.guestDashboard', compact('restaurants', 'restaurantsDine', 'restaurantsHoliday'));
    }
    public function getRandomImage($restaurantImage)
    {
        if ($restaurantImage) {
            $images = explode(', ', $restaurantImage);
            return $images[array_rand($images)];
        }
        return null;
    }

    public function searchRestaurantbyGuest(Request $request)
    {
        $search = $request->query('keyword');
        // dd($search);
        $restaurants = Restaurant::query();

        if ($search) {
            $searchWords = explode(' ', $search);

            $restaurants = $restaurants->where(function ($query) use ($searchWords) {
                foreach ($searchWords as $word) {
                    $query->where(function ($q) use ($word) {
                        $q->where('restaurantName', 'like', '%' . $word . '%')
                            ->orWhere('restaurantAddress', 'like', '%' . $word . '%');
                    });
                }
            });
        }

        $restaurants = $restaurants->paginate(5);

        return view('guest.searchRestaurant', compact('restaurants'));
    }
}
