<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CouponCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'color' => '#'.$this->color,
            'description' => $this->description,
            // 'image' => $this->image,
            'type' => $this->type,
            'value' => $this->value,
            'minimum' => $this->minimum,
            'expired_at' => $this->expired_at,
            'is_personal' => $this->is_personal,
            'max_use' => $this->max_use,
            'max_use_per_user' => $this->max_use_per_user,
            'active' => $this->active,
            'remark' => $this->remark,
        ];
    }
}
