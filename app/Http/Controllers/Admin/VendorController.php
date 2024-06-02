<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::all();
        return view ('admin.vendors.index', [
            'vendors' => $vendors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor::all();
        return view('admin.vendors.create', [
            'vendors' => $vendors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $data = $request->only(['name', 'contact_name', 'contact_phone', 'address', 'city', 'state', 'zip_code', 'country']);

        Vendor::create($data);
        
        $vendors = Vendor::all();
        return view ('admin.vendors.index', [
            'status' => 'save',
            'message' => 'You have created vendor with the name "' . $request->name . '"',
            'vendors' => $vendors
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
        $vendors = Vendor::findOrFail($id);
        return view('admin.vendors.edit', [
            'vendors' => $vendors
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $vendors = Vendor::findOrFail($id);
        $vendors->name = $request->input('name');
        $vendors->contact_name = $request->input('contact_name');
        $vendors->contact_phone = $request->input('contact_phone');
        $vendors->address = $request->input('address');
        $vendors->city = $request->input('city');
        $vendors->state = $request->input('state');
        $vendors->zip_code = $request->input('zip_code');
        $vendors->country = $request->input('country');
        $vendors->save();

        $vendors = Vendor::all();
        return view ('admin.vendors.index', [
            'status' => 'save',
            'message' => 'You have updated the vendor data!',
            'vendors' => $vendors
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Vendor::findOrFail($id)->delete();
        return redirect()->route('admin.vendors.index');
    }
}
