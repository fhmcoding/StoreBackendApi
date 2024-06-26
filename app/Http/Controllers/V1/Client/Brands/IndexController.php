<?php

namespace App\Http\Controllers\V1\Client\Brands;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController extends Controller
{
    public function __invoke()
    {
        return $this->success(
            BrandResource::collection(
                QueryBuilder::for(Brand::class)
                    ->allowedIncludes('products','productsCount')
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
