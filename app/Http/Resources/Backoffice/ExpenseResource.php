<?php

namespace App\Http\Resources\Backoffice;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'refernece' => $this->refernece,
            'amount' => $this->amount,
            'user' => UserResource::make($this->whenLoaded('user')),
            'created_at' => $this->created_at
        ];
    }
}
