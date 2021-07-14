<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AreaCollection extends ResourceCollection
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
            'code' => $this->code,
            'type' => $this->type,
            'name' => $this->name,
            'image' => $this->image,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'priority' => $this->priority,
        ];
    }
}
