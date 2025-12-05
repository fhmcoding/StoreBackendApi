<?php

namespace App\Http\Controllers\V1\Backoffice\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\ProductResource;
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
                    ->with('images','products')
                    ->allowedIncludes('category','brand')
                    ->latest()
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
