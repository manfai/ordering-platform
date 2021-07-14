<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
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
        return[
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'email' => $this->email,
            'phone_no' => $this->phone_no,
            'jwt_token' => $this->jwt_token,
            'last_login' => $this->last_login,
            'ecpoint' => $this->balance,
        ];
    }
}
