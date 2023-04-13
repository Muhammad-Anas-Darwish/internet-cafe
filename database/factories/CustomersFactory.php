<?php

namespace Database\Factories;

use App\Models\Devices;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customers>
 */
class CustomersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $devices = Devices::pluck('number')->toArray();
        return [
            'device_id' =>  $this->faker->randomElement($devices),
            'reserved time' => $this->faker->time(),
            'is_open_time' => $this->faker->boolean(),
        ];
    }
}
