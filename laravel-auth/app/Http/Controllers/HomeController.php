<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            switch ($role) {
                case 'admin':
                    // Fetch counts
                    $userCount = User::count();
                    $buyerCount = User::where('role', 'buyer')->count();
                    $sellerCount = User::where('role', 'seller')->count();

                    $restaurantCount = Restaurant::count();
                    $openRestaurantCount = Restaurant::where('status_buka', 'Open')->count();
                    $closedRestaurantCount = Restaurant::where('status_buka', 'Close')->count();

                    $menuCount = Menu::count();
                    $availableMenuCount = Menu::where('status', 'Available')->count();
                    $unavailableMenuCount = Menu::where('status', 'Unavailable')->count();

                    // Fetch latest items
                    $latestUsers = User::latest()->take(5)->get();
                    $latestRestaurants = Restaurant::latest()->take(5)->get();
                    $latestMenus = Menu::latest()->take(5)->get();

                    return view('dashboard.admin.home', compact(
                        'userCount', 'buyerCount', 'sellerCount',
                        'restaurantCount', 'openRestaurantCount', 'closedRestaurantCount',
                        'menuCount', 'availableMenuCount', 'unavailableMenuCount',
                        'latestUsers', 'latestRestaurants', 'latestMenus'
                    ));
                case 'seller':
                    // Logika untuk seller
                    return view('dashboard.seller.home');
                default:
                    // Logika untuk buyer
                    $restaurants = Restaurant::with(['menus' => function ($query) {
                        $query->where('status', 'Available');
                    }])->get();

                    return view('dashboard.buyer.home', compact('restaurants'));
            }
        } else {
            // Logika untuk pengguna yang tidak terautentikasi
            $menus = Menu::latest()->take(6)->get(); // Ambil 6 menu terbaru
            return view('welcome', compact('menus'));
        }
    }
}