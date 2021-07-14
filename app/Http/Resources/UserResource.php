<?php

namespace App\Http\Resources;

use App\Http\Api\V1\Model\Store;
use App\UserToken;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
        $address = $this->addresses()->orderBy('id','desc')->first();
        if($address){
            $store = Store::find( ($address->location_id?$address->location_id:2) );
            $address = [
                'location_id'=>$store->id,
                'area'=>ucwords(str_replace('-',' ',$address->district)),
                'full_address'=>$store->getTranslation('name',$this->language).', '.$store->area->getTranslation('name',$this->language).', '.$store->area->country->getTranslation('name',$this->language),
            ];
        } else {

            $address = [
                'location_id'   => '0',
                'area'  => 'HONGKONG',
                'full_address'  => '',
            ];
        }
        return[
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'email' => $this->email,
            'phone_no' => $this->phone_no,
            'jwt_token' => $this->jwt_token,
            'last_login' => $this->last_login,
            'language' => $this->language,
            'ecpoint' => $this->balance,
            'dob' => isset($this->detail->dob)?date('Y-m-d',strtotime($this->detail->dob)):'0000-00-00',
            'age' => isset($this->detail->dob)?floor((time() - strtotime($this->detail->dob)) / 31556926):0,
            'receive_news' => $this->receive_news?'true':'false',
            'gender' => isset($this->detail->gender)?$this->detail->gender:'M',
            'avatar' => isset($this->detail->avatar)?$this->detail->avatar:'https://uat.9869bento.com/images/profile.png',
            'location' => $address,
            // 'facebook' => UserToken::where('user_id',$this->id)->where('type','facebook')->exists(),
            // 'google' => UserToken::where('user_id',$this->id)->where('type','google')->exists(),
            'preferences' => $this->preferences!==NULL?['chinese']:['meet','beef','egg','fish'],
        ];
    }
}
