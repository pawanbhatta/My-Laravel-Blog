<?php

namespace App\Http\Resources;

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
        // return parent::toArray($request);
        return [
            'id'        =>  $this->id,
            'user_id'   =>  $this->user_id,
            'title'     =>  $this->title,
            'desc'      =>  $this->desc,
            'image'     =>  $this->image,
            // 'href'      =>  [
            //     'link'  =>  route('posts.show', $this->id)
            // ]
        ];
    }
}