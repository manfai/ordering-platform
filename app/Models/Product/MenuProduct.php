<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class MenuProduct extends Model
{
    public $guarded = [];

    public function menu() 
    {
        return $this->belongsTo('App\Models\Product\Menu');
    }

    public function detail() 
    {
        return $this->hasMany('App\Models\Product\ProductSku', 'id', 'product_sku_id');
    }
}
