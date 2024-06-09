<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'phone' => [
                'required',
                'max:50',
                Rule::unique('customers')->ignore(auth()->id()),
            ],
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'address3' => 'nullable|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
        ],

        ['phone.unique' => 'This phone number already exists. We apologize for the inconvenience, if this is your number, please contact us for more confirmation.']);

        $data = $request->only(['name', 'phone', 'address1', 'address2', 'address3']);

        $data['user_id'] = Auth::id();

        Customer::create($data);

        return redirect()->route('dashboard')->with('success', 'Data customer Anda berhasil dibuat!');
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
            'phone' => 'required|string|max:20',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'address3' => 'nullable|string|max:255',
        ]);

        $customers = Customer::findOrFail($id);
        $customers->name = $request->input('name');
        $customers->phone = $request->input('phone');
        $customers->address1 = $request->input('address1');
        $customers->address2 = $request->input('address2');
        $customers->address3 = $request->input('address3');
        $customers->save();

        return redirect()->route('dashboard')->with('success', 'Data customer Anda berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::findOrFail($id)->delete();
        return redirect()->route('landingpage')->with('success', 'Data customer Anda berhasil dihapus!');
    }
}
