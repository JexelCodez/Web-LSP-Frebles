<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showOrder()
    {

        // where: Filters based on conditions on the columns of the main model's table.
        // whereHas: Filters based on the existence or properties of related models.

        $user = Auth::user();
        $userId = $user->id;

        $orders = Order::with('orderDetails')
            ->whereHas('customer', function ($query) use ($userId) {
                $query->where('user_id', '=', $userId);
            })
            ->get();

        return view('myorders', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function cancelOrder($id)
    {
        $order = Order::find($id);

        $order->status = 'Dibatalkan';
        $order->save();

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function searchMyOrders(Request $request)
    {
        $searchText = $request->search;
        $orders = Order::where('status', 'LIKE', "%$searchText%")->get();

        return view ('myorders', [
            'orders' => $orders,
        ]);
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
