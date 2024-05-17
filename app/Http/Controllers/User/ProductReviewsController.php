<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\ProductReviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productReviews = DB::table('vwproductreviews')->get();
        return view('user.product_reviews.index', [
            'productReviews' => $productReviews
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        $productCategories = ProductCategories::all();
        
        // Return the create view with customer and product data
        return view('user.product_reviews.create', [
            'customers' => $customers,
            'products' => $products,
            'productCategories' => $productCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and retrieve necessary request data
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|numeric|min:1|max:10',
            'comment' => 'required|string|max:255',
        ]);

        $data['customer_id'] = $request->customer_id;
        $data['product_id'] = $request->product_id;
        $data['rating'] = $request->rating;
        $data['comment'] = $request->comment;
        // Create a new product review record
        ProductReviews::create($data);

        return redirect()->route('landingpage-items.shop')->with('success', 'Review created successfully!');
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
        $productReviews = ProductReviews::findOrFail($id);
        
        return view('user.product_reviews.edit', [
            'productReviews' => $productReviews,
            'customers' => Customer::all(),
            'products' => Product::all(),
            'productCategories' => ProductCategories::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate and retrieve necessary request data
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|numeric|min:1|max:10',
            'comment' => 'required|string|max:255',
        ]);

        // Find the product review and update its data
        $productReview = ProductReviews::findOrFail($id);
        $productReview->customer_id = $request->input('customer_id');
        $productReview->product_id = $request->input('product_id');
        $productReview->rating = $request->input('rating');
        $productReview->comment = $request->input('comment');
        $productReview->save();
        
        return redirect()->route('user.product-reviews.index', [
            'success' => 'update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProductReviews::findOrFail($id)->delete();
        // Redirect to index view with success message and updated data
        return redirect()->route('user.product-reviews.index');
    }
}
