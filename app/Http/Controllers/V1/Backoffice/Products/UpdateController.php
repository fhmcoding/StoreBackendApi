<?php

namespace App\Http\Controllers\V1\Backoffice\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Backoffice\ProductResource;
use App\Http\Requests\Backoffice\ProductRequest;
use App\Models\Product;
use Storage;

class UpdateController extends Controller
{

    public function __invoke(ProductRequest $request,Product $product):JsonResponse
    {
        if($request->has('images')){
            foreach($request->images as $image){
                Storage::disk('public')->move('tmp/'.$image, 'products/'.$image);
            }
        }



        return $this->success(
            ProductResource::make(
                tap($product, function (Product $product) use($request) {
                    $product->update([
                        'brand_id' => $request->brand_id,
                        'category_id' => $request->category_id,
                        'name' => $request->name,
                        'product_code' => $request->product_code,
                        'price' => $request->price,
                        'sale_price' => $request->sale_price,
                        'stock_quantity' => $request->stock_quantity
                    ]);

                    // foreach ($request->products as $key => $v) {
                    //     logger($v);

                    //     if(isset($v['id'])){
                    //         Product::find($v['id'])->update([
                    //             'name' => $v['name'],
                    //             'sale_price' => $v['sale_price'],
                    //             'price' => $v['price'],
                    //             'stock_quantity' => $v['stock_quantity'],
                    //         ]);
                    //     }

                    //     else {
                    //         $product->products()->create($v);
                    //     }
                    // }

                    if($request->has('images')){
                        $product->images()->createMany(collect($request->images)->map(function ($image){
                            return [
                                'image_url' => '/products/'.$image
                            ];
                        }));
                    }
                })
            )
        );
    }
}
