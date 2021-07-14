<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MerchantCollection extends ResourceCollection
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
            'uuid' => $this->uuid,
            'code' => $this->code,
            'name' => $this->name,
            'shortand' => $this->shortand,
            'expired_at' => $this->expired_at,
            'active' => $this->active,
        ];
    }
}
