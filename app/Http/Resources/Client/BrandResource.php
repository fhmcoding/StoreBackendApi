<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BrandResource extends JsonResource
{

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
