<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderDetails = DB::table('vworderdetails')->get();
        return view('admin.order_details.index', [
            'orderDetails' => $orderDetails
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $orders = Order::all();
        $customers = Customer::all();
        $productCategory = ProductCategories::all();
        
        // Return the create view with the neccessary data
        return view('admin.order_details.create', [
            'products' => $products,
            'orders' => $orders,
            'customers' => $customers,
            'productCategory' => $productCategory
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and retrieve necessary request data
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
            'quantity' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ]);

        // Create a new order detail record
        OrderDetails::create($data);
        
        // Redirect to index view with success message
        return redirect()->route('admin.order_details.index')->with('success', 'The new order detail data has been successfully created!');
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
