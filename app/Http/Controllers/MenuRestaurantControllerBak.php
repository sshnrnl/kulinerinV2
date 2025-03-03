<?php

namespace App\Http\Controllers;

use App\Models\MenuRestaurant;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MenuRestaurantController extends Controller
{
    public function indexMenu(Request $request, $id)
    {
        $menuItems = MenuRestaurant::where('restaurant_id', $id)
        ->orderBy('category')
        ->get()
        ->groupBy('category');
        $restaurants = Restaurant::find($id);
        $guestInfo = $request->guestInfo;
        $areaInfo = $request->areaInfo;
        $reservationDate = $request->reservationDate;
        $reservationTime = $request->reservationTime;
        $restaurantName = $request->restaurantName;
        $restaurantCity = $request->restaurantCity;
        return view('menu.index', compact('menuItems','restaurants', 'guestInfo', 'areaInfo', 'reservationDate', 'reservationTime', 'restaurantName', 'restaurantCity'));
    }

    // public function index(){
    //     $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
    //     $menu = MenuRestaurant::where('restaurant_id', $restaurant->id)->get();

    //     return view('restaurant.menu.index', compact('menu'));
    // }

    // public function edit($id){
    //     $menu = MenuRestaurant::findOrFail($id);

    //     return view('restaurant.menu.updateMenu', compact('menu'));
    // }
    public function update(Request $request, string $id)
    {
        // Validate the request data
        // $request->validate([
        //     'menuName' => 'required|string|max:255',
        //     'category' => 'required|string|max:255',
        //     'menuPrice' => 'required|numeric',
        //     'menuImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'isAVailable' => 'required|in:YES,NO',
        //     'description' => 'nullable|string',
        // ]);

        // // Find the menu item
        // $menu = MenuRestaurant::findOrFail($id);
        // $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        // // Update menu item with validated data
        // $menu->restaurant_id = $restaurant->id;
        // $menu->menuName = $request->menuName;
        // // $menu->menuImage = $request->menuImage;
        // $menu->category = $request->category;
        // $menu->menuPrice = str_replace(',', '', $request->menuPrice);
        // $menu->isAVailable = $request->isAVailable;
        // $menu->description = $request->description;
        // if ($request->hasFile('menuImage')) {
        //     if ($menu->menuImage) {
        //         Storage::disk('public')->delete($menu->menuImage);
        //     }
        //     $imagePath = $request->file('menuImage')->store('post-menuImage', 'public');
        //     $menu->menuImage = $imagePath;
        // }
        // $menu->save();

        // // Redirect to the menu index with success message
        // return redirect()->route('menu.index')->with('success', 'Menu updated successfully');
    }

    public function destroy($id)
    {
        $menu = MenuRestaurant::findOrFail($id);
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu deleted successfully');
    }


}
