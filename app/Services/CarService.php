<?php

namespace App\Services;

use App\Models\Car;
use Illuminate\Support\Collection;

class CarService
{
    public function getAll(): Collection
    {
        return Car::with(['brand', 'owner'])->get();
    }

    public function getById(int $id): ?Car
    {
        return Car::with(['brand', 'owner'])->find($id);
    }

    public function create(array $data): Car
    {
        return Car::create($data);
    }

    public function update(int $id, array $data): ?Car
    {
        $car = Car::find($id);
        if (!$car) {
            return null;
        }
        $car->update($data);
        return $car;
    }

    public function delete(int $id): bool
    {
        $car = Car::find($id);
        if (!$car) {
            return false;
        }
        return $car->delete();
    }
}
