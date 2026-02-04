<?php

namespace App\Http\Controllers\V1\Backoffice\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Payment;
use App\Http\Resources\Backoffice\PaymentResource;

class UpdateStatusController extends Controller
{

    public function __invoke(Request $request,Payment $payment):JsonResponse
    {
        if($request->status  !== $payment->status){
            $payment->update([
                'status' => $request->status,
            ]);
            $payment->statusHistory()->create([
                'user_id' => auth()->user()->id,
                'status' => $request->status
            ]);
        }


        return $this->success(
            PaymentResource::make(
                $payment
            )
        );

    }
}
