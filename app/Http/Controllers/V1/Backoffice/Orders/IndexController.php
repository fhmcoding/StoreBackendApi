<?php

namespace App\Http\Controllers\V1\Backoffice\Orders;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\OrderResource;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

use App\Models\Order;

class IndexController extends Controller
{
    public function __invoke():JsonResponse
    {
        return $this->success(
            OrderResource::collection(
                QueryBuilder::for(Order::class)
                    ->with('user','customer','statusHistory','user','caissier')
                    ->allowedIncludes('products','payments','customer','productsCount')
                   ->allowedFilters(['user_id','caissier_id','created_at'
                        AllowedFilter::callback('created_from', fn ($query, $value) =>
                            $query->whereDate('created_at', '>=', $value)
                        ),
                        AllowedFilter::callback('created_to', fn ($query, $value) =>
                            $query->whereDate('created_at', '<=', $value)
                        ),
                    ])
                    //->where('caissier_id',auth()->user()->id)
                    ->latest()
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
