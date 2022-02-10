<?php

namespace Modules\Post\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this -> user_id,
            'title' => $this -> title,
            'description' => $this -> desciption,
            'image' => $this -> image,
            'created_at' => $this->created_at->format('D, j M Y  h:i A'),
            'updated_at' => $this->updated_at->format('D, j M Y  h:i A'),
        ];
    }
}