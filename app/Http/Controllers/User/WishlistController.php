<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlists = DB::table('vwwishlists')->get();
        return view('user.wishlists.index', [
            'wishlists' => $wishlists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();

        return view('user.wishlists.create', [
            'customers' => $customers,
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['customer_id', 'product_id']);

        // Create a new wishlist record
        Wishlist::create($data);

        // Retrieve updated wishlists with eager loaded relations
        // $wishlists = Wishlists::with('customers', 'products')->get();
        return redirect()->route('user.wishlists.index')->with('success', 'Wish created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $wishlists = Wishlist::findOrFail($id);
        $customers = Customer::all();
        $products = Product::all();

        return view('user.wishlists.edit', [
            'wishlists' => $wishlists,
            'customers' => $customers,
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlist = Wishlist::findOrFail($id);
        $wishlist->customer_id = $request->input('customer_id');
        $wishlist->product_id = $request->input('product_id');
        $wishlist->save();

        return redirect()->route('user.wishlists.index', [
            'success' => 'update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the wishlist by ID and delete it
        Wishlist::findOrFail($id)->delete();
        return redirect()->route('user.wishlists.index');
    }
}
