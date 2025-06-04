<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Support\Collection;

class BrandService
{
    public function getAll(): Collection
    {
        return Brand::all();
    }

    public function getById(int $id): ?Brand
    {
        return Brand::find($id);
    }

    public function create(array $data): Brand
    {
        return Brand::create($data);
    }

    public function update(int $id, array $data): ?Brand
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return null;
        }
        $brand->update($data);
        return $brand;
    }

    public function delete(int $id): bool
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return false;
        }
        return $brand->delete();
    }
}
