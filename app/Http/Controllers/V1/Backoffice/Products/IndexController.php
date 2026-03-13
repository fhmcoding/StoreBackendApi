<?php

namespace App\Http\Controllers\V1\Backoffice\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    public function __invoke(Request $request):JsonResponse
    {
        return $this->success(
            ProductResource::collection(
                QueryBuilder::for(Product::class)
                    ->with('images','category','brand')
                    // ->allowedFilters('name','product_code')
                    ->allowedIncludes('category','brand')
                    ->where('brand_id',$request->filter['brand_id'] ?? null)
                    ->latest()
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
