<?php

namespace App\Http\Resources;

// use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCollection extends JsonResource
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
        return [
            'id'        =>  $this->id,
            'title'     =>  $this->title,
            'desc'      =>  $this->desc,
            'image'     =>  $this->image,
            'href'      =>  [
                'link'  =>  url('api/posts/'.$this->id)
            ]
        ];
    }
}