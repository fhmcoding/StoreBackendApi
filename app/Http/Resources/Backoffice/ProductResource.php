<?php

namespace App\Http\Resources\Backoffice;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
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
            'product_code' => $this->product_code,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'stock_quantity' => $this->stock_quantity,
            'is_active'=>$this->is_active,
            'image_url' => count($this->images) > 0 ? Storage::disk('public')->url($this->images[0]->image_url) : null,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'images' => ProductImageResource::collection($this->whenLoaded('images')),
            'product'=>$this->whenLoaded('productGroup'),
            'pivot' => $this->when($this->pivot !== null, $this->pivot),
            'products' => $this->products,

        ];
    }
}
