<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        'order_id',
        'payment_date',
        'payment_method',
        'amount'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // public function customer()
    // {
    //     return $this->belongsTo(Customers::class, 'customer_id', 'name');
    // }
}
