<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            // For admin, fetch all menus
            $menus = Menu::with('restaurant')->latest()->get();
        } else {
            // For sellers, fetch only their own menus
            $menus = Menu::whereHas('restaurant', function($query) {
                $query->where('id_seller', Auth::id());
            })->with('restaurant')->latest()->get();
        }

        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurants = Restaurant::where('id_seller', Auth::id())->get();
        return view('menus.create', compact('restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_restaurant' => 'required|exists:restaurants,id',
            'nama_menu' => 'required|string|max:255',
            'deskripsi_menu' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Unavailable',
            'kategori' => 'required|string|max:255',
            'stock' => 'required|integer|min:0', // Validasi kolom stock
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menu_images', 'public');
        }

        Menu::create($data);

        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = Menu::whereHas('restaurant', function($query) {
            $query->where('id_seller', Auth::id());
        })->findOrFail($id);

        $restaurants = Restaurant::where('id_seller', Auth::id())->get();

        return view('menus.edit', compact('menu', 'restaurants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::whereHas('restaurant', function($query) {
            $query->where('id_seller', Auth::id());
        })->findOrFail($id);

        $request->validate([
            'id_restaurant' => 'required|exists:restaurants,id',
            'nama_menu' => 'required|string|max:255',
            'deskripsi_menu' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Unavailable',
            'kategori' => 'required|string|max:255',
            'stock' => 'required|integer|min:0', // Validasi kolom stock
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menu_images', 'public');
        }

        $menu->update($data);

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::whereHas('restaurant', function($query) {
            $query->where('id_seller', Auth::id());
        })->findOrFail($id);

        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}
