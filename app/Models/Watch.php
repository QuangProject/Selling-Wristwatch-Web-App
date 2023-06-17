<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'original_price',
        'selling_price',
        'discount',
        'gender',
        'case_material',
        'case_diameter',
        'case_thickness',
        'strap_material',
        'dial_color',
        'crystal_material',
        'water_resistance',
        'movement_type',
        'power_reserve',
        'complications',
        'availability',
        'collection_id',
    ];

    public function watchCategories()
    {
        return $this->hasMany(WatchCategory::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
