<?php

namespace App\Http\Controllers\V1\Backoffice\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\Backoffice\OfferResource;
use App\Models\Offer;

class DestroyProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,Offer $offer, $product_id)
    {
        logger($product_id);
        return $this->success(
            OfferResource::make(
                tap($offer, fn(Offer $offer) => $offer->productOffers()->where('product_id',$product_id)->delete())
            )
        );

    }
}
