<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Api\V1\Model\Gift;
use App\Http\Api\V1\Model\Store;

class UserGiftResource extends JsonResource
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
            $supportLanguage = array("zh-HK", "zh-CN", "en", "zh-hk","zh-cn");
            if (!in_array($request->language, $supportLanguage)) {
                $lang = 'en';
            } else {
                $lang = strtolower($request->language);
            }
        } else {
            $lang = 'en';
        }

        $gift = Gift::find($this->gift_id);
        return [
            'id' => $this->id,
            'code' => $gift->code,
            // 'qrcode' => \QrCode::size(100)->generate($this->user_id.'_'.$gift->code),
            'qrcode' => $this->user_id.'_'.$gift->code,
            'name' => $gift->getTranslation('name', $lang),
            'description' => $gift->description,
            'image' => $gift->media->url,
            'ecpoint' => $gift->for_wallet,
            'status' => $this->status,
            'pickup' => [
                'location' =>  Store::find(54)->full_address,
                'date' => date('Y-m-d')
            ]
        ];
    }
}
