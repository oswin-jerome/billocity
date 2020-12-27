<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class productResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            "price"=>$this->price,
            "barcode"=>$this->barcode,
            "stock"=>$this->stock,
            'brand'=>$this->getbrand,
            'image'=>$this->product_image,
            'category'=>$this->getcategory,
        ];
    }
}
