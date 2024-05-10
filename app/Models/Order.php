<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        'order_date',
        'total_amount',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function delivery()
    {
        return $this->hasOne(Deliveries::class);
    }

    // public function payments()
    // {
    //     return $this->hasMany(Payments::class);
    // }

    // public function orderDetails()
    // {
    //     return $this->hasMany(Order_Details::class);
    // }
}
