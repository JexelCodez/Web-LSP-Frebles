<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function showCart()
    {
        $total_price = 0;
        $total_item = 0;
        $user_id = auth()->user()->id;
        $carts = Cart::where('user_id', $user_id)->get();
        $customers = User::find($user_id)->customer()->first(); // Using ->first() to get a single customer
        
         if ($customers === null || $customers->name === null) {
            return redirect()->route('customers.create');
        }

        foreach ($carts as $cart) {
            $total_price = $total_price + $cart->price;
            $total_item = $cart->count();
        }

        return view ('landingpage-items.cart', [
            'carts' => $carts,
            'customers' => $customers,
            'total_price' => $total_price,
            'total_item' => $total_item
        ]);
    }

    public function AddToCart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $product = Product::with('discounts')->find($id);

            // Check if the product is already in the user's cart
            $existingCartItem = Cart::where('user_id', $user->id)
                                    ->where('product_id', $id)
                                    ->first();

            if ($existingCartItem) {
                // Update the quantity and price
                $existingCartItem->quantity += $request->stock_quantity;
                
                // Recalculate price with discount if exists
                if ($product->discounts()->exists()) {
                    $discount = $product->discounts()->first();
                    $discountPercentage = $discount->percentage;

                    if ($discountPercentage > 0) {
                        $existingCartItem->price = ($product->price - ($product->price * $discountPercentage / 100)) * $existingCartItem->quantity;
                    } else {
                        $existingCartItem->price = $product->price * $existingCartItem->quantity;
                    }
                } else {
                    $existingCartItem->price = $product->price * $existingCartItem->quantity;
                }

                $existingCartItem->save();
            } else {
                // Create a new cart item
                $cart = new Cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->product_name;

                // Calculate price with discount if exists
                if ($product->discounts()->exists()) {
                    $discount = $product->discounts()->first();
                    $discountPercentage = $discount->percentage;

                    if ($discountPercentage > 0) {
                        $cart->price = ($product->price - ($product->price * $discountPercentage / 100)) * $request->stock_quantity;
                    } else {
                        $cart->price = $product->price * $request->stock_quantity;
                    }
                } else {
                    $cart->price = $product->price * $request->stock_quantity;
                }

                $cart->image = $product->image1_url;
                $cart->category_name = $product->productCategories->category_name;
                $cart->product_id = $product->id;
                $cart->quantity = $request->stock_quantity;

                $cart->save();
            }

            return redirect()->back()->with('success', 'Produk berhasil masuk keranjang!');
        } else {
            return redirect('login');
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////

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

        $order = null;

        DB::transaction(function () use ($cartData, $customer, &$order) {
            $total_price = 0;

            // Create the order with initial total_amount as zero
            $order = new Order;
            $order->customer_id = $customer->id;
            $order->order_date = now();
            $order->total_amount = 0; // Initial total amount
            $order->status = 'Dalam Proses';
            $order->save();

            // Process each cart item
            foreach ($cartData as $data) {
                $product = Product::find($data->product_id);

                // Check if the product has sufficient stock
                if ($product->stock_quantity < $data->quantity) {
                    throw new \Exception('Stok tidak cukup untuk produck ini: ' . $data->product_id);
                }

                // Calculate the total price
                $price = $product->price;
                $discountPercentage = 0;

                // Check if the product has a discount
                if ($product->discounts()->exists()) {
                    $discount = $product->discounts()->first();
                    $discountPercentage = $discount->percentage;
                }

                // Apply discount if applicable
                if ($discountPercentage > 0) {
                    $price = $price - ($price * $discountPercentage / 100);
                }

                // Calculate subtotal
                $subtotal = $price * $data->quantity;
                $total_price += $subtotal;

                // Create the order detail
                $orderDetail = new OrderDetails();
                $orderDetail->order_id = $order->id; // Assign order ID
                $orderDetail->product_id = $data->product_id;
                $orderDetail->quantity = $data->quantity;
                $orderDetail->subtotal = $subtotal;
                $orderDetail->save();

                // Reduce the stock quantity of the product
                $product->stock_quantity -= $data->quantity;
                $product->save();

                // Remove the cart item
                $data->delete();
            }

            // Update the total amount of the order with the discounted total price
            $order->total_amount = $total_price;
            $order->save();
        });

        if (!$order) {
            return redirect()->back()->withErrors(['cart' => 'Failed to create order.']);
        }

        // Redirect to the payment form with the order and snap token
        return view('landingpage-items.payment-form', [
            'status' => 'save',
            'message' => 'Silahkan lanjut ke pembayaran! ',
            'order' => $order,
        ]);
    }


    public function removeCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */

}
