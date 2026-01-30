<?php

namespace App\Http\Controllers\V1\Backoffice\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Backoffice\ProductResource;
use App\Http\Requests\Backoffice\ProductRequest;
use App\Models\Product;
use Storage;

class StoreController extends Controller
{

    public function __invoke(ProductRequest $request)
    {
        if($request->has('images')){
            foreach($request->images as $image){
                Storage::disk('public')->move('tmp/'.$image, 'products/'.$image);
            }
        }


        foreach($request->products as $product){
            Product::create([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'name' => $request->name .' '. $product['name'],
                'product_code' => $product['product_code'],
                'price' => $product['price'],
                'sale_price' => $product['sale_price'],
                'stock_quantity' => $product['stock_quantity']
            ]);
        }

        return $this->success(
            [
                'succes' => true
            ]
        );
    }
}
