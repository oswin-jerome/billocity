<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'total'=>$this->total,
            "coupon"=>$this->coupon,
            "final_price"=>$this->final_price,
            "customer"=>$this->custo,
            'status'=>$this->status,
            'payment_method'=>$this->payment_method,
            'paid_amount'=>$this->paid_amount,
            'points_redeem'=>$this->points_redeem,
            'coupon_redeem'=>$this->coupon_redeem,
            'products'=>$this->products,
            'created_at'=>$this->created_at,
        ];
    }
}
