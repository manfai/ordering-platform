<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GiftCollection extends ResourceCollection
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
            'image' => $this->image,
            'type' => $this->type,
            'value' => $this->value,
            'minimum' => $this->minimum,
            'expired_at' => $this->expired_at,
            'ecpoint' => $this->for_wallet,
            'is_personal' => $this->is_personal,
            'max_use' => $this->max_use,
            'max_use_per_user' => $this->max_use_per_user,
            'active' => $this->active,
            'remark' => $this->remark,
            'location' => '2/F, 30 Wong Chuk Hang Road, Wong Chuk Hang'
        ];
    }
}
