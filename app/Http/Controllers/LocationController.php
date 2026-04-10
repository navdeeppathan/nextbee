<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    // Store multiple locations
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'locations' => 'required|array',
            'locations.*.aisle' => 'required',
            'locations.*.rack' => 'required|integer',
            'locations.*.basket' => 'required|integer',
            'locations.*.quantity' => 'required|integer',
            'locations.*.expiry_date' => 'nullable|date',
        ]);

        foreach ($request->locations as $loc) {
            Location::create([
                'product_id' => $request->product_id,
                'aisle' => $loc['aisle'],
                'rack' => $loc['rack'],
                'basket' => $loc['basket'],
                'quantity' => $loc['quantity'],
                'expiry_date' => $loc['expiry_date'],
            ]);
        }

        return back()->with('success', 'Locations added successfully!');
    }
}