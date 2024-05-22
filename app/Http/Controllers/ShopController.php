<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showShop()
    {
        $products = Product::all();
        return view ('landingpage-items.product-details', [
            'products' => $products
        ]);
    }


    public function searchProduct(Request $request)
    {
        $searchText = $request->search;
        $products = Product::where('product_name', 'LIKE', "%$searchText%")->paginate(10);
        $cartItemCount = '';

        return view ('landingpage-items.shop', [
            'products' => $products,
            'cartItemCount' => $cartItemCount
        ]);
    }

    // public function searchProduct(Request $request)
    // {
    //     $searchText = $request->input('search');
    //     $cartItemCount = ''; // Retrieve the actual cart item count as needed

    //     // Search for products based on the search text and paginate the results or you can use view tables
    //     $products = Product::where('product_name', 'LIKE', "%$searchText%")->orWhere('$products->productCategories->category_name', 'LIKE', "%$searchText%")->paginate(10);

    //     return view('landingpage-items.shop', [
    //         'products' => $products,
    //         'cartItemCount' => $cartItemCount
    //     ]);
    // }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
