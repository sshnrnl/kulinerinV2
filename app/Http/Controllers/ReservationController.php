<?php

namespace App\Http\Controllers;

use App\Mail\ReceiptMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\Receipt;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function booking(Request $request)
    {
        $booking = new Reservation();
        $booking->user_id = auth()->id();
        $booking->guest = $request->guest;
        $booking->tableType = $request->tableType;
        $booking->reservationDate = $request->reservationDate;
        $booking->reservationTime = $request->reservationTime;
        $booking->restaurantName = $request->restaurantName;
        $booking->reservationStatus = 'On Going';
        $booking->bookingCode = 'NER' . strtoupper(bin2hex(random_bytes(4))) . '-' . 'IN' . time();
        $booking->priceTotal = $request->priceTotal;
        $booking->restaurant_id = $request->restaurantId;

        // Cek apakah menuData dikirimkan
        if (!empty($request->menuData)) {
            // DECODE MENU DATA KRNA DRI DEPAN DIKIRIMNYA DATA ENCODE
            $decodedMenuData = html_entity_decode($request->menuData);
            $menuArray = json_decode($decodedMenuData, true);

            // CEK VALID ATAU GA JSON YG DIKIRIM DRI DEPAN
            if (json_last_error() === JSON_ERROR_NONE && is_array($menuArray)) {
                // KL VALID, MASUK KE SINI BUAT DI AMBIL VALUE ARRAY
                $menuStrings = [];
                foreach ($menuArray as $menu) {
                    $menuStrings[] = "{$menu['qty']}x {$menu['menuName']} - Rp " . number_format($menu['menuPrice'], 0, ',', '');
                    // HASILNYA
                    // [
                    //     "1x Spring Rolls - Rp 10,000",
                    //     "1x Garlic Bread - Rp 45,000"
                    // ]
                }
                // DISINI HASIL ARRAYNYA DI JADIIN 1 LINE STRING
                // "1x Spring Rolls - Rp 10,000, 1x Garlic Bread - Rp 45,000"
                $booking->menuData = implode(', ', $menuStrings);
            } else {
                $booking->menuData = null;
            }
        } else {
            //MASUK SINI KL CM BOOK MEJA
            $booking->menuData = null; //
        }

        $booking->save();

        // Data untuk email notifikasi
        $reservationData = [
            'id' => $booking->id,
            'tableType' => $booking->tableType,
            'bookingCode' => $booking->bookingCode,
            'reservationDate' => $booking->reservationDate,
            'reservationTime' => $booking->reservationTime,
            'guest' => $request->guest,
            'menuDetails' => $booking->menuData, // Bisa null jika tidak ada menu
            'username' => auth()->user()->username,
        ];

        // Kirim ke email (user) yang terdaftar pada apps
        if (auth()->check()) {
            Mail::to(auth()->user()->email)->send(new ReceiptMail($reservationData));
        } else {
            if ($request->isJson()) {
                return response()->json(['error' => 'Reservation Failed']);
            } else {
                return redirect("/dashboardCustomer")->with('error', 'Reservation Failed');
            }
        }

        // Return response sesuai dengan format request
        if ($request->isJson()) {
            return response()->json([
                'code' => $booking->bookingCode,
                'menuDetails' => $booking->menuData ?? 'No menu items were ordered.', // Nampilin Gada menu yang diorder kl menu datanya NULL
            ]);
        } else {
            return redirect("/dashboardCustomer")->with('success', 'Reservation Success! Booking Code: ' . $booking->bookingCode);
        }
    }

    public function detailOrder(Request $request)
    {
        $orderData = json_decode($request->input('orderData'), true);
        $orderDataJson = $request->input('orderData');
        $grandTotal = $request->grandTotal;
        $restaurantId = $request->restaurantId;
        $guestInfo = $request->guestInfo; // Guest info
        $areaInfo = $request->areaInfo;
        $reservationDate = $request->reservationDate;
        $reservationTime = $request->reservationTime;
        $restaurantName = $request->restaurantName; // Restaurant name
        $restaurantCity = $request->restaurantCity; // Restaurant city
        // $restaurants = Restaurant::find($request);
        // dd($grandTotal);
        return view('order.orderDetail', compact('orderData', 'orderDataJson', 'grandTotal', 'guestInfo', 'areaInfo', 'reservationDate', 'restaurantId', 'reservationTime', 'restaurantName', 'restaurantCity'));
    }

    public function history()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah user sudah login
        if (!$user) {
            return redirect('/login')->with('error', 'You need to login first.');
        }

        // Ambil semua riwayat booking berdasarkan user_id, termasuk relasi restaurant
        $reservations = Reservation::with('restaurant')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();


        // Tampilkan di view history
        return view('history.orderHistory', compact('reservations'));
    }

    public function cancelOrder($id)
    {
        $reservation = Reservation::findOrFail($id);
        if ($reservation->reservationStatus !== 'On Going') {
            return response()->json([
                'message' => 'Only ongoing reservations can be cancelled!'
            ], 400);
        }

        $reservation->reservationStatus = 'Cancelled';
        $reservation->save();

        return response()->json([
            'message' => 'Your reservation has been cancelled!',
            'new_status' => $reservation->reservationStatus
        ]);
    }

    public function finishOrder($id)
    {
        $reservation = Reservation::findOrFail($id);
        if ($reservation->reservationStatus !== 'Arrived') {
            return response()->json([
                'message' => 'Only ongoing reservations can be cancelled!'
            ], 400);
        }

        $reservation->reservationStatus = 'Finished';
        $reservation->save();

        return response()->json([
            'message' => 'Your reservation has been Finished!',
            'new_status' => $reservation->reservationStatus
        ]);
    }

    public function restaurantReservations()
    {
        // Ambil ID restoran dari user yang sedang login
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();

        // Ambil reservasi yang hanya dimiliki oleh restoran tersebut
        $reservations = Reservation::where('restaurant_id', $restaurant->id)->get();

        // Kirim data ke view
        return view('restaurant.order.index', compact('reservations'));
    }

    public function confirmArrival($id){

        $reservation = Reservation::findOrFail($id);

        if ($reservation->reservationStatus !== 'On Going') {
            return response()->json([
                'message' => 'Only ongoing reservations can be confirmed as arrived!'
            ], 400);
        }
        $reservation->reservationStatus = 'Arrived';
        $reservation->save();

        return response()->json([
            'message' => 'Guest has been marked as Arrived!',
            'new_status' => $reservation->reservationStatus
        ]);
    }

}
