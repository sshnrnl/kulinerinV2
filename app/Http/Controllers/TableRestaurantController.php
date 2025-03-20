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

    public function edit($id)
    {
        $table = TableRestaurant::findOrFail($id);
        // dd($table);
        return response()->json($table);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tableCapacity' => 'required|integer|min:1',
            'availableTables' => 'required|integer|min:0',
        ],[
            'tableCapacity.required' => 'Table Capacity is Missing',
            'availableTables.required' => 'Available Table is Missing',
        ]);

        $table = TableRestaurant::findOrFail($id);
        $table->update([
            'tableCapacity' => $request->tableCapacity,
            'availableTables' => $request->availableTables,
        ]);

        return response()->json(['message' => 'Table updated successfully']);
    }

    public function store(Request $request)
    {
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        $request->validate([
            'tableCapacity' => 'required|integer|min:1',
            'availableTables' => 'required|integer|min:0',
        ],[
            'tableCapacity.required' => 'Table Capacity is Missing',
            'availableTables.required' => 'Available Table is Missing',
        ]);

        $table = new TableRestaurant();
        $table->restaurant_id = $restaurant->id;
        $table->tableCapacity = $request->tableCapacity;
        $table->availableTables = $request->availableTables;
        $table->save();

        return response()->json([
            'message' => 'Table added successfully!',
            'table' => $table
        ], 201);

    }

    public function destroy($id)
    {
        $table = TableRestaurant::findOrFail($id);
        $table->delete();
        return redirect()->route('table.index');
    }
}
