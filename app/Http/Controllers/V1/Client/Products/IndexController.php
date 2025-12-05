<?php

namespace App\Http\Controllers\V1\Client\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ProductResource;
use App\Models\ProductGroup;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController extends Controller
{

    public function __invoke():JsonResponse
    {
        return $this->success(
            ProductResource::collection(
                QueryBuilder::for(ProductGroup::class)
                    ->with('products')
                    ->allowedIncludes('category','brand')
                    ->allowedFilters('category.name','brand.name','name')
                    // ->active()
                    ->latest()
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
