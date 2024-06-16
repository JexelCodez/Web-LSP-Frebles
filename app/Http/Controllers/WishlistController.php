<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showWish()
    {
        $user = Auth::user();
        $userId = $user->id;

        $wishlists = DB::table('vwwishlists')->where('user_id', '=', $userId)->get();

        return view('mywishlist', [
            'wishlists' => $wishlists,
        ]);
    }
    
    public function deleteWish($id)
    {
        Wishlist::find($id)->delete();
        $user = Auth::user();
        $userId = $user->id;
        $wishlists = DB::table('vwwishlists')->where('customer_id', '=', $userId)->get();
        return view ('mywishlist', [
            'wishlists' => $wishlists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $customer = User::find($user_id)->customer()->first();

        // If customer one of the customer data is null, redirect to a specific route
        if ($customer === null || $customer->name === null) {
            return redirect()->route('customers.create');
        }

        $customers = Customer::all();
        $products = Product::all();

        return view('admin.wishlists.create', [
            'customers' => $customers,
            'products' => $products
        ]);
    }

    /**
     * 
     */

    public function add(Request $request)
    {
        // Get the authenticated user's ID
        $user_id = auth()->user()->id;

        // Find the customer associated with the user
        $customer = User::find($user_id)->customer()->first();

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found.');
        }

        // Validate request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Check if the product is already in the wishlist
        $existingWishlist = Wishlist::where('customer_id', $customer->id)
                                    ->where('product_id', $request->product_id)
                                    ->first();

        if ($existingWishlist) {
            return redirect()->back()->with('info', 'Product is already in your wishlist.');
        }

        // Create new wishlist entry
        $wishlist = new Wishlist();
        $wishlist->customer_id = $customer->id;
        $wishlist->product_id = $request->product_id;
        $wishlist->save();

        // Retrieve the product for message
        $product = Product::find($request->product_id);

        // Assuming you want to return these variables to the view
        $cartItemCount = ''; // Placeholder, update as needed
        $products = Product::with('discounts')->paginate(10);

        return view('landingpage-items.shop', [
            'status' => 'save',
            'message' => 'Kamu telah wish produk "' . $product->product_name . '" silahkan cek wishlist Anda!',
            'cartItemCount' => $cartItemCount,
            'products' => $products,
            'customer' => $customer
        ]);
    }

    /**
     * 
     */
    public function store(Request $request)
    {
       //
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
