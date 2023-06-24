<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'district_id',
        'name',
    ];

    public function districts()
    {
        return $this->belongsTo(District::class);
    }
}
