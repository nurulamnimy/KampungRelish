<?php

namespace App\Http\Controllers;

use App\Models\VendorProfile;
use Illuminate\Http\Request;

class VendorProfileController extends Controller
{
    // READ + SEARCH
    public function index(Request $request)
    {
        $query = VendorProfile::withCount('experiences');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('location', 'like', '%' . $request->q . '%');
        }

        $vendors = $query->orderBy('id')->get();
        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|max:150',
            'phone'       => 'required|digits_between:9,11',
            'location'    => 'required|max:150',
            'description' => 'nullable',
            'status'      => 'required|in:active,inactive',
        ]);

        VendorProfile::create($data);
        return redirect()->route('vendors.index')->with('success', 'Vendor added!');
    }

    public function edit(VendorProfile $vendor)
    {
        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, VendorProfile $vendor)
    {
        $data = $request->validate([
            'name'        => 'required|max:150',
            'phone'       => 'required|digits_between:9,11',
            'location'    => 'required|max:150',
            'description' => 'nullable',
            'status'      => 'required|in:active,inactive',
        ]);

        $vendor->update($data);
        return redirect()->route('vendors.index')->with('success', 'Vendor updated!');
    }

    // DELETE - inactive only and no listings left
    public function destroy(VendorProfile $vendor)
    {
        if ($vendor->status !== 'inactive') {
            return back()->with('error', 'Only inactive vendors can be deleted.');
        }
        if ($vendor->experiences()->count() > 0) {
            return back()->with('error', 'This vendor still has food experiences. Delete them first.');
        }

        $vendor->delete();
        return redirect()->route('vendors.index')->with('success', 'Vendor deleted!');
    }
}
