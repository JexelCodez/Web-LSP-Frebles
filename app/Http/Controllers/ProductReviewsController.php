<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\ProductReviews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showReview()
    {
        $user = Auth::user();
        $userId = $user->id;

        $productReviews = DB::table('vwproductreviews')->where('user_id', '=', $userId)->get();

        return view('myreviews', [
            'productReviews' => $productReviews
        ]);
    }

     
    public function deleteReview($id)
    {
        $productReview = ProductReviews::find($id);

        if (!$productReview) {
            // If the product review doesn't exist, return a response indicating that
            return redirect()->back();
        }

        // Delete the product review
        $productReview->delete();

        // Fetch all product reviews and return to the view
        $user = Auth::user();
        $userId = $user->id;
        $productReviews = DB::table('vwproductreviews')->where('customer_id', '=', $userId)->get();

        return view('myreviews', [
            'productReviews' => $productReviews
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $customer = User::find($user_id)->customer()->first();

        // If customer one of the customer data is null, redirect to a specific route
        if ($customer === null || $customer->name === null) {
            return redirect()->route('customers.create');
        }

        $customers = Customer::all();
        $products = Product::all();
        $productCategories = ProductCategories::all();
        
        // Return the create view with customer and product data
        return view('admin.product_reviews.create', [
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
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $data['customer_id'] = $request->customer_id;
        $data['product_id'] = $request->product_id;
        $data['rating'] = $request->rating;
        $data['comment'] = $request->comment;
        // Create a new product review record
        ProductReviews::create($data);
        
        // Variables to make the return work
        $productId = Product::find($request->product_id);
        $cartItemCount = '';
        $products = Product::with('discounts')->paginate(10);

        return view ('landingpage-items.shop', [
            'status' => 'save',
            'message' => 'Review kamu pada produk "' . $productId->product_name . '" telah berhasil disimpan! Terima kasih atas tanggapanmu!',
            'cartItemCount' => $cartItemCount,
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
        $productReviews = ProductReviews::findOrFail($id);
        
        return view('product_reviews.edit', [
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
        
        return redirect()->route('product-reviews.index', [
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
        return redirect()->route('product-reviews.index');
    }
}
