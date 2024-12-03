<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with(['buyer', 'restaurant'])->latest()->get();
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buyers = User::all();
        $restaurants = Restaurant::all();
        return view('reviews.create', compact('buyers', 'restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_buyer' => 'required|exists:users,id',
            'id_restaurant' => 'required|exists:restaurants,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
            'tanggal_review' => 'nullable|date',
        ]);

        Review::create($request->all());

        return redirect()->route('reviews.index')->with('success', 'Review added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $buyers = User::all();
        $restaurants = Restaurant::all();
        return view('reviews.edit', compact('review', 'buyers', 'restaurants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_buyer' => 'required|exists:users,id',
            'id_restaurant' => 'required|exists:restaurants,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
            'tanggal_review' => 'nullable|date',
        ]);

        $review = Review::findOrFail($id);
        $review->update($request->all());

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}
