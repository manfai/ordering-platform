<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MachineProductCollection extends ResourceCollection
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
            'machine_id' => $this->machine_id,
            'period_id' => $this->period_id,
            'product_sku_id' => $this->product_sku_id,
            'track_y' => $this->track_y,
            'track_x' => $this->track_x,
            'track_type' => $this->track_type,
            'stock' => $this->stock,
            'stock_count' => $this->stock_count,
            'sold_count' => $this->sold_count,
            'publish_at' => $this->publish_at,
        ];
    }
}
