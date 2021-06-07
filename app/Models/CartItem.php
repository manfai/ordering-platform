<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Api\V1\User;
use App\Models\Product\Product;
use App\Models\Period;
use App\MenuProduct;
use App\Models\Product\ProductSku;
// use Spatie\Activitylog\Traits\LogsActivity;

class CartItem extends Model
{
    // use LogsActivity;
    // protected $fillable=['quantity'];
    protected $guarded=[];
    protected $casts = [
        'menu_date' => 'date'
    ];

    // public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
 
    public function menuProduct(){
        return $this->belongsTo(MenuProduct::class);
    }

    public function productSku(){
        return $this->belongsTo(ProductSku::class);
    }
    public function period(){
        return $this->belongsTo(Period::class);
    }

    // public function getMenuDateAttribute($value)
    // {
    //     return $this->menuProduct()->menu->menu_date;
    // }

    // public function getPeriodAttribute($value)
    // {
    //     return  $this->menuProduct();
    // }
    // menu_date
    // period
}
