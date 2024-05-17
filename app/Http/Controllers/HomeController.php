<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DiscountCategories;
use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function showAdminDashboard()
    {
        return view ('admin.home');
    }

    public function showUserDashboard()
    {
        return view ('user.home');
    }

    public function showShop()
    {

        // Logic Cart Numbering
        if (Auth::check()) {
            $user = Auth::user();
            $cartItemCount = Cart::where('user_id', $user->id)->count();
        } else {
            $cartItemCount = 0; // If user is not logged in, cart item count is 0
        }

        // Fetching all products with their related categories
        $productCategories = ProductCategories::all();
        $discountCategories = DiscountCategories::all();

        // Fetching all products with their related categories and the first discount
        // $products = Product::with('discounts')->get();
        $products = Product::with('discounts')->paginate(16);

        return view('landingpage-items.shop', [
            'products' => $products,
            'productCategories' => $productCategories,
            'discountCategories' => $discountCategories,
            'cartItemCount' => $cartItemCount
        ]);
    }

    public function showProductDetails($id)
    {

        if (Auth::check()) {
            $user = Auth::user();
            $cartItemCount = Cart::where('user_id', $user->id)->count();
        } else {
            $cartItemCount = 0; // If user is not logged in, cart item count is 0
        }

        // Fetch a single product by its ID and eager load the discounts relationship
        $product = Product::with('discounts')->find($id);

        return view ('landingpage-items.product-details', [
            'product' => $product,
            'cartItemCount' => $cartItemCount
        ]);
    }

    public function showContact()
    {
        return view ('landingpage-items.contact');
    }

}
