<?php

namespace App\Http\Controllers\V1\Client\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use Storage;

class IndexController extends Controller
{

    public function __invoke():JsonResponse
    {
        // with offers
        $products = Product::with('category','brand','images')->where('stock_quantity', '>', 0)->get();

        $grouped = $products->map(function ($product) {

            // Extract size (supports: 30ML, 30 ML, 30ml, etc.)
            preg_match('/(\d+\s?ML)$/i', $product->name, $matches);
            $size = isset($matches[1]) ? strtoupper(str_replace(' ', '', $matches[1])) : null;

            // Remove size from name
            $baseName = trim(preg_replace('/\s*\d+\s?ml$/i', '', $product->name));

            return [
                'base_name' => $baseName,
                'size' => $size,
                'price' => $product->price,
                'id' => $product->id,
                'product_code' => $product->product_code,
                'description' => $product->description,
                'image_url' => count($product->images) > 0 ? Storage::disk('public')->url($product->images[0]->image_url) : null,
                'size' => $product->size,
                'sale_price' => $product->price,
                'category' => $product->category,
                'brand' => $product->brand
            ];
        })
        ->groupBy('base_name')
        ->map(function ($items, $name) {
            return [
                'name' => $name,
                'products' => $items->map(function ($item) {
                    return [
                        'id' => $item['id'],
                        'product_code' => $item['product_code'],
                        'description' => $item['description'],
                        'image_url' => $item['image_url'],
                        'size' => $item['size'],
                        'sale_price' => $item['price'],
                        'category' => $item['category'],
                        'brand' => $item['brand']
                    ];
                })->values()
            ];
        })
        ->values();



        return $this->success(
            $grouped
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
