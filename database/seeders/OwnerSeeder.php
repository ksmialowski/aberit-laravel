<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {
        Owner::insert([
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'john.doe@example.com',
                'address' => '123 Main St',
                'postcode' => '12345',
                'city' => 'New York',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Kamil',
                'lastname' => 'Śmiałowski',
                'email' => 'smialowski.kamil@gmail.com',
                'address' => '456 Elm St',
                'postcode' => '54321',
                'city' => 'Rzeszów',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Luca',
                'lastname' => 'Bianchi',
                'email' => 'luca.b@example.com',
                'address' => '789 Via Roma',
                'postcode' => '00100',
                'city' => 'Rome',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

