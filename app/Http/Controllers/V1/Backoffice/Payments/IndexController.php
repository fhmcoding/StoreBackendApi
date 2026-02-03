<?php

namespace App\Http\Controllers\V1\Backoffice\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Payment;
use App\Http\Resources\Backoffice\PaymentResource;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->success(
            PaymentResource::collection(
                QueryBuilder::for(Payment::class)
                    ->with('user','order')
                    ->allowedIncludes('order','user')
                    ->allowedFilters('user_id','order_id','created_at')
                    ->latest()
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
