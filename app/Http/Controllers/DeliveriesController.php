<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Deliveries;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = DB::table('vwdeliveries')->get();
        return view('deliveries.index', compact('deliveries'));

        // $deliveries = DB::table('vwdeliveries')->get();
        // return view('admin.deliveries.index', [
        //     'deliveries' => $deliveries
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        $customers = Customer::all();

        return view('deliveries.create', compact('orders', 'customers'));

        // $orders = Order::all();
        // $customers = Customer::all();

        // return view('deliveries.create', [
        //     'orders' => $orders,
        //     'customers' => $customers
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'shipping_date' => 'required|date',
            'tracking_code' => 'required|string',
            'status' => 'required|string'
        ]);

        $data['order_id'] = $request->order_id;
        $data['shipping_date'] = $request->shipping_date;
        $data['tracking_code'] = $request->tracking_code;
        $data['status'] = $request->status;

        // Create a new delivery record
        Deliveries::create($data);

        return redirect()->route('deliveries.index')->with('success', 'Delivery log created successfully!');
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
        $deliveries = Deliveries::findOrFail($id);

        return view('deliveries.edit', [
            'deliveries' => $deliveries,
            'orders' => Order::all(),
            'customers' => Customer::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'shipping_date' => 'required|date',
            'tracking_code' => 'required|string',
            'status' => 'required|string'
        ]);

        $deliveries = Deliveries::findOrFail($id);
        $deliveries->order_id = $request->input('order_id');
        $deliveries->shipping_date = $request->input('shipping_date');
        $deliveries->tracking_code = $request->input('tracking_code');
        $deliveries->status = $request->input('status');
        $deliveries->save();

        return redirect()->route('deliveries.index', [
            'success' => 'update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Deliveries::findOrFail($id)->delete();

        return redirect()->route('deliveries.index');
    }
}
