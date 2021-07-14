<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryCollection extends ResourceCollection
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
            'iso' => $this->iso,
            'iso3' => $this->iso3,
            'name' => $this->name,
            'nicename' => $this->nicename,
            'numcode' => $this->numcode,
            'phonecode' => $this->phonecode,
            'priority' => $this->priority,
        ];
    }
}
