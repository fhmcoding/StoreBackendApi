<?php

namespace App\Http\Controllers\V1\Backoffice\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Backoffice\OrderResource;
use Illuminate\Http\JsonResponse;
use App\Models\Order;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,Order $order):JsonResponse
    {
        if($request->status  !== $order->status){
            $order->update([
                'status' => $request->status,
            ]);
            $order->statusHistory()->create([
                'user_id' => auth()->user()->id,
                'status' => $request->status
            ]);
        }

        $order->update([
            'user_notes' => $request->user_notes,
            'address' => $request->address
        ]);

        return $this->success(
            OrderResource::make(
                $order
            )
        );


    }
}
