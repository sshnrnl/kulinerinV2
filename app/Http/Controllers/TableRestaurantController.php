<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TableRestaurant;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;

class TableRestaurantController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        // $menu = MenuRestaurant::where('restaurant_id', $restaurant->id)->orderByRaw('created_at' || 'updated_at', 'desc')->get();
        $tableRestaurant = TableRestaurant::where('restaurant_id', $restaurant->id)->latest('updated_at')->latest('created_at')->get();


        return view('restaurant.table.index', compact('tableRestaurant'));
    }

    public function destroy($id)
    {
        $table = TableRestaurant::findOrFail($id);
        $table->delete();
        return redirect()->route('table.index');
    }
}
