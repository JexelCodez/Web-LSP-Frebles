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

        // You can also retrieve any additional data needed for the payment form
        $payments = Payment::all();
        $products = Product::all();

        return view('landingpage-items.payment-form', [
            'order' => $order,
            'payments' => $payments,
            'products' => $products,
        ]);
    }

    /**
     * 
     */

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status === 'capture') {
                $order = Order::find($request->order_id);
                if ($order) {
                    $order->update(['status' => 'Paid']);
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function invoice($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->route('landingpage-items.cart')->with('error', 'Order not found.');
        }

        return view('invoice', [
            'order' => $order
        ]);
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
        $payment->payment_method = 'Bayar Di Tempat';
        $payment->amount = $order->total_amount;

        // Save the payment
        $payment->save();

        // Optionally update the order status
        $order->status = 'Dalam Proses';
        $order->save();

        // Redirect to an order summary page with a success message
        return redirect()->route('show_orders')->with('success', 'Orderan Anda sudah kami simpan!');
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
