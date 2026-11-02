<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // READ: all reviews (admin moderation list)
    public function index()
    {
        $reviews = Review::with(['user', 'experience'])->latest()->get();
        return view('reviews.index', compact('reviews'));
    }

    public function create(Experience $experience)
    {
        return view('reviews.create', compact('experience'));
    }

    public function store(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'rating'  => 'required|integer|between:1,5',
            'comment' => 'required|min:5',
        ]);

        Review::create([
            'user_id'       => Auth::id(),
            'experience_id' => $experience->id,
            'rating'        => $data['rating'],
            'comment'       => $data['comment'],
        ]);

        return redirect()->route('experiences.show', $experience)->with('success', 'Thanks for your review!');
    }

    public function edit(Review $review)
    {
        $this->checkOwner($review);
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $this->checkOwner($review);

        $data = $request->validate([
            'rating'  => 'required|integer|between:1,5',
            'comment' => 'required|min:5',
        ]);

        $review->update($data);
        return redirect()->route('experiences.show', $review->experience_id)->with('success', 'Review updated!');
    }

    public function destroy(Review $review)
    {
        $this->checkOwner($review);
        $experienceId = $review->experience_id;
        $review->delete();
        return redirect()->route('experiences.show', $experienceId)->with('success', 'Review deleted.');
    }

    private function checkOwner(Review $review)
    {
        if (!Auth::user()->isAdmin() && $review->user_id !== Auth::id()) {
            abort(403, 'This is not your review.');
        }
    }
}
