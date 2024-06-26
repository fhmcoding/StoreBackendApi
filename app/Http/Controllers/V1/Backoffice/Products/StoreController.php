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

        return $this->success(
            ProductResource::make(
                tap(
                    Product::query()->create($request->validated()),
                    fn (Product $product) => $product->images()
                                                     ->createMany(collect($request->images)->map(function ($image){
                                                            return [
                                                            'image_url' => '/products/'.$image
                                                            ];
                                                        }))

                )
            )
        );
    }
}
