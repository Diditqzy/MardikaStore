<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        return $this->belongsTo(\App\Models\User::class, 'user_id'); 
        return $this->belongsTo(User::class, 'user_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
        
    }
}
