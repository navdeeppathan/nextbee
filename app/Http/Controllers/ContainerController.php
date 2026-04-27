<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Container;
use App\Models\Product;
use App\Models\Cart;


class ContainerController extends Controller
{
    // ✅ FRONT PAGE (/main)
    public function index()
    {
        // $containers = Container::with('products')->get();
        $containers = Container::with('products')
            ->latest()   // newest first
            ->take(4)    // only 4
            ->get();

        $categories = \App\Models\Category::all();
        $products = Product::with('category')->get();
        $brands = Product::whereNotNull('brand')
            ->where('brand', '!=', '')
            ->distinct()
            ->pluck('brand');

        // ✅ TOTAL CONTAINERS
        // $totalContainers = $containers->count();
        $totalContainers = Container::count(); // full count

        // ✅ ESTIMATED VALUE
        $totalValue = 0;

        foreach ($containers as $container) {
            foreach ($container->products as $product) {
                $totalValue += $product->price * $product->moq;
            }
        }

        return view('Landing.main', compact(
            'containers',
            'categories',
            'products',
            'brands',
            'totalContainers',
            'totalValue'
        ));
    }

    // ✅ ADMIN FORM PAGE
    public function create()
    {
        $products = Product::all();

        return view('Inventory.container', compact('products'));
    }

    // ✅ SAVE DATA
    public function store(Request $request)
    {
        $request->validate([
            'container_no' => 'required',
            'eta_days' => 'required|integer'
        ]);

        $container = Container::create([
            'container_no' => $request->container_no,
            'eta_days' => $request->eta_days,
            'arrival_date' => $request->arrival_date,
        ]);

        // 🔥 product attach
        if ($request->product_ids) {
            $container->products()->attach($request->product_ids);
        }

        return redirect('/container/list')->with('success', 'Container Added Successfully');
    }
    public function list()
    {
        $containers = Container::with('products')->latest()->get();

        return view('Inventory.container_list', compact('containers'));
    }


    public function preorder(Request $request)
    {
        $container = Container::with('products')->find($request->container_id);

        foreach ($container->products as $product) {

            // 🔥 check if already in cart
            $existing = Cart::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->first();

            if ($existing) {
                $existing->quantity += $product->moq;
                $existing->save();
            } else {
                Cart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'quantity' => $product->moq
                ]);
            }
        }

        return response()->json([
            'success' => true
        ]);
    }
}