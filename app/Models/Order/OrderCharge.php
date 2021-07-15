<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

use App\UserCoupon;
use App\User;
use App\Order;
use App\OrderItem;
use App\UserPayment;
use App\Discount;
use App\Http\Api\V1\Model\Product\Product;

class OrderCharge extends Model
{
    //
    public $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getRemarkAttribute($value)
    {
        //STEP1: explode
        // $class = explode(':', $value);
        // switch ($class[0]) {
        //     case 'Discount':
        //         $value = Discount::find($class[1]);
        //         $value = $value->name;
        //         break;

        //     case 'Product':
        //         $value = Product::find($class[1]);
        //         $value = $value->title;
        //         break;

        //     case 'UserCoupon':
        //         $value = UserCoupon::find($class[1]);
        //         $value = $value->coupon->name;
        //         break;

        //     default:
        //         $value = $value;
        //         break;
        // }
        return $value;
    }
}
