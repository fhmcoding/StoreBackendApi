<?php

namespace App\Http\Controllers\V1\Backoffice\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Backoffice\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request):JsonResponse
    {
         return $this->success(
            ProductResource::collection(
                QueryBuilder::for(Product::class)
                    ->with('images','productGroup')
                    ->allowedIncludes('category','brand')
                    ->latest()
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
