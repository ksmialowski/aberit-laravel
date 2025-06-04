<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::insert([
            [
                'name' => 'BMW',
                'country' => 'Germany',
                'founded_year' => 1916,
                'description' => 'Lorem ipsum dolor sit amet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Toyota',
                'country' => 'Japan',
                'founded_year' => 1937,
                'description' => 'Lorem ipsum dolor sit amet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ford',
                'country' => 'USA',
                'founded_year' => 1903,
                'description' => 'Lorem ipsum dolor sit amet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

