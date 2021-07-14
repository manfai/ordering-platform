<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentCollection extends ResourceCollection
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
            'title' => $this->title,
            'desciption' => $this->description,
            'image' => $this->image,
            'provider' => $this->provider,
            'enable' => $this->enable,
            'test_mode' => $this->test_mode,
        ];
    }
}
