<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DeviceCollection extends ResourceCollection
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
        return[
            'id' => $this->id,
            'uuid' => $this->uuid,
            'os' => $this->os,
            'os_verison' => $this->os_verison,
            'name' => $this->name,
            'reg_ip_address' => $this->reg_ip_address,
            'remark' => $this->remark,
        ];
    }
}
