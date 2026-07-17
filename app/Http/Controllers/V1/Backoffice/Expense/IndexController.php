<?php

namespace App\Http\Controllers\V1\Backoffice\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Http\Resources\Backoffice\ExpenseResource;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class IndexController extends Controller
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
            ExpenseResource::collection(
                QueryBuilder::for(Expense::class)
                    ->allowedIncludes('user')
                    ->allowedFilters(['user_id','created_at',
                    AllowedFilter::callback('created_from', fn ($query, $value) =>
                            $query->whereDate('created_at', '>=', $value)
                        ),
                        AllowedFilter::callback('created_to', fn ($query, $value) =>
                            $query->whereDate('created_at', '<=', $value)
                        )
                        ])
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
