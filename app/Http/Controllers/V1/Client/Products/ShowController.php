<?php

namespace App\Http\Controllers\V1\Client\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ShowController extends Controller
{

    public function __invoke(Product $product):JsonResponse
    {

        $product->load('brand');
        $product->load('category');
        $product->load('images');

        preg_match('/(\d+\s?ml)$/i', $product->name, $matches);

        $baseName = trim(preg_replace('/(\s*\d+\s?ml)$/i', '', $product->name));

        $similarProducts = Product::with('category','brand','images')->where('name', 'LIKE', $baseName . '%')->get();

        $result = [
            'name' => $baseName,
            'products' => $similarProducts->map(function ($item) {

                preg_match('/(\d+\s?ml)$/i', $item->name, $matches);
                $size = isset($matches[1])
                    ? strtoupper(str_replace(' ', '', $matches[1]))
                    : null;

                return [
                    'id' => $item->id,
                    'product_code' => $item->product_code,
                    'size' => $size,
                    'price' => $item->price,
                ];
            })->values()
        ];

        return $this->success(
            [
                'product' => $product,
                'similarProducts'=>$result
            ]
        );
    }
}
