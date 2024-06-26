<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            'image_url' => $this->image_url == null ? null : Storage::disk('public')->url($this->image_url),
            'products_count' => $this->when($this->products_count !== null, $this->products_count),
            'products' => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
