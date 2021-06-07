<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProductSku extends Model
{
    use HasTranslations;
    public $translatable = ['title', 'image', 'description'];
    public $guarded = [];

    protected $casts = [
        'on_sale' => 'boolean',
        'same_price' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product');
    }
    
    public function track()
    {
        return $this->belongsTo('App\Models\VM\MachineType', 'track_type');
    }
    
    public function images()
    {
        return $this->morphMany('App\Models\Product\ProductImage', 'image');
    }

    public function prices()
    {
        return $this->morphMany('App\Models\Product\ProductPrice', 'price');
    }
}
