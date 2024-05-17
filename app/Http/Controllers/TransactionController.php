<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

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

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        // Prepare payment parameters
        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
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
            'snapToken' => $snapToken,
        ]);

        return redirect()->route('landingpage')->with('success', 'Order placed successfully! Please check delivery status for more information.');
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

        // Redirect to an order summary page with a success message
        return redirect()->route('landingpage', $order->id)->with('success', 'Order placed successfully! Please check delivery status for more information.');
    }

    /**
     * Display the specified resource.
     */

    // public function eWallet(Request $request, $orderId)
    // {

    //     // Retrieve the order based on the provided ID
    //     $order = Order::find($orderId);

    //     if (!$order) {
    //         return redirect()->back()->with('error', 'Order not found.');
    //     }

    //     // Set your Merchant Server Key
    //     \Midtrans\Config::$serverKey = config('midtrans.server_key');
    //     // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //     \Midtrans\Config::$isProduction = false;
    //     // Set sanitization on (default)
    //     \Midtrans\Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     \Midtrans\Config::$is3ds = true;

    //     // Prepare payment parameters
    //     $params = [
    //         'transaction_details' => [
    //             'order_id' => $order->id,
    //             'gross_amount' => $order->total_amount,
    //         ],
    //         'customer_details' => [
    //             'first_name' => $order->customer->first_name,
    //             'last_name' => $order->customer->last_name,
    //             'email' => $order->customer->email,
    //             'phone' => $order->customer->phone,
    //         ],
    //     ];

    //     // Generate Snap token
    //     $snapToken = \Midtrans\Snap::getSnapToken($params);
    
    //     // Pass the Snap token to the view
    //     return view('landingpage', [
    //         'snapToken' => $snapToken,
    //         'order' => $order,
    //     ]);
    // }

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
