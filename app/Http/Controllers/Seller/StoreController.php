<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the seller's store (only one store allowed).
     */
    public function index()
    {
        $store = Auth::user()->store; // One-to-one relationship
        return view('seller.stores.index', compact('store'));
    }

    /**
     * Show the form for creating a new store.
     */
    public function create()
    {
        // Prevent creating multiple stores
        if (Auth::user()->store) {
            return redirect()->route('seller.stores.index')
                             ->with('error', 'You already have a store. Edit it instead.');
        }

        return view('seller.stores.create');
    }

    /**
     * Store a newly created store in database.
     */
    public function store(Request $request)
    {
        // Prevent creating multiple stores
        if (Auth::user()->store) {
            return redirect()->route('seller.stores.index')
                             ->with('error', 'You can only have one store.');
        }

        $request->validate([
            'name'        => 'required|string|max:255|unique:stores,name',
            'description' => 'nullable|string|max:1000',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('stores/logos', 'public');
        }

        // Create store with seller_id
        Auth::user()->store()->create($data);

        return redirect()->route('seller.stores.index')
                         ->with('success', 'Store created successfully!');
    }

    /**
     * Display the specified store.
     */
    public function show($id)
    {
        $store = Store::findOrFail($id);

        if ($store->seller_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('seller.stores.show', compact('store'));
    }

    /**
     * Show the form for editing the store.
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);

        if ($store->seller_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('seller.stores.edit', compact('store'));
    }

    /**
     * Update the specified store in database.
     */
    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        if ($store->seller_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'name'        => 'required|string|max:255|unique:stores,name,' . $id,
            'description' => 'nullable|string|max:1000',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        // Handle logo update
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($store->logo) {
                \Storage::disk('public')->delete($store->logo);
            }
            $data['logo'] = $request->file('logo')->store('stores/logos', 'public');
        }

        $store->update($data);

        return redirect()->route('seller.stores.index')
                         ->with('success', 'Store updated successfully!');
    }

    /**
     * Remove the specified store from database.
     */
    public function destroy($id)
    {
        $store = Store::findOrFail($id);

        if ($store->seller_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        // Delete logo from storage
        if ($store->logo) {
            \Storage::disk('public')->delete($store->logo);
        }

        $store->delete();

        return redirect()->route('seller.stores.index')
                         ->with('success', 'Store deleted successfully!');
    }
}