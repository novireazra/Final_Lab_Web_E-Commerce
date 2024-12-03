<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorits = Favorit::with(['user', 'menu'])->latest()->get();
        return view('favorits.index', compact('favorits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $menus = Menu::all();
        return view('favorits.create', compact('users', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_menu' => 'required|exists:menus,id',
        ]);

        Favorit::create($request->all());

        return redirect()->route('favorits.index')->with('success', 'Favorit added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $favorit = Favorit::findOrFail($id);
        $users = User::all();
        $menus = Menu::all();
        return view('favorits.edit', compact('favorit', 'users', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_menu' => 'required|exists:menus,id',
        ]);

        $favorit = Favorit::findOrFail($id);
        $favorit->update($request->all());

        return redirect()->route('favorits.index')->with('success', 'Favorit updated successfully.');
    }

    /**
     * Add a menu to favorites.
     */
    public function add(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
        ]);

        Favorit::create([
            'id_user' => Auth::id(),
            'id_menu' => $request->menu_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Menu added to favorites']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $favorit = Favorit::findOrFail($id);
        $favorit->delete();

        return redirect()->route('favorits.index')->with('success', 'Favorit deleted successfully.');
    }
}