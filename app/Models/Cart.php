<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'watch_id',
        'quantity',
    ];

    public function watch()
    {
        return $this->belongsTo(Watch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
