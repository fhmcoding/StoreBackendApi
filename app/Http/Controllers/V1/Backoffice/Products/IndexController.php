<?php

namespace App\Http\Controllers\V1\Backoffice\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;


class IndexController extends Controller
{
    public function __invoke():JsonResponse
    {
        return $this->success(
            ProductResource::collection(
                QueryBuilder::for(Product::class)
                    ->with('images','category','brand')
                    ->allowedFilters('name','brand_id','product_code')
                    ->allowedIncludes('category','brand')
                    ->latest()
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
