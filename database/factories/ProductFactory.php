<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class ProductFactory extends Factory
{

     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->name,
            'category_id'=> Category::query()->inRandomOrder()->first()->id,
            'brand_id'=> Brand::query()->inRandomOrder()->first()->id,
            'product_code'=> $this->faker->numerify('LK-#####'),
            'description' => $this->faker->text(200),
            'price'=> $this->faker->numberBetween(500,10000),
            'sale_price'=> $this->faker->numberBetween(500,5000),
            'stock_quantity'=> $this->faker->randomDigit(),
            'is_active'=> $this->faker->randomElement([0,1])
        ];
    }
}
