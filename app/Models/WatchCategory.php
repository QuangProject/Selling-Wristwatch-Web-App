<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'watch_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function watch()
    {
        return $this->belongsTo(Watch::class);
    }
}
