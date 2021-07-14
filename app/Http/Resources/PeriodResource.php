<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeriodResource extends JsonResource
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

        return[
            'id' => $this->id,
            'title' => $this->getTranslation('title', $lang),
            // 'description' => $this->description,
            // 'description_display' => $this->description_display,
            // 'start' => $this->start, 
            // 'end' => $this->end, 
            // 'preorder_enabled' => $this->preorder_enabled, 
            // 'preorder_discount_enabled' => $this->preorder_discount_enabled, 
            // 'preorder_start' => $this->preorder_start, 
            // 'preorder_end' => $this->preorder_end, 
            // 'priority' => $this->priority, 
        ];

    }
}
