<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return $this->collection->map(function ($item) {
            return [
                "menu_product_id"=> $this->menu_product_id,
                "store_id"=> $this->store_id,
                "product_id"=> $this->product_sku_id,
                'image' => $this->product->image,
                'title' => $this->product->title,
                "quantity"=> $this->quantity,
                "price"=> $this->price,
                "amount"=> $this->amount,
                "menu_date"=> date('Y-m-d', strtotime($this->menu_date)),
            ];
        });
    }
}
