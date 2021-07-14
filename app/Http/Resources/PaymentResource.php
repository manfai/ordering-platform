<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
        if($image = $this->image){
            
        } else {
            $image = $this->getTranslation('image', 'en');
        }
        return [
            'id'=>$this->id,
            'name'=>$this->title,
            'image'=>$image,
            'payBy'=>($this->provider=='mpgs')?"client":"server",
            'url'=>'https://ecbento.com',
            'discount'=>($this->id==1)?0:0,
        ];
    }
}
