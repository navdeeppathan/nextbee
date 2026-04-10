<?php
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }
   public function search(Request $request)
{
    $query = $request->q;

    $products = Product::where('title', 'like', "%{$query}%")
        ->orWhere('sku_code', 'like', "%{$query}%")
        ->select('id', 'title', 'price', 'image', 'sku_code')
        // ->limit(10)
        ->get();

    return response()->json($products);
}

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'sku_code' => 'nullable|string',
            'price' => 'nullable|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'moq' => 'nullable|integer|min:0',
            'shelf_life' => 'nullable|integer|min:0',
            'aisle' => 'nullable|string|max:100',
            'rack' => 'nullable|string|max:50',
            'basket' => 'nullable|string|max:50',
            'quantity' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'product_type' => 'nullable|string',
            'brand' => 'nullable|string',

        ]);

        $data = $request->only([
            'title',
            'sku_code',
            'description',
            'price',
            'category_id',
            'moq',
            'shelf_life',
            'aisle',
            'rack',
            'basket',
            'quantity',
            'product_type',
            'brand',
        ]);

        // IMAGE UPLOAD
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $name);
            $data['image'] = 'uploads/' . $name;;
        }

        Product::create($data);

        return redirect()->back()->with('success', 'Inventory item added successfully');
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        
        $product = Product::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'sku_code' => 'nullable|string',
            'price' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'moq' => 'nullable|integer|min:0',
            'shelf_life' => 'nullable|integer|min:0',
            'aisle' => 'nullable|string|max:100',
            'rack' => 'nullable|string|max:50',
            'basket' => 'nullable|string|max:50',
            'quantity' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'product_type' => 'nullable|string',
            'brand' => 'nullable|string',
        ]);

        $data = $request->only([
            'title',
            'sku_code',
            'description',
            'price',
            'category_id',
            'moq',
            'shelf_life',
            'aisle',
            'rack',
            'basket',
            'quantity',
            'product_type',
            'brand',
        ]);

        // IMAGE UPDATE
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $name);
            $data['image'] = 'uploads/' . $name;
        }

        $product->update($data);

        return redirect()->back()->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        return back();
    }

    
}