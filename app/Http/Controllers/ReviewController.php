<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Review;
use Exception;

class ReviewController extends Controller
{
    /**
     * Store a new review for a medicine
     */
    public function store(Request $request, $medicine_id)
    {
        $request->validate([
            'reviewer_name' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        try {
            $medicine = Medicine::findOrFail($medicine_id);

            $medicine->reviews()->create([
                'reviewer_name' => $request->reviewer_name,
                'content' => $request->content,
                'rating' => $request->rating,
            ]);

            return back()->with('success', 'Review added successfully!');
        } catch (Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Optionally: Delete a review
     */
    public function destroy(Review $review)
    {
        try {
            $review->delete();
            return back()->with('success', 'Review deleted.');
        } catch (Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
