<?php

namespace App\Http\Controllers\V1\Backoffice\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class DestroyController extends Controller
{

    public function __invoke(Product $product):JsonResponse
    {
        return $this->success(
            ProductResource::make(
                tap($product,fn (Product $product) => $product->images()->delete() || $product->delete())
            )
        );
    }
}
