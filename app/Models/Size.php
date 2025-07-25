<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Một size có nhiều sản phẩm.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Một size thuộc nhiều danh mục (qua bảng pivot category_size).
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_size', 'size_id', 'category_id')
                    ->withTimestamps();
    }
}