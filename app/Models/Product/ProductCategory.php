<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public $guarded = [];
    public function product() 
    {
        return $this->belongsTo('App\Models\Product\Product');
    }

}
