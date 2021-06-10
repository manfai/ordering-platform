<?php

namespace App\Models\Order;

use App\Http\Api\V1\Model\Product\Product;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    public $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }


    public function getResultAttribute()
    {
        if ($this->action == 'extraction') {

            if (strpos($this->remark, 'Picked') !== false) {
                return str_replace('Picked', '己提取', $this->remark);
            } else if (strpos($this->remark, 'Picking') !== false) {
                return str_replace('Picking up', '提取中', $this->remark);
            }

            return $this->remark;
        }
        return $this->remark;
    }

    // public function getHistoryAttribute(){
    //     if($this->action == 'extraction'){
    //         if (strpos($this->remark, 'Foodlocker Picked') !== false) {
    //             $remark = str_replace(' ','',$this->remark);
    //             $remark = explode(':',$remark);
    //             return $remark[2];
    //         } 
    //         return '';
    //     }
    //     return '';
    // }

    public function getBentosAttribute($value)
    {
        if ($this->action == 'extraction') {
            $bentos = $this->orderItem()->whereDate('menu_date', date('Y-m-d', strtotime($this->created_at)))->get()->pluck('product_id');
            $title = [];
            foreach ($bentos as $key => $value) {
                $product = Product::find($value);
                if (!$product) {
                    $title[] = $value;
                } else {
                    $title[] = $product->title;
                }
            }
            return implode(',', $title);
        }
        return '---';
    }

    public function getStatusAttribute()
    {

        if (strpos($this->remark, 'Picked') !== false) {
            return 'Picked';
        } else {
            return 'Picking';
        }
    }
}
