<?php

namespace Database\Factories;

use App\Models\DevicesTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Devices>
 */
class DevicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $devices_types = DevicesTypes::pluck('id')->toArray();
        return [
            'device_type_id' =>  $this->faker->randomElement($devices_types),
            'number' => $this->faker->unique()->randomDigit(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
