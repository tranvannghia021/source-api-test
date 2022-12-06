<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $url= strpos($this->image,'http') ===false ? env('APP_URL') . '/storage/category/' . $this->image: $this->image ;

        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>$url,
            'status'=>$this->status,
            'parent_id'=>$this->parent_id,
            'created_at'=>$this->created_at
        ];
    }
}
