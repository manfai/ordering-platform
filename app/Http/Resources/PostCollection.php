<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
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
            'type' => $this->type,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'url' => $this->url,
            'click_action' => $this->click_action,
            'priority' => $this->priority,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ]
        ];
    }
}
