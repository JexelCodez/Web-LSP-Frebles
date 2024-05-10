<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address1',
        'address2',
        'address3'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function wishlists()
    // {
    //     return $this->hasMany(Wishlists::class);
    // }

    // public function productReviews()
    // {
    //     return $this->hasMany(Product_Reviews::class, 'customer_id');
    // }
}
