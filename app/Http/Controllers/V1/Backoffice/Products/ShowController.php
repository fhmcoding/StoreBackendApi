<?php

namespace App\Http\Controllers\V1\Backoffice\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ShowController extends Controller
{

    public function __invoke($id):JsonResponse
    {
        return $this->success(
            ProductResource::make(
                QueryBuilder::for(Product::class)
                    ->with('category')
                    ->allowedIncludes('brand','category','images','products')
                    ->findOrFail($id)
            )
        );
    }
}
