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
            'locations.*.shelf_life' => 'required|integer',
        ]);

        foreach ($request->locations as $loc) {
            Location::create([
                'product_id' => $request->product_id,
                'aisle' => $loc['aisle'],
                'rack' => $loc['rack'],
                'basket' => $loc['basket'],
                'quantity' => $loc['quantity'],
                'shelf_life' => $loc['shelf_life'],
            ]);
        }

        return back()->with('success', 'Locations added successfully!');
    }
}