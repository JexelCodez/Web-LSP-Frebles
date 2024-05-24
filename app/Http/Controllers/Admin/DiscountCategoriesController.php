<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.discount-categories.index', [
            'discountCategories' => $discountCategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $discountCategories = DiscountCategories::all();
        return view('admin.discount-categories.create', [
            'discountCategories' => $discountCategories
        ]);
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

        $discountCategories = DiscountCategories::all();
        return view ('admin.discount-categories.index', [
            'status' => 'save',
            'message' => 'The category "' . $request->category_name . '" has been successfully saved! ',
            'discountCategories' => $discountCategories
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
        $discountCategories = DiscountCategories::findOrFail($id);
        return view('admin.discount-categories.edit', [
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

        $discountCategories = DiscountCategories::all();
        return view ('admin.discount-categories.index', [
            'status' => 'save',
            'message' => 'The category "' . $request->product_name . '" has been successfully updated! ',
            'discountCategories' => $discountCategories
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discountCategory = DiscountCategories::find($id);
        if (!$discountCategory) {
            $discountCategories = DiscountCategories::all();
            return view ('admin.discount-categories.index', [
                'discountCategories' => $discountCategories
            ]);
        } else {
            // If the discount category exists, delete it
            $discountCategory->delete();

            // Fetch all discount categories and return to the index view
            $discountCategories = DiscountCategories::all();
            return view('admin.discount-categories.index', [
                'discountCategories' => $discountCategories
            ]);
        }
    }
}
