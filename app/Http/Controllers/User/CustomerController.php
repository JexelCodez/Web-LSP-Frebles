<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Show all from customer table and return with key customers
        $customers = Customer::all();
        return view ('user.customers.index', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show all from customer table and return with relevant key
        $customers = Customer::all();
        return view('user.customers.create', [
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
        ]);

        // Create a new Customer instance
        $data = new Customer();
        
        // Assign authenticated user's ID to the customer's user_id field
        $data->user_id = auth()->id();
        
        // Fill the customer instance with form data
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password); // Hash the password before storing
        $data->phone = $request->phone;
        $data->address1 = $request->address1;
        $data->address2 = $request->address2;
        $data->address3 = $request->address3;

        // Save the customer data to the database
        $data->save();

        return redirect()->route('landingpage-items.cart')->with('success', 'Customer created successfully!');
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
