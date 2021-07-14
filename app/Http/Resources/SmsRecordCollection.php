<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SmsRecordCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'from_type' => $this->from_type,
            'from_id' => $this->from_id,
            'to_type' => $this->to_type,
            'to_id' => $this->to_id,
            'phone' => $this->phone,
            'content' => $this->content,
            'api_url' => $this->api_url,
            'result' => $this->result,
            'define_no' => $this->define_no,
            'hex' => $this->hex,
            'sender' => $this->sender,
        ];
    }
}
