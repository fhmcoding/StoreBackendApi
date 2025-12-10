<?php

namespace App\Http\Controllers\V1\Backoffice\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\ProductResource;
use App\Models\ProductGroup;
use Illuminate\Http\JsonResponse;

class DestroyController extends Controller
{

    public function __invoke(ProductGroup $product):JsonResponse
    {
        return $this->success(
            ProductResource::make(
                tap($product,fn (ProductGroup $product) => $product->images()->delete() || $product->delete())
            )
        );
    }
}
