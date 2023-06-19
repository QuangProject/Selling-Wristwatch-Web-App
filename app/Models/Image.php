<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'watch_id',
    ];

    public function watch()
    {
        return $this->belongsTo(Watch::class);
    }
}
