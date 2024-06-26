<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory(10)->create()
                          ->each(function (Order $order) {
                                $product = Product::query()->inRandomOrder()->first();
                                $order->products()->attach($product->id,[
                                    'quantity'=> 1,
                                    'price'=> $product->price
                                ]);
                            });
    }
}
