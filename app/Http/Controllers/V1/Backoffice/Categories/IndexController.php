<?php

namespace App\Http\Controllers\V1\Backoffice\Categories;

use App\Http\Controllers\Controller;

use App\Http\Resources\Backoffice\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController extends Controller
{

    public function __invoke()
    {
        return $this->success(
            CategoryResource::collection(
                QueryBuilder::for(Category::class)
                    ->allowedIncludes('products','productsCount')
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
