<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\MenuRestaurant;
use App\Models\RatingRestaurant;
use App\Models\TableRestaurant;
use App\Models\User;

class RestaurantController extends Controller
{
    public function searchRestaurant(Request $request)
    {
        $search = $request->query('keyword');
        $location = $request->query('location');
        $minRating = $request->query('min_rating');
        $restaurants = Restaurant::query();

        if ($search) {
            $searchWords = explode(' ', $search);
            $restaurants = $restaurants->where(function ($query) use ($searchWords) {
                foreach ($searchWords as $word) {
                    $query->where(function ($q) use ($word) {
                        $q->where('restaurantName', 'like', '%' . $word . '%');
                        //   ->orWhere('restaurantAddress', 'like', '%' . $word . '%');
                    });
                }
            });
        }

        if ($location) {
            $locationWords = explode(' ', $location);
            $restaurants = $restaurants->where(function ($query) use ($locationWords) {
                foreach ($locationWords as $word) {
                    $query->where(function ($q) use ($word) {
                        $q->where('restaurantAddress', 'like', '%' . $word . '%');
                    });
                }
            });
        }


        $restaurants = $restaurants->paginate(5);
        $restaurants->getCollection()->transform(function ($restaurant) use ($minRating) {
            $ratingData = $this->getRating($restaurant->id); // call rating function
            $restaurant->restaurantImage = strtok($restaurant->restaurantImage, ',');
            $restaurant->averageScore = $ratingData['averageScore'];
            $restaurant->totalReviewers = $ratingData['totalReviewers'];

            return $restaurant;
        });
        // if ($minRating) {
        //     $restaurants->setCollection($restaurants->getCollection()->filter(function ($restaurant) use ($minRating) {
        //         return $restaurant->averageScore >= $minRating;
        //         return round($restaurant->averageScore) == $minRating;
        //     }));
        // }

        if ($minRating) {
            $restaurants->setCollection($restaurants->getCollection()->filter(function ($restaurant) use ($minRating) {
                // Calculate the minimum and maximum based on the selected rating
                $minRange = $minRating;
                $maxRange = $minRating + 0.99; // The upper bound is one less than the next whole number

                // Filter restaurants based on the dynamic range
                return $restaurant->averageScore >= $minRange && $restaurant->averageScore < $maxRange;
            }));
        }

        return view('index.restaurantSearchIndex', compact('restaurants'));
    }
    public function indexRestaurants($id)
    {
        $restaurants = Restaurant::findOrFail($id);
        $menuItems = MenuRestaurant::where('restaurant_id', $id)
        ->orderBy('category')
        ->get()
        ->groupBy('category');
        $images = explode(', ', $restaurants->restaurantImage);

        $ratingData = $this->getRating($id);

        // Ambil kapasitas tertinggi dari meja yang tersedia
        $maxCapacity = TableRestaurant::where('restaurant_id', $id)
            ->max('tableCapacity');
        // dd($maxCapacity);
        // Pastikan $maxCapacity adalah integer, jika null set default ke 1
        $maxCapacity = $maxCapacity ? (int) $maxCapacity : 1;

        // Buat array dari 1 sampai kapasitas tertinggi
        $capacities = range(1, $maxCapacity);

        $totalAvailableTables = TableRestaurant::where('restaurant_id', $id)
            ->sum('availableTables');

        return view('index.restaurantIndex', compact('restaurants', 'ratingData', 'images', 'menuItems', 'capacities', 'totalAvailableTables'));
    }
    public function getRating($id)
    {
        $restaurant = Restaurant::with('ratingRestaurants.user')->findOrFail($id);

        return [
            'restaurant' => $restaurant,
            'averageScore' => $restaurant->ratingRestaurants->avg('score') ?? 0,
            'totalReviewers' => $restaurant->ratingRestaurants->count(),
            'reviews' => $restaurant->ratingRestaurants,
        ];
    }
    public function indexMenu($id)
    {
        $menuItems = MenuRestaurant::where('restaurant_id', $id)
        ->orderBy('category')
        ->get()
        ->groupBy('category');
        $restaurants = Restaurant::find($id);

        return view('menu.index', compact( 'menuItems','restaurants'));
    }
}
