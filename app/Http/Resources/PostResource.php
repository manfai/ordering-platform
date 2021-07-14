<?php

namespace App\Http\Resources;

use App\UserRead;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $arr = [];
        $user = $request->user();
        // return parent::toArray($request);
        switch ($this->type) {
            default:
                $arr= [
                    'id' => $this->id,
                    'url' => 'https://air.ecbento.com/posts/'.$this->id.'_'.urlencode($this->title),
                    'type' => $this->type,
                    'title' => $this->title,
                    'description' => $this->description,
                    'image' => $this->img?$this->img->url:'',
                    'cover' => $this->media?$this->media->url:$this->image,
                    'status' => $this->status,
                    // 'read' => UserRead::where(['user_id'=>$user->id, 'readable_type'=>'App\Api\V1\Model\Post', 'readable_id'=>$this->id])->exists(),
                    'read' => false,
                    'active' => $this->active,
                ];
                break;
        }
        return $arr;
    }
}
