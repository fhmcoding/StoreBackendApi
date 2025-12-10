<?php

namespace App\Http\Controllers\V1\Backoffice\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\Backoffice\OfferResource;
use App\Models\Offer;

class StoreController extends Controller
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
            OfferResource::make(
                tap(
                    Offer::query()->create([
                        'title' => $request->input('title'),
                        'from' => $request->input('from'),
                        'to' => $request->input('to'),
                        'user_id' => $request->input('user_id')
                    ]),
                    fn (Offer $offer) => $offer->productOffers()->createMany($request->products)
                )
            )
        );
    }
}
