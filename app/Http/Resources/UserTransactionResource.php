<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTransactionResource extends JsonResource
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
        return [
            'title' => isset($this->meta['title'])?$this->meta['title']:'---',
            'description' => isset($this->meta['description'])?$this->meta['description']:'---',
            'user_id' => $this->payable_id,
            'type' => $this->type,
            'amount' => $this->amount,
            'confirmed' => $this->confirmed,
            'created_at' => date('Y-m-d H:i:s', strtotime($this->created_at))
        ];
    }
}
