<?php

namespace App\Http\Controllers;

use App\Models\DiscountCategories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscountCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discountCategories = DiscountCategories::all();
        return view('discount-categories.index', compact('discountCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $discountCategories = DiscountCategories::all();
        return view('discount-categories.create', compact('discountCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => [
                'required',
                'max:255',
                Rule::unique('discount_categories')->ignore($request->id),
            ],
        ], 
        
        ['category_name.unique' => 'The discount category name already exists.']);

        // Create the discount category
        DiscountCategories::create([
            'category_name' => $request->input('category_name'),
        ]);

        return redirect()->route('discount-categories.index')->with('success', 'Discount category created successfully!');
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
        $discountCategories = DiscountCategories::findOrFail($id);
        return view('discount-categories.edit', [
            'discountCategories' => $discountCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_name' => [
                'required',
                'max:255',
                Rule::unique('discount_categories')->ignore($request->id),
            ],
        ], [
            'category_name.unique' => 'The discount category name already exists.',
        ]);

        $discountCategory = DiscountCategories::findOrFail($id);
        $discountCategory->category_name = $request->input('category_name');
        $discountCategory->save();

        return redirect()->route('discount-categories.index', [
            'success' => 'update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DiscountCategories::findOrFail($id)->delete();

        return redirect()->route('discount-categories.index');
    }
}
