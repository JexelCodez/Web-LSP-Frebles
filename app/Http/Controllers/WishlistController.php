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
            'wishlists' => $wishlists
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['customer_id', 'product_id']);

        // Create a new wishlist record
        Wishlist::create($data);

        // Variables to make the return work
        // $cartItemCount = 0;
        $cartItemCount = '';
        $productId = Product::find($request->product_id);
        $products = Product::with('discounts')->paginate(10);

        return view ('landingpage-items.shop', [
            'status' => 'save',
            'message' => 'You have wished for "' . $productId->product_name . '" check your wishlist!',
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
