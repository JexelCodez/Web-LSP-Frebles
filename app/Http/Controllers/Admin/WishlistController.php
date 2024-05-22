<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();

        return view('admin.wishlists.create', [
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
        // return redirect()->route('landingpage-items.shop')->with('success', 'Wish created successfully!');

        // Variables to make the return work
        $cartItemCount = '';
        $productId = Product::find($request->product_id);
        $products = Product::with('discounts')->paginate(10);

        return view ('landingpage-items.shop', [
            'status' => 'save',
            'message' => 'You have wished for "' . $productId->product_name . '" Thank you for reminding us! We will restock shortly!',
            'cartItemCount' => $cartItemCount,
            'products' => $products
        ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
