<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class UploadProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload products';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        ProductGroup::query()->delete();
        Product::query()->delete();

        $path = public_path('products.csv');

        $rows = array_map('str_getcsv', file($path));

        $products = [];

        foreach ($rows as $row) {
            $row = str_getcsv(implode(';', $row), ';');

            if (count($row) < 6) {
                continue;
            }

            $products[] = [
                'name' => trim($row[0]),
                'price'    => (float) str_replace(',', '.', $row[1]),
                'sale_price'   => (float) str_replace(',', '.', $row[2]),
                'stock_quantity'        => (int) $row[3],
                'product_code'      => $row[4],
                'brand'        => $row[5],
            ];
        }


        foreach ($products as $key => $product) {

            $this->info($product['brand']);

            $brand = Brand::whereRaw(
                'LOWER(name) LIKE ?',
                ['%' . strtolower($product['brand']) . '%']
            )->first();

            if(!isset($brand)){
                $brand = Brand::create([
                    'name' => $product['brand']
                ]);
            }
            if(Product::where('product_code',$product['product_code'])->count() == 0){
                Product::create([
                    'name' => $product['name'],
                    'product_code' => $product['product_code'],
                    'stock_quantity' => $product['stock_quantity'],
                    'price' => $product['price'],
                    'sale_price' => $product['sale_price'],
                    'brand_id' => $brand->id
                ]);
            }
        }

        logger($products);

        return 0;
    }
}
