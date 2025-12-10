<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Http\Resources\Client\OrderResource;
use Illuminate\Http\JsonResponse;
use Auth;

class CheckoutController extends Controller
{

    public function __invoke(Request $request):JsonResponse
    {


        if(isset($request->customer) && strlen($request->customer['phone_number']) > 5 ){
            $customer = Customer::create($request->customer);
        }

        $order = Order::create([
            'user_id' => Auth::check() ? auth()->user()->id : null,
            'customer_id' => strlen($request->customer['phone_number']) > 5 ? $customer->id : null,
        ]);

        foreach ($request->products as $key => $product) {
            $p = Product::where('product_code',$product['product_id'])->first();
            if(isset($p)){
                OrderProduct::create([
                    'order_id'=> $order->id,
                    'product_id' => $p->id,
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'original_price' => $p->price,
                    'offer_id' => count($product['product']['offers']) > 0 ? $product['product']['offers'][0]['id'] : null
                ]);
            }
        }

        return $this->success(OrderResource::make($order));



    }
}
