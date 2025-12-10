<?php

namespace App\Http\Controllers\V1\Backoffice\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\Backoffice\OfferResource;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,Offer $offer)
    {
        $offer->update([
            'title' => $request->input('title'),
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'user_id' => $request->input('user_id')
        ]);

        foreach ($request->products as $key => $p) {
            $offer->productOffers()->create($p);
        }


        return $this->success(
            OfferResource::make($offer)
        );

    }
}
