<?php

namespace App\Http\Controllers\V1\Backoffice\Orders;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\OrderResource;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Order;

class IndexController extends Controller
{
    public function __invoke():JsonResponse
    {
        return $this->success(
            OrderResource::collection(
                QueryBuilder::for(Order::class)
                    ->allowedIncludes('products','customer','productsCount')
                    ->latest()
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
