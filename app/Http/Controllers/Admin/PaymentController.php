<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = DB::table('vwpayments')->get();
        return view('admin.payments.index', [
            'payments' => $payments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        $customers = Customer::all();

        return view('admin.payments.create', [
            'orders' => $orders,
            'customers' => $customers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $data['order_id'] = $request->order_id;
        $data['payment_date'] = $request->payment_date;
        $data['payment_method'] = $request->payment_method;
        $data['amount'] = $request->amount;

        Payment::create($data);

        return redirect()->route('admin.payments.index')->with('success', 'Payment Log created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function downloadPdfPayment()
    {
        $mpdf = new Mpdf();
        $payments = DB::table('vwpayments')->get();
        $html = View::make('admin.payments.pdf', compact('payments'))->render();
        $mpdf->WriteHTML($html);

        // Output the PDF as a download
        $mpdf->Output('payments.pdf', 'D');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payments = Payment::findOrFail($id);
        $orders = Order::all();
        $customers = Customer::all();

        return view('admin.payments.edit', [
            'payments' => $payments,
            'customers' => $customers,
            'orders' => $orders
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate request data
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        // Find the payment record by ID
        $payments = Payment::findOrFail($id);

        // Update payment attributes
        $payments->order_id = $request->input('order_id');
        $payments->payment_date = $request->input('payment_date');
        $payments->payment_method = $request->input('payment_method');
        $payments->amount = $request->input('amount');

        // Save the updated payment record
        $payments->save();

        // Redirect with success message
        return redirect()->route('admin.payments.index', [
            'success' => 'update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Payment::findOrFail($id)->delete();
        return redirect()->route('admin.payments.index');
    }
}
