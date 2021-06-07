<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductAddon extends Model
{
    public $guarded = [];
    public function sku() 
    {
        return $this->belongsTo('App\Models\Product\ProductSku');
    }

    public function addons() 
    {
        return $this->belongsTo('App\Models\Product\ProductSku', 'addon_sku_id');
    }
}
