<?php

namespace App\Http\Controllers\V1\Backoffice\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Payment;
use App\Http\Resources\Backoffice\OrderResource;
use Illuminate\Http\JsonResponse;


class CheckoutController extends Controller
{

    public function __invoke(Request $request):JsonResponse
    {
        $order = Order::create([
            'user_id' => $request->has('user_id') ? $request->user_id : auth()->user()->id,
            'status' => Order::DELIVERED,
            'type' => 'caisse',
        ]);

        foreach ($request->products as $key => $product) {
            $p = Product::where('product_code',$product['product_id'])->first();
            if(isset($p)){
                OrderProduct::create([
                    'order_id'=> $order->id,
                    'product_id' => $p->id,
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'original_price' => $p->price
                ]);
            }
        }

        Payment::create([
            'user_id' => $order->user_id,
            'order_id' => $order->id,
            'amount' => $request->total,
            'payment_method' => $request->payment_method
        ]);

        return $this->success(OrderResource::make($order));

    }
}
