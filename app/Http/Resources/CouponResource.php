<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        if($this->id == 8){
            $expired_at = date('Y-m-d 23:59:59', strtotime('+1 month'));
        } else {
            $expired_at = $this->expired_at;
        }
        
        return[
            'id' => $this->id,
            'code' => $this->code,
            'color' => $this->color,
            'name' => $this->name,
            'description' => $this->description,
            // 'image' => $this->image,
            'type' => $this->type,
            'value' => $this->value,
            // 'minimum' => $this->minimum,
            'expired_at' => $expired_at,
            'is_personal' => $this->is_personal,
            'max_use' => $this->max_use,
            'ecpoint' => $this->for_wallet,
            'max_use_per_user' => $this->max_use_per_user,
            'active' => $this->active,
            'remark' => $this->remark,
        ];
    }
}
