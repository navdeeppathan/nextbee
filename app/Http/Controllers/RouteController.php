<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\RouteItem;
use App\Models\RouteMetric;
use App\Models\Stop;
use App\Models\User;

class RouteController extends Controller
{
    // ✅ LIST PAGE
    public function index()
    {
        $routes = Route::with(['driver', 'stops', 'items', 'metrics'])->get();
        $activeDrivers = User::where('role', 'driver')->where('status', 'active')->count();
        $totalStops = Stop::count();
        $completedRoutes = Route::where('status', 'completed')->count();
        $inPrgoressRoutes = Route::where('status', 'in_progress')->count();
        $pendingRoutes = Route::where('status', 'pending')->count();


        return view('Inventory.deliveries', compact('routes', 'activeDrivers', 'totalStops', 'completedRoutes', 'inPrgoressRoutes', 'pendingRoutes'));
    }

    // ✅ STORE ROUTE
    public function store(Request $request)
    {
        $route = Route::create([
            'route_code' => $request->route_code,
            'route_name' => $request->route_code, // fallback
            'area' => $request->area,
            'driver_id' => $request->driver_id,
            'van_number' => $request->van_number,
            'status' => $request->status ?? 'pending',

            // ✅ defaults (VERY IMPORTANT)
            'total_stops' => 0,
            'completed_stops' => 0,
            'start_time' => null,
            'end_time' => null,
        ]);

        // ITEMS
        RouteItem::create([
            'route_id' => $route->route_id,
            'total_items' => 0,
            'loaded_items' => 0,
            'delivered_items' => 0,
            'returns' => 0
        ]);

        // METRICS
        RouteMetric::create([
            'route_id' => $route->route_id,
            'estimated_duration' => 0,
            'actual_duration' => 0,
            'efficiency' => 0,
            'completion_time' => null
        ]);

        return back()->with('success', 'Route Created');
    }

    // ✅ SHOW (FOR MODAL AJAX)
    public function show($id)
    {
        $route = Route::with(['driver', 'stops', 'items', 'metrics'])->findOrFail($id);

        return response()->json($route);
    }

    // ✅ UPDATE
    public function update(Request $request, $id)
    {
        $route = Route::findOrFail($id);
        $route->update($request->all());

        return back()->with('success', 'Route Updated');
    }

    // ✅ DELETE
    public function destroy($id)
    {
        Route::findOrFail($id)->delete();
        return back()->with('success', 'Route Deleted');
    }
}