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
                    $product->update($request->validated());
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
