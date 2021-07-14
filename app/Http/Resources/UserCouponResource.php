<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Api\V1\Model\Coupon;

class UserCouponResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $coupon = Coupon::find($this->coupon_id);
        // if(!$coupon){
        //     \Log::info($this->coupon_id);
        // }   
        $color = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        return [
            'id' => $this->id,
            'code' => $this->coupon_id,
            'image' => $coupon->image,
            // 'name' => $coupon->name . ' Coupon',
            'name' => $coupon->name,
            'description' => $coupon->description,
            'color' => $coupon->color?$coupon->color:strtolower($color),
            'type' => $coupon->type,
            'value' => $this->value?(int)$this->value:(int)$coupon->value,
            'max_use' => $this->max_use,
            'status' => $this->status,
            'expired_at' => $this->expired_at,
            'default' => false,
            // 'used' => $this->use_count >= $this->max_use ? true : false,
        ];
    }
}
