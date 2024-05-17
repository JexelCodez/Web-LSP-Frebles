<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            return redirect()->route('customers.create');
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
                    $cart->price = (($products->price - ($products->price * $discountPercentage))) * $request->stock_quantity;
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

    // public function cartOrder()
    // {
    //     $user = Auth::user();
    //     $user_id = $user->id;

    //     // Fetch the current user's customer data
    //     $customer = $user->customer;

    //     // Fetch cart data for the current user
    //     $cartData = Cart::where('user_id', $user_id)->get();

    //     if ($cartData->isEmpty()) {
    //         return redirect()->back()->withErrors(['cart' => 'Your cart is empty.']);
    //     }

    //     DB::transaction(function () use ($cartData, $customer) {
    //         $total_price = 0;

    //         // Create the order with initial total_amount as zero
    //         $order = new Order;
    //         $order->customer_id = $customer->id;
    //         $order->order_date = now();
    //         $order->total_amount = 0; // Initial total amount
    //         $order->status = 'In Process';
    //         $order->save();

    //         // Process each cart item
    //         foreach ($cartData as $data) {
    //             $product = Product::find($data->product_id);

    //             // Check if the product has sufficient stock
    //             if ($product->stock_quantity < $data->quantity) {
    //                 throw new \Exception('Insufficient stock for product ID: ' . $data->product_id);
    //             }

    //             // Calculate the total price
    //             $total_price += $data->price * $data->quantity;

    //             // Create the order detail
    //             $orderDetail = new OrderDetails();
    //             $orderDetail->order_id = $order->id;
    //             $orderDetail->product_id = $data->product_id;
    //             $orderDetail->quantity = $data->quantity;
    //             $orderDetail->subtotal = $data->price * $data->quantity;
    //             $orderDetail->save();

    //             // Reduce the stock quantity of the product
    //             $product->stock_quantity -= $data->quantity;
    //             $product->save();

    //             // Remove the cart item
    //             $data->delete();
    //         }

    //         // Update the total amount of the order
    //         $order->total_amount = $total_price;
    //         $order->save();

    //         // Assign the order ID to the variable
    //         $orderId = $order->id;
    //     });

    //     return redirect()->route('landingpage-items.payment-form', ['orderId' => $orderId])->with('success', 'Order has been placed successfully!');
    // }

    public function cartOrder()
    {
        $user = Auth::user();
        $user_id = $user->id;

        // Fetch the current user's customer data
        $customer = $user->customer;

        // Fetch cart data for the current user
        $cartData = Cart::where('user_id', $user_id)->get();

        if ($cartData->isEmpty()) {
            return redirect()->back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        $orderId = null; // Initialize order ID variable

        DB::transaction(function () use ($cartData, $customer, &$orderId) {
            $total_price = 0;

            // Create the order with initial total_amount as zero
            $order = new Order;
            $order->customer_id = $customer->id;
            $order->order_date = now();
            $order->total_amount = 0; // Initial total amount
            $order->status = 'In Process';
            $order->save();

            // Process each cart item
            foreach ($cartData as $data) {
                $product = Product::find($data->product_id);

                // Check if the product has sufficient stock
                if ($product->stock_quantity < $data->quantity) {
                    throw new \Exception('Insufficient stock for product ID: ' . $data->product_id);
                }

                // Calculate the total price
                $total_price += $data->price * $data->quantity;

                // Create the order detail
                $orderDetail = new OrderDetails();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $data->product_id;
                $orderDetail->quantity = $data->quantity;
                $orderDetail->subtotal = $data->price * $data->quantity;
                $orderDetail->save();

                // Reduce the stock quantity of the product
                $product->stock_quantity -= $data->quantity;
                $product->save();

                // Remove the cart item
                $data->delete();
            }

            // Update the total amount of the order
            $order->total_amount = $total_price;
            $order->save();

            // Assign the order ID to the variable
            $orderId = $order->id;
        });

        // Redirect to the payment form route with the order ID
        return redirect()->route('landingpage-items.payment-form', ['orderId' => $orderId])->with('success', 'Order has been placed successfully!');
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
