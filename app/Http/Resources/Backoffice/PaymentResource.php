<?php

namespace App\Http\Resources\Backoffice;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'user_id' => $this->user_id,
            'order_id' => $this->order_id,
            'order' =>$this->whenLoaded('order'),
            'user' => $this->whenLoaded('user'),
            'created_at'=>$this->created_at
        ];
    }
}
