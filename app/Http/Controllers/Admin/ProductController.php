<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('vwproducts')->get();
        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategories::all();
        return view('admin.products.create', [
            'productCategories' => $productCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => [
                'required',
                'max:255',
                Rule::unique('products')->ignore($request->id),
            ],
            'product_category_id' => 'required|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'nullable|numeric|min:0',
            'description' => 'required|string|max:500',
            'image1_url' => 'required|image|max:2048',
            'image2_url' => 'nullable|image|max:2048',
            'image3_url' => 'nullable|image|max:2048',
            'image4_url' => 'nullable|image|max:2048',
            'image5_url' => 'nullable|image|max:2048',
            'type' => 'nullable|string|max:50',
        ], 
    
        ['product_name.unique' => 'The product name already exists.']);

        $data = $request->only(['product_name', 'product_category_id', 'price', 'description', 'type']);

        $data['stock_quantity'] = 0;

        $data['image1_url'] = $request->file('image1_url')->store('Products/Photos');

        if ($request->hasFile('image2_url')) {
            $data['image2_url'] = $request->file('image2_url')->store('Products/Photos');
        }
        if ($request->hasFile('image3_url')) {
            $data['image3_url'] = $request->file('image3_url')->store('Products/Photos');
        }
        if ($request->hasFile('image4_url')) {
            $data['image4_url'] = $request->file('image4_url')->store('Products/Photos');
        }
        if ($request->hasFile('image5_url')) {
            $data['image5_url'] = $request->file('image5_url')->store('Products/Photos');
        }

        Product::create($data);

        $products = DB::table('vwproducts')->get();
        return view ('admin.products.index', [
            'status' => 'save',
            'message' => 'The new product with the name "' . $request->product_name . '" has been successfully saved! ',
            'products' => $products
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
        $products = Product::findOrFail($id);
        $productCategories = ProductCategories::all();

        return view('admin.products.edit', [
            'products' => $products,
            'productCategories' => $productCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'nullable|numeric|min:0',
            'description' => 'required|string|max:500',
            'image1_url' => 'nullable|image|max:2048',
            'image2_url' => 'nullable|image|max:2048',
            'image3_url' => 'nullable|image|max:2048',
            'image4_url' => 'nullable|image|max:2048',
            'image5_url' => 'nullable|image|max:2048',
            'type' => 'nullable|string|max:50',
        ]);

        $product = Product::findOrFail($id);
        $product->product_name = $request->input('product_name');
        $product->product_category_id = $request->input('product_category_id');
        $product->price = $request->input('price');
        $product->stock_quantity = $request->input('stock_quantity') ?? 0;
        $product->description = $request->input('description');
        $product->type = $request->input('type');
        
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image' . $i . '_url')) {
                $imagePath = $request->file('image' . $i . '_url')->store('Products/Photos');
                $product->{'image' . $i . '_url'} = str_replace('public/', 'storage/', $imagePath);
            }
        }

        $product->save();

        $products = DB::table('vwproducts')->get();
        return view('admin.products.index', [
            'status' => 'save',
            'message' => 'The product with the name "' . $request->product_name . '" has been successfully updated! ',
            'products' => $products
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            $products = DB::table('vwproducts')->get();
            return view ('admin.products.index', [
                'products' => $products
            ]);
        } else {
            // If the product category exists, delete it
            $product->delete();

            // Fetch all product categories and return to the index view
            $products = DB::table('vwproducts')->get();
            return view('admin.products.index', [
                'products' => $products
            ]);
        }
    }
}
