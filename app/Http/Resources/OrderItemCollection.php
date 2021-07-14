<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderItemCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        return [
            'date'  => date('Y-m-d',strtotime($this->extraction_start)),
            'title' => $this->product->title,
            'price' => $this->price,
            'qty'   => $this->quantity,
            'period' => 'lunch',
            'status' => $this->order->payment_status
        ];
    }
}
