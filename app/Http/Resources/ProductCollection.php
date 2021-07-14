<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(isset($request->language)){
            $lang = $request->language;
        } else {
            $lang = 'en';
        }
        return[
            'id' => $this->id,
            'title' => $this->getTranslation('title', $lang),
            'description' => $this->getTranslation('description', $lang),
            'on_sale' => $this->on_sale,
            'discount' => $this->discount,
            'rating' => $this->rating,
            'review_count' => $this->review_count,
            'price' => $this->price,
        ];

    }
}
