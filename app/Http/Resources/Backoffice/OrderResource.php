<?php

namespace App\Http\Resources\Backoffice;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'currency' => $this->currency,
            'address' => $this->address,
            'sub_total'=>$this->sub_total,
            'total' => $this->total,
            'delivery_fee'=> $this->delivery_fee,
            'products_count'=>$this->when($this->products_count !== null, $this->products_count),
            'user' => UserResource::make($this->whenLoaded('user')),
            'customer' => CustomerResource::make($this->whenLoaded('customer')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'user_notes' => $this->user_notes,
            'status_history' => $this->whenLoaded('statusHistory'),
            'type' => $this->type,
        ];
    }
}
