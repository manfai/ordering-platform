<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Api\V1\Model\Gift;

class UserGiftCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $Gift = Gift::find($this->gift_id);
        return [
            'id' => $this->id,
            'code' => $gift->code,
            // 'qrcode' => \QrCode::size(100)->generate($this->user_id.'_'.$gift->code),
            'qrcode' => $this->user_id.'_'.$gift->code,
            'name' => $gift->name,
            'description' => $gift->description,
            'image' => $gift->image,
            'ecpoint' => $gift->for_wallet,
            'status' => $this->status,
            'pickup' => [
                'location' => '2/F, 30 Wong Chuk Hang Road, Wong Chuk Hang',
                'date' => date('Y-m-d')
            ]
        ];
    }
}
