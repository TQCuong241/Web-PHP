<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'category_id',
        'size_id',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Một product thuộc về một size
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
