<?php

namespace App\Http\Controllers\V1\Backoffice\Orders;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\OrderResource;
use Illuminate\Http\JsonResponse;
use App\Models\Order;

class DestroyController extends Controller
{

    public function __invoke(Order $order):JsonResponse
    {
        return $this->success(
            OrderResource::make(tap($order)->delete())
        );
    }
}
