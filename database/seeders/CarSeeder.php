<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        Car::insert([
            [
                'model' => 'E90',
                'year' => 2007,
                'color' => 'Black',
                'vin' => 'WBA5R1C02LFH12345',
                'mileage' => 45000,
                'brand_id' => 1,
                'owner_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'model' => 'Corolla',
                'year' => 2019,
                'color' => 'White',
                'vin' => 'JTDEPRAE4LJ123456',
                'mileage' => 60000,
                'brand_id' => 2,
                'owner_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'model' => 'Mustang',
                'year' => 2022,
                'color' => 'Red',
                'vin' => '1FA6P8TH9N5123456',
                'mileage' => 15000,
                'brand_id' => 3,
                'owner_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

