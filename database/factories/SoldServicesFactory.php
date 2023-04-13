<?php

namespace Database\Factories;

use App\Models\Customers;
use App\Models\SoldServices;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SoldServices>
 */
class SoldServicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customers = Customers::pluck('id')->toArray();
        $services = Customers::pluck('id')->toArray();
        return [
            'customer_id' =>  $this->faker->randomElement($customers),
            'service_id' =>  $this->faker->randomElement($services),
            'number' => $this->faker->numberBetween(1, 6),
        ];
    }
}
