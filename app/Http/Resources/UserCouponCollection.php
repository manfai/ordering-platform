<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Api\V1\Model\Coupon;


class UserCouponCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $coupon = Coupon::find($this->coupon_id);
        $color = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        return [
            'id' => $this->id,
            'name' => $coupon->name,
            'description' => $coupon->description,
            'code' => $coupon->code,
            'color' => $coupon->color?'#'.$coupon->color:strtolower($color),
            'type' => $coupon->type,
            'value' => $coupon->value,
            'max_use' => $this->max_use,
            'status' => $this->status,
            'used' => $this->use_count >= $this->max_use ? true : false,
        ];
    }
}
