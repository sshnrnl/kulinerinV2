<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\MenuRestaurant;
use App\Models\RatingRestaurant;
use App\Models\Reservation;
use App\Models\TableRestaurant;
use App\Models\User;
use Carbon\Carbon;


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

    public function checkAvailableTables(Request $request)
    {
        // Validasi input
        $request->validate([
            'guest' => 'required|integer',
            'reservationDate' => 'required|date',
            'reservationTime' => 'required',
            'restaurant_id' => 'required|integer'
        ]);

        $guest = $request->guest;
        $date = $request->reservationDate;
        $time = $request->reservationTime;
        $restaurantId = $request->restaurant_id;

        // Cari meja yang sesuai dengan kapasitas dan restaurant_id
        $tables = TableRestaurant::where('restaurant_id', $restaurantId)
            ->where('tableCapacity', '>=', $guest)
            ->orderBy('tableCapacity', 'asc')
            ->get();

        if ($tables->isEmpty()) {
            return response()->json(['availableTables' => 0]);
        }

        // Ubah format waktu untuk pencarian
        $reservationDateTime = Carbon::parse($date . ' ' . $time);
        $availableTables = 0;

        foreach ($tables as $table) {
            // Tentukan durasi reservasi (2 jam)
            $reservationStart = $reservationDateTime->copy();
            $reservationEnd = $reservationDateTime->copy()->addHours(2);

            // Cek reservasi yang tumpang tindih
            $existingReservations = Reservation::where('table_restaurant_id', $table->id)
                ->where(function ($query) use ($reservationStart, $reservationEnd) {
                    $query->whereRaw("CONCAT(reservationDate, ' ', reservationTime) <= ?", [$reservationEnd->format('Y-m-d H:i')])
                        ->whereRaw("DATE_ADD(CONCAT(reservationDate, ' ', reservationTime), INTERVAL 2 HOUR) >= ?", [$reservationStart->format('Y-m-d H:i')]);
                })
                ->count();

            // Hitung jumlah meja yang tersedia
            $availableTables += max(0, $table->availableTables - $existingReservations);
        }

        return response()->json(['availableTables' => $availableTables]);
    }


    // public function getAvailableTables(Request $request)
    // {
    //     $restaurantId = $request->input('restaurant_id'); // Ambil restaurant_id dari request
    //     $reservationDate = $request->input('date'); // Ambil tanggal dari request

    //     // Validasi input (optional)
    //     if (!$restaurantId || !$reservationDate) {
    //         return response()->json(['error' => 'Missing restaurant_id or date'], 400);
    //     }

    //     // Ambil hanya meja yang sesuai dengan restaurant_id
    //     $tables = TableRestaurant::where('restaurant_id', $restaurantId)->get()->map(function ($table) use ($reservationDate) {
    //         // Hitung jumlah reservasi untuk meja ini pada tanggal tertentu
    //         $reservedCount = Reservation::where('table_restaurant_id', $table->id)
    //             ->where('reservationDate', $reservationDate)
    //             ->count();

    //         // Hitung sisa meja yang tersedia
    //         $availableTables = max(0, $table->availableTables - $reservedCount);

    //         return [
    //             'id' => $table->id,
    //             'capacity' => $table->tableCapacity,
    //             'available' => $availableTables,
    //         ];
    //     });

    //     return response()->json($tables);
    // }




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
