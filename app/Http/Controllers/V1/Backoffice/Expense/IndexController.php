<?php

namespace App\Http\Controllers\V1\Backoffice\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Http\Resources\Backoffice\ExpenseResource;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

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
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
