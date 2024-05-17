<?php

namespace App\Http\Controllers;

use App\Models\Deliveries;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliverController extends Controller
{

    public function initiateDelivery($orderId)
    {
        // Retrieve order details based on the provided order ID
        $order = Order::find($orderId);

        // Check if the order exists
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Generate a tracking code
        $trackingCode = 'TRK' . uniqid();

        // Create a delivery record with order information
        $delivery = new Deliveries();
        $delivery->order_id = $order->id;
        $delivery->shipping_date = now(); 
        $delivery->tracking_code = $trackingCode;
        $delivery->status = 'Pending'; 
        $delivery->save();

        // Optionally update the order status
        $order->status = 'In Transit';
        $order->save();

        return redirect()->back()->with('success', 'Delivery initiated successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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
