<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\DiscountCategories;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = DB::table('vwdiscounts')->get();
        return view('admin.discounts.index', [
            'discounts' => $discounts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $discountCategories = DiscountCategories::all();
        $products = Product::all();

        return view('admin.discounts.create', [
            'discountCategories' => $discountCategories,
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_discount_id' => 'required|exists:discount_categories,id',
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'percentage' => 'required|numeric|min:0|max:1',
        ]);

        $data['category_discount_id'] = $request->category_discount_id;
        $data['product_id'] = $request->product_id;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['percentage'] = $request->percentage;

        Discount::create($data);

        return redirect()->route('admin.discounts.index')->with('success', 'Discount created successfully!');
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
        $discounts = Discount::findOrFail($id);
        $discountCategories = DiscountCategories::all();
        $products = Product::all();

        return view('admin.discounts.edit', [
            'discounts' => $discounts,
            'discountCategories' => $discountCategories,
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_discount_id' => 'required|exists:discount_categories,id',
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'percentage' => 'required|numeric|min:0|max:1',
        ]);

        $discounts = Discount::findOrFail($id);
        $discounts->category_discount_id = $request->input('category_discount_id');
        $discounts->product_id = $request->input('product_id');
        $discounts->start_date = $request->input('start_date');
        $discounts->end_date = $request->input('end_date');
        $discounts->percentage = $request->input('percentage');
        $discounts->save();

        return redirect()->route('admin.discounts.index', [
            'success' => 'update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Discount::findOrFail($id)->delete();
        return redirect()->route('admin.discounts.index');
    }
}
