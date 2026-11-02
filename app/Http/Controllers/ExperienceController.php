<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\VendorProfile;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public $categories = ['Street Food', 'Restaurant', 'Food Tour', 'Cooking Class', 'Night Market'];

    // READ + SEARCH + FILTER + SORT (uses URL parameters ?q=&category=&sort=)
    public function index(Request $request)
    {
        $query = Experience::with('vendor')->withAvg('reviews', 'rating');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%$q%")->orWhere('location', 'like', "%$q%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // normal users only see active listings
        if (!auth()->user()->isAdmin()) {
            $query->where('status', 'active');
        }

        switch ($request->sort) {
            case 'price_asc':  $query->orderBy('price', 'asc'); break;
            case 'price_desc': $query->orderBy('price', 'desc'); break;
            case 'name':       $query->orderBy('name', 'asc'); break;
            default:           $query->orderBy('id', 'asc');
        }

        $experiences = $query->get();
        $categories = $this->categories;

        return view('experiences.index', compact('experiences', 'categories'));
    }

    public function show(Experience $experience)
    {
        $experience->load(['vendor', 'reviews.user']);
        return view('experiences.show', compact('experience'));
    }

    // CREATE (admin)
    public function create()
    {
        $vendors = VendorProfile::where('status', 'active')->get();
        $categories = $this->categories;
        return view('experiences.create', compact('vendors', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vendor_profile_id' => 'required|exists:vendor_profiles,id',
            'name'              => 'required|max:150',
            'location'          => 'required|max:150',
            'category'          => 'required|in:' . implode(',', $this->categories),
            'description'       => 'required',
            'menu'              => 'nullable|max:255',
            'price'             => 'required|numeric|min:0',
            'status'            => 'required|in:active,inactive',
        ]);

        Experience::create($data);
        return redirect()->route('experiences.index')->with('success', 'Food experience added!');
    }

    // UPDATE (admin)
    public function edit(Experience $experience)
    {
        $vendors = VendorProfile::all();
        $categories = $this->categories;
        return view('experiences.edit', compact('experience', 'vendors', 'categories'));
    }

    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'vendor_profile_id' => 'required|exists:vendor_profiles,id',
            'name'              => 'required|max:150',
            'location'          => 'required|max:150',
            'category'          => 'required|in:' . implode(',', $this->categories),
            'description'       => 'required',
            'menu'              => 'nullable|max:255',
            'price'             => 'required|numeric|min:0',
            'status'            => 'required|in:active,inactive',
        ]);

        $experience->update($data);
        return redirect()->route('experiences.index')->with('success', 'Food experience updated!');
    }

    // DELETE (admin) - only inactive listings can be deleted
    public function destroy(Experience $experience)
    {
        if ($experience->status !== 'inactive') {
            return back()->with('error', 'Only inactive experiences can be deleted. Set the status to inactive first.');
        }

        $experience->delete();
        return redirect()->route('experiences.index')->with('success', 'Food experience deleted!');
    }
}
