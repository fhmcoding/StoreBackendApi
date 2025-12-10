<?php

namespace App\Http\Controllers\V1\Backoffice\Orders;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\OrderResource;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Order;


class ShowController extends Controller
{

    public function __invoke($id):JsonResponse
    {

        return $this->success(
            OrderResource::make(
                QueryBuilder::for(Order::class)
                    ->with('products.productGroup','statusHistory')
                    ->allowedIncludes('products','customer','user')
                    ->findOrFail($id)
            )
        );
    }
}
