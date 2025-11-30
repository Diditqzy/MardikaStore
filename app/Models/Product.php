<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
        return $this->belongsTo(\App\Models\Store::class, 'store_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }
public function reviews()
{
    return $this->hasMany(\App\Models\Review::class, 'product_id');
}

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
    public function seller()
{
    return $this->belongsTo(\App\Models\User::class, 'seller_id');
}

}
