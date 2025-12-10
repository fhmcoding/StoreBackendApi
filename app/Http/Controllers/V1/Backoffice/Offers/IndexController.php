<?php

namespace App\Http\Controllers\V1\Backoffice\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\Backoffice\OfferResource;
use App\Models\Offer;

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
            OfferResource::collection(
                QueryBuilder::for(Offer::class)
                    ->with('user','products')
                    ->allowedIncludes('user','products','productsCount')
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
