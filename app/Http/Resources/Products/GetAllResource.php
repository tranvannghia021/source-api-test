<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class GetAllResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $urlSlide='';
        if(strpos($this->image_slide,'http') ===false){
            $urlSlide= env('APP_URL') . '/storage/ProductSlide/'. $this->image_slide;
            $urlSlide=str_replace(',',','.env('APP_URL') . '/storage/ProductSlide/',$urlSlide);
        }else{
             $urlSlide=$this->image_slide;
        }
        $url= strpos($this->image,'http') ===false ? env('APP_URL') . '/storage/Product/' . $this->image: $this->image ;
        return [
            'id'=>$this->id,
            'category'=>$this->categories->only('name','image','status','created_at'),
            'product_details'=>$this->product_details->only('code_color','amount','price'),
            'name'=>$this->name,
            'description'=>$this->description,
            'image'=>$url,
            'image_slide'=>explode(',',$urlSlide),
            'status'=>$this->status,
            'created_at'=>$this->created_at
        ];
    }
}
