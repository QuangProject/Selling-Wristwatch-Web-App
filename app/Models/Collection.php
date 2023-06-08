<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'release_date',
        'brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function watches()
    {
        return $this->hasMany(Watch::class);
    }
}
