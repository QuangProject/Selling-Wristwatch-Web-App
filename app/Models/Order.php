<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_date',
        'delivery_date',
        'receiver_name',
        'receiver_telephone',
        'receiver_address',
        'shipping_fee',
        'total_price',
        'status',
        'payment_method',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
