<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $guarded = [];

    public function products()
    {
        return $this->belongsToMany(\App\Models\Product\Product::class)
            ->withPivot(['preset_buffer', 'stock', 'id', 'special_price', 'active'])
            ->withTimestamps()
            ->using(\App\Models\Product\MenuProduct::class);
        // return $this->hasMany('App\Models\Product\MenuProduct');
    }

    public function locations()
    {
        return $this->hasMany(\App\Models\Product\MenuLocationStock::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function period()
    {
        return $this->belongsTo('App\Models\Period');
    }
}
