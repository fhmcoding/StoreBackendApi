<?php

namespace App\Http\Controllers\V1\Client\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ProductResource;
use App\Models\ProductGroup;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ShowController extends Controller
{

    public function __invoke(ProductGroup $product):JsonResponse
    {
        return $this->success(
            ProductResource::make(
                QueryBuilder::for(ProductGroup::class)
                    ->with('products')
                    ->allowedIncludes('brand','category','images')
                    ->findOrFail($product->id)
            )
        );
    }
}
