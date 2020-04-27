<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            // 'image'     =>  Storage::disk('public')->url('images/' . $this->image),
            'image'     => asset('storage/images/' . $this->image),
            // 'href'      =>  [
            //     'link'  =>  route('posts.show', $this->id)
            // ]
        ];
    }
}