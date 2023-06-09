<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\DevicesTypes::factory(10)->create();
        \App\Models\Services::factory(10)->create();
        \App\Models\Devices::factory(10)->create();
        \App\Models\Taxes::factory(10)->create();
        \App\Models\Customers::factory(10)->create();
        \App\Models\SoldServices::factory(10)->create();
        \App\Models\SoldTaxes::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
