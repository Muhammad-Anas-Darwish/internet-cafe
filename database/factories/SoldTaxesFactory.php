<?php

namespace Database\Factories;

use App\Models\Taxes;
use App\Models\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SoldTaxes>
 */
class SoldTaxesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customers = Customers::pluck('id')->toArray();
        $taxes = Taxes::pluck('id')->toArray();
        return [
            'customer_id' =>  $this->faker->randomElement($customers),
            'taxe_id' =>  $this->faker->randomElement($taxes),
        ];
    }
}
