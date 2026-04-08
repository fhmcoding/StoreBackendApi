<?php

namespace App\Http\Controllers\V1\Backoffice\Statistic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class StockValueController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $products  = Product::where('stock_quantity', '>', 0);

        return response()->json([
            'success' => true,
            'stock_count' => $products->sum('stock_quantity'),
            'price' => $products->sum('price'),
            'sale_price' => $products->sum('sale_price'),
        ]);
    }
}
