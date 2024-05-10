<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

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

    public function AddToCart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $products = Product::with('discounts')->find($id);
            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            // $cart->user_id = $user->id;
            $cart->user_id = auth()->user()->id;
            $cart->product_title = $products->product_name;

            // Counting Discount With The First Discount For That Product
            if ($products->discounts()->exists()) {
                $discount = $products->discounts()->first();
                $discountPercentage = $discount->percentage;
    
                if ($discountPercentage > 0) {
                    $cart->price = ($products->price * $discountPercentage) * $request->stock_quantity;
                } else {
                    $cart->price = $products->price * $request->stock_quantity;
                }
            } else {
                $cart->price = $products->price * $request->stock_quantity;
            }
    
            $cart->image = $products->image1_url;
            $cart->category_name = $products->productCategories->category_name;
            $cart->product_id = $products->id;
            $cart->quantity = $request->stock_quantity;
    
            $cart->save();
    
            return redirect()->back();

        } else {
            return redirect('login');
        }
    }

    public function removeCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->back();
    }

    public function cartOrder()
    {
        $total_price = 0;
        $user = Auth::user();
        $user_id = $user->id;

        // Fetch the current user's customer data
        $customer = $user->customer;

        // Fetch cart data for the current user
        $cartData = Cart::where('user_id', $user_id)->get();

        foreach ($cartData as $data) {
            $order = new Order;
            $order->customer_id = $customer->id;
            $order->order_date = now();

            // Calculate the total price by summing up the prices of all items in the cart
            $total_price = $total_price + $data->price;
            $order->total_amount = $total_price;
            $order->status = 'In Process';

            $order->save();

            $cartID = $data->id;
            $cart = Cart::find($cartID);
            $cart->delete();
        }

        return redirect()->back();
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
