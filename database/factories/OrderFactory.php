<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Customer;
use App\Models\User;

class OrderFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    protected $model = Order::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'customer_id' => Customer::query()->inRandomOrder()->first()->id,
            'confiramtion_status' => $this->faker->randomElement([Order::PENDING,Order::CONFIRMED,Order::CANCELLED,Order::ON_HOLD]),
            'delivery_status'=> $this->faker->randomElement([Order::PENDING,Order::IN_TRANSIT,Order::DELIVERED,Order::RETURNED]),
            'currency'=> $this->faker->randomElement(['MAD','USD']),
            'address'=> $this->faker->streetAddress,
        ];
    }
}
