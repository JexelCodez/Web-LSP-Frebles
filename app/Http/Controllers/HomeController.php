<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DiscountCategories;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\User;
use Illuminate\Http\Request;
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
        $products = Product::with('discounts')->get();

        return view('landingpage-items.shop', [
            'products' => $products,
            'productCategories' => $productCategories,
            'discountCategories' => $discountCategories,
            'cartItemCount' => $cartItemCount
        ]);
    }

    public function showCart()
    {
        $total_price = 0;
        $user_id = auth()->user()->id;
        $carts = Cart::where('user_id', $user_id)->get();
        // $customers = Customer::where('user_id', $user_id)->get();
        $customers = User::find($user_id)->customer()->first(); // Using ->first() to get a single customer
        // $customers = User::find($user_id)->customer;

         // If customer one of the customer data is null, redirect to a specific route
        if ($customers === null || $customers->name === null) {
            return redirect()->route('user.customers.create');
        }

        if ($customers === null || $customers->email === null) {
            return redirect()->route('user.customers.create');
        }

        if ($customers === null || $customers->password === null) {
            return redirect()->route('user.customers.create');
        }

        if ($customers === null || $customers->phone === null) {
            return redirect()->route('user.customers.create');
        }

        if ($customers === null || $customers->address1 === null) {
            return redirect()->route('user.customers.create');
        }

        // To sum all price in the carts
        foreach ($carts as $cart) {
            $total_price = $total_price + $cart->price;
        }

        return view ('landingpage-items.cart', [
            'carts' => $carts,
            'customers' => $customers,
            'total_price' => $total_price
        ]);
    }

    public function showPaymentForm()
    {
        return view ('landingpage-items.payment-form');
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

    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->back();
    }

}
