<?php

namespace App\Http\Controllers\V1\Backoffice\Statistic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SummaryController extends Controller
{

    public function __invoke(Request $request):JsonResponse
    {
        logger($request->all());

        $orders = Order::query()
                        ->when($request->has('user_id'),fn ($query) => $query->where('user_id',$request->user_id))
                        ->when(isset($request->created_before),fn($query) => $query->createdBefore($request->created_before))
                        ->when(isset($request->created_after),fn($query) => $query->createdAfter($request->created_after))
                        ->get();

        $confirmed  =   $orders->where('confiramtion_status',Order::CONFIRMED)
                               ->count();

        $deliverd   =   $orders->where('delivery_status',Order::DELIVERED)
                                ->count();

        $canceled   =   $orders->where('delivery_status',Order::RETURNED)
                                ->count();

        return  $this->success([
            'orders' => $orders->count(),
            'confirmation_rate'=>    $orders->count() == 0 ? 0 : round(($confirmed * 100) / $orders->count(),2) ,
            'delivery_rate'    =>    $confirmed == 0 ? 0 : round(($deliverd * 100) / $confirmed,2),
            'cancel_rate'     =>     $orders->count() == 0 ? 0 : round(($canceled * 100) / $orders->count(),2)
        ],Response::HTTP_OK);
    }
}
