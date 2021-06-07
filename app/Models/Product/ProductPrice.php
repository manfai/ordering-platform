<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    public $guarded = [];
    public function price()
    {
        return $this->morphTo();
    }
}
