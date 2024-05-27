<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($orderId)
    {
        // Retrieve the order based on the provided ID
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('landingpage-items.cart')->with('error', 'Order not found.');
        }

        // Generate a unique order ID for Midtrans
        $uniqueOrderId = $order->id . '-' . time();

        // Generate Snap token after order creation
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Prepare payment parameters
        $params = [
            'transaction_details' => [
                'order_id' => $uniqueOrderId,
                'gross_amount' => $order->total_amount,
            ],
            'customer_details' => [
                'last_name' => $order->customer->name,
                'email' => $order->customer->email,
                'phone' => $order->customer->phone,
            ],
        ];

        // Generate Snap token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // You can also retrieve any additional data needed for the payment form
        $payments = Payment::all();
        $products = Product::all();

        return view('landingpage-items.payment-form', [
            'order' => $order,
            'payments' => $payments,
            'products' => $products,
            'snapToken' => $snapToken
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function CashOnDelivery(Request $request, $id)
    {
        // Fetch the order based on the provided ID
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Create a new payment for the order
        $payment = new Payment;
        $payment->order_id = $order->id;
        $payment->payment_date = now();
        $payment->payment_method = 'Cash On Delivery';
        $payment->amount = $order->total_amount;

        // Save the payment
        $payment->save();

        // Optionally update the order status
        $order->status = 'Pending COD Payment';
        $order->save();

        $user = Auth::user();
        $userId = $user->id;
        $orders = Order::with('orderDetails')->where('customer_id', $userId)->get();
        // Redirect to an order summary page with a success message
        return view ('myorders', [
            'status' => 'save',
            'message' => 'You have finished your payment! Thank you for your patronage!! ',
            'orders' => $orders
        ]);
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
