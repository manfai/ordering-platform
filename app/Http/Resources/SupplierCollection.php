<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SupplierCollection extends ResourceCollection
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
            'name' => $this->name,
            'desc' => $this->desc,
            'image' => $this->image,
            'priority' => $this->priority,
        ];
    }
}
