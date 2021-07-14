<?php

namespace App\Http\Resources;

use App\Http\Api\V1\Model\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class GiftResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
        
        // return parent::toArray($request);
        return[
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->getTranslation('name', $lang),
            'image' => $this->media->url,
            'type' => $this->type,
            'value' => $this->value,
            // 'minimum' => $this->minimum,
            'expired_at' => $this->expired_at,
            'ecpoint' => $this->for_wallet,
            'is_personal' => $this->is_personal,
            'max_use' => $this->max_use,
            'max_use_per_user' => $this->max_use_per_user,
            'active' => $this->active,
            'remark' => $this->remark,
            // 'location' => '2/F, 30 Wong Chuk Hang Road, Wong Chuk Hang'
            'location' => Store::find(54)->full_address,
        ];
    }
}
