<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class RestaurantController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $restaurants = Restaurant::latest()->get();
                return view('restaurants.index', compact('restaurants'));
            }
        }
        return redirect()->route('login')->with('error', 'Please log in.');
    }

    public function create()
    {
        // Check if the logged-in user already has a restaurant
        $user = Auth::user();
        $restaurant = Restaurant::where('id_seller', $user->id)->exists();

        // If the user already has a restaurant, redirect to menu management page
        if ($restaurant) {
            return redirect()->route('menus.index')
                ->with('error', 'You already have a restaurant. You can only manage its menus.');
        }

        // If the user does not have a restaurant, allow them to create a new one
        return view('restaurants.create');
    }

    public function store(Request $request)
    {
        // Prevent the user from creating more than one restaurant
        // Corrected condition
        if (Restaurant::where('id_seller', Auth::id())->exists()) {
            return redirect()->route('menus.index')
                ->with('error', 'You can only create one restaurant.');
        }

        $request->validate([
            'nama_restaurant' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'status_buka' => 'required|in:Open,Close',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $this->handleImageUpload($request);

        try {
            Restaurant::create([
                'id_seller' => Auth::id(),
                'nama_restaurant' => $request->nama_restaurant,
                'deskripsi' => $request->deskripsi,
                'alamat' => $request->alamat,
                'status_buka' => $request->status_buka,
                'image' => $imagePath,
            ]);

            return redirect()->route('menus.create')->with('success', 'Restaurant created successfully. Please add menus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create restaurant: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $this->authorizeRestaurantAccess($restaurant);

        return view('restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $this->authorizeRestaurantAccess($restaurant);

        $request->validate([
            'nama_restaurant' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'status_buka' => 'required|in:Open,Close',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $restaurant->update([
                'nama_restaurant' => $request->nama_restaurant,
                'deskripsi' => $request->deskripsi,
                'alamat' => $request->alamat,
                'status_buka' => $request->status_buka,
                'image' => $this->handleImageUpload($request, $restaurant->image),
            ]);

            return redirect()->route('restaurants.index')->with('success', 'Restaurant updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update restaurant: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $this->authorizeRestaurantAccess($restaurant);

        try {
            if ($restaurant->image) {
                Storage::disk('public')->delete($restaurant->image);
            }
            $restaurant->delete();
            return redirect()->route('restaurants.index')->with('success', 'Restaurant deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('restaurants.index')->with('error', 'Failed to delete restaurant: ' . $e->getMessage());
        }
    }

    private function handleImageUpload(Request $request, $existingImage = null)
    {
        if ($request->hasFile('image')) {
            if ($existingImage) {
                Storage::disk('public')->delete($existingImage);
            }
            return $request->file('image')->store('restaurant_images', 'public');
        }
        return $existingImage;
    }

    private function authorizeRestaurantAccess(Restaurant $restaurant)
    {
        if ($restaurant->id_seller !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }
    }
}
