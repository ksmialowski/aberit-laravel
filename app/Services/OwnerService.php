<?php

namespace App\Services;

use App\Models\Owner;
use Illuminate\Support\Collection;

class OwnerService
{
    public function getAll(): Collection
    {
        return Owner::all();
    }

    public function getById(int $id): ?Owner
    {
        return Owner::find($id);
    }

    public function create(array $data): Owner
    {
        return Owner::create($data);
    }

    public function update(int $id, array $data): ?Owner
    {
        $owner = Owner::find($id);
        if (!$owner) {
            return null;
        }
        $owner->update($data);
        return $owner;
    }

    public function delete(int $id): bool
    {
        $owner = Owner::find($id);
        if (!$owner) {
            return false;
        }
        return $owner->delete();
    }
}
