<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MenuProduct extends Pivot
{
    public $guarded = [];
    public $table = 'menu_product';

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function detail()
    {
        return $this->hasMany('App\Models\Product\ProductSku', 'id', 'product_sku_id');
    }
}
