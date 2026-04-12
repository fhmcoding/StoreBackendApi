<?php

namespace App\Http\Controllers\V1\Client\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController extends Controller
{

    public function __invoke():JsonResponse
    {
        // with offers
        $products = Product::where('stock_quantity', '>', 0)->get();

        $grouped = $products->map(function ($product) {

            // Extract size (e.g. 30ML, 50ML)
            preg_match('/(\d+ML)$/', $product->name, $matches);
            $size = $matches[1] ?? null;

            // Remove size from name
            $baseName = trim(preg_replace('/\s*\d+ML$/', '', $product->name));

            return [
                'base_name' => $baseName,
                'size' => $size,
                'price' => $product->sale_price,
            ];
        })
        ->groupBy('base_name')
        ->map(function ($items, $name) {
            return [
                'name' => $name,
                'products' => $items->map(function ($item) {
                    return [
                        'size' => $item['size'],
                        'price' => $item['price'],
                    ];
                })->values()
            ];
        })
        ->values();



        return $this->success(
            ProductResource::collection(
                $products
            )->response()->getData(true)
        );

        // return $this->success(
        //     ProductResource::collection(
        //         QueryBuilder::for(Product::class)
        //             // ->with('products','products.offers')
        //             ->allowedIncludes('category','brand')
        //             ->allowedFilters('category.name','brand.name','name')
        //             // ->active()
        //             ->latest()
        //             ->optionalPagination()
        //     )->response()->getData(true)
        // );
    }
}
