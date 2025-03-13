<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\PointLoyalty;
use App\Models\Redemption;
use App\Models\Reward;
use App\Models\User;

class RewardController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        $category = $request->query('category', 'all');

        $userPoints = PointLoyalty::where('user_id', Auth::user()->id)->first();

        $categories = Reward::where('is_active', true)
            ->where('stock', '>', 0)
            ->pluck('category')
            ->unique()
            ->toArray();

        // Tambahkan opsi "All" ke dalam daftar kategori
        array_unshift($categories, 'all');

        $rewards = Reward::query()
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->when($category !== 'all', function ($query) use ($category) {
                return $query->where('category', $category);
            })
            ->get();

        $user = User::where('id', Auth::id())->first();

        // Cek apakah user sudah login
        if (!$user) {
            return redirect('/login')->with('error', 'You need to login first.');
        }

        // Ambil semua riwayat Redeem berdasarkan user_id, termasuk relasi reward
        $redeems = Redemption::with('reward')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reward.index', compact('category', 'categories', 'rewards', 'userPoints', 'redeems'));
    }


}
