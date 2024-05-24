<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view ('admin.customers.index', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('admin.customers.create', [
            'customers' => $customers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:20',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'address3' => 'nullable|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'address1', 'address2', 'address3']);

        $data['password'] = Hash::make($request->password); // Hash the password before storing
        $data['user_id'] = Auth::id();

        Customer::create($data);

        // Variables to make the return work
        $total_price = 0;
        $user_id = auth()->user()->id;
        $carts = Cart::where('user_id', $user_id)->get();
        $customers = User::find($user_id)->customer()->first();
        
        return view ('landingpage-items.cart', [
            'status' => 'save',
            'message' => 'You have created your customer data! with the name "' . $request->name . '"',
            'carts' => $carts,
            'customers' => $customers,
            'total_price' => $total_price
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
        $customers = Customer::findOrFail($id);
        return view('admin.customers.edit', [
            'customers' => $customers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'address3' => 'nullable|string|max:255',
        ]);

        $customers = Customer::findOrFail($id);
        $customers->name = $request->input('name');
        $customers->email = $request->input('email');
        $customers->phone = $request->input('phone');
        $customers->address1 = $request->input('address1');
        $customers->address2 = $request->input('address2');
        $customers->address3 = $request->input('address3');
        $customers->save();

        return redirect()->route('admin.customers.index', [
            'success' => 'update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::findOrFail($id)->delete();
        return redirect()->route('admin.customers.index');
    }
}
