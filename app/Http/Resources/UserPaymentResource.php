<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Api\V1\Model\Coupon;
use App\Http\Api\V1\Model\Payment;

class UserPaymentResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        $cardInfo = $this->remark;
        if(!is_array($cardInfo)){
            $cardInfo = custom_decrypt($this->remark);
            // dd($cardInfo);
            // $cardInfo['cvc'] = '';
            // $cardInfo['exp_date'] = '';
        }

        
        return [
            'id' => $this->id,
            'name' => $this->encode_name,
            'value'=> $this->value,
            'key'=> $this->key,
            'image' => Payment::find($this->payment_id)->image,
            'color' => $this->color,
            'exp_date' => $cardInfo['exp_date'],
            'remark' => $cardInfo,
            'brand' => $this->brand,
            'brand_id' => $this->payment_id,
            'payment_id' => $this->payment_id,
        ];

    }
}
