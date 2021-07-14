<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Api\V1\Model\Product\ProductSku;

class MenuProductResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        dd($this);
        // return parent::toArray($request);
        // $sku = ProductSku::find($this->product_sku_id);
        // $sku = ProductSku::find($this->id);

        return[
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'description' => $this->description,
            'discount' => $this->discount,
            'rating' => $this->rating,
            'review_count' => $this->review_count,
            'pivot_id' => $this->pivot_id,
            'price' => $this->price,
            'stock' => $this->stock,
            'on_sale' => $this->stock == 0 ? $this->on_sale : false,
            'sold' => $this->stock == 0 ? true : false,
            'tags' => $this->tags->pluck('name'),
            'tagsWithString' => implode(',', $this->tags->pluck('name')->toArray()),
        ];

    }
}
