<?php

namespace App\Http\Controllers\V1\Backoffice\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Backoffice\PaymentResource;
use App\Models\Payment;
use App\Models\Order;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request):JsonResponse
    {
        $order = Order::where('id',$request->order_ref)->first();

        return $this->success(
            PaymentResource::make(
                Payment::query()->create([
                  'order_id' => $order->id ?? null,
                  'user_id' => $request->user_id,
                  'payment_method' => $request->payment_method,
                  'amount' => $request->amount
                ])
            )
        );

    }
}
