<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * Một category có nhiều products
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Quan hệ nhiều-nhiều với sizes
     */
    public function sizes()
    {
        // xóa ->withTimestamps()
        return $this->belongsToMany(Size::class, 'category_size', 'category_id', 'size_id');
    }

}
