<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
// use App\Http\Api\V1\Model\Product\Product;
use App\Models\Product\Product;
use App\Models\Store;
// use App\Http\Api\V1\Model\Store;
use Spatie\Activitylog\Traits\LogsActivity;

class MenuLocationStock extends Model
{
    public $guarded = [];

    public function menuProduct()
    {
        return $this->belongsTo(MenuProduct::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getRealStockAttribute()
    {
        $real = (int) $this->stock - (int) $this->sold;
        if ($real <= 0) {
            return (int) 0;
        }
        return $real;
        // return (int) ($real<=0)?0:$real;
    }

    public function getPriceAttribute()
    {
        // dd('123');
        if ($this->special_price !== null) {
            return $this->special_price;
        } else {
            if ($this->menuProduct->special_price !== null) {
                return $this->menuProduct->special_price;
            }
            // dd($this->menuProduct->product->price);
            return $this->menuProduct->product->price;
        }
    }
}
