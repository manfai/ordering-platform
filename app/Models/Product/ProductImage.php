<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public $guarded = [];
    public function image()
    {
        return $this->morphTo();
    }
}
