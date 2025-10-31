<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $store = auth()->user()->store;
        if (!$store) {
            return redirect()->route('seller.stores.create')
            ->with('error', 'You need to create a store first.');
        }

        $query = $store->products();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->with('category')->get();

        // Unique categories (safe even if duplicates exist)
        $categories = Category::orderBy('name')
            ->get()
            ->unique('name')
            ->sortBy('name');

        return view('seller.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->distinct()->get();
        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


         $store = auth()->user()->store;

     if (!$store) {
        return redirect()->route('seller.stores.create')
            ->with('error', 'You need to create a store first.');
    }

        $data = $request->all();
        $data['store_id'] = $store->id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('seller.products.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        if ($product->store_id !== auth()->user()->store->id) {
            abort(403);
        }
        $categories = Category::select('id', 'name')->distinct()->get();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($product->store_id !== auth()->user()->store->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('seller.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->store_id !== auth()->user()->store->id) {
            abort(403);
        }
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('seller.products.index')->with('success', 'Product deleted successfully!');
    }
}