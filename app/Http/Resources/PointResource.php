<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PointResource extends JsonResource
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
            $lang = strtolower($request->language);
        } else {
            $lang = 'en';
        }

        if($this->code !== 'EC-ANYWHERE'){
            $full_address = $this->getTranslation('name', $lang).', '.ucfirst($this->area->getTranslation('name', $lang)).', '.ucfirst($this->area->country->getTranslation('name', $lang));
        } else {
            $full_address = $this->getTranslation('name', $lang);
        }

        // \Log::info($request->all());
        return [
            'id'=>$this->id,
            'code'=>$this->code,
            'area'=>ucwords(str_replace('-',' ',$this->area->code)),
            'full_address' => $full_address,
            'lat'=>$this->latitude,
            'lng'=>$this->longitude,
        ];
    }
}
