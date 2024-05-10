<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCategories extends Model
{
    use HasFactory;

    protected $table = 'discount_categories';
    protected $fillable = [
        'category_name'
    ];

    // public function discount()
    // {
    //     return $this->hasMany(Discounts::class, 'category_discount_id');
    // }
}
