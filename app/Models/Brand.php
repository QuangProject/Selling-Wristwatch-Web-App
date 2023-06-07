<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_of_origin',
        'year_established',
        'image'
    ];

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
