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

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function delivery()
    {
        return $this->hasOne(Deliveries::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
