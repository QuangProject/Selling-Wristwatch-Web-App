<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiver_id',
        'order_date',
        'delivery_date',
        'shipping_fee',
        'total_price',
        'status',
    ];

    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
