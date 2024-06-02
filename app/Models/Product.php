<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'product_category_id',
        'vendor_id',
        'product_name',
        'description',
        'price',
        'stock_quantity',
        'image1_url',
        'image2_url',
        'image3_url',
        'image4_url',
        'image5_url',
        'type'        
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function productCategories()
    {
        return $this->belongsTo(ProductCategories::class, 'product_category_id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReviews::class, 'product_id');
    }

    // public function orderDetails()
    // {
    //     return $this->hasMany(Order_Details::class);
    // }
}
