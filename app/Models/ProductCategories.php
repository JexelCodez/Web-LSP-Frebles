<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    use HasFactory;

    protected $table = 'product_categories';
    protected $fillable = [
        'category_name'
    ];

    // public function productRelationship()
    // {
    //     return $this->hasMany(Products::class, 'product_category_id');
    // }
}
