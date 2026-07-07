<?php

namespace App\Repositories;

use App\DTOs\StoreProfileDTO;
use App\Models\Profile;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function getAll(): Collection
    {
        return Profile::with('permissions')->get();
    }

    public function store(StoreProfileDTO $dto): Profile
    {
        $perfil = Profile::create([
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
        ]);

        if ($dto->getPermissionIds() !== null) {
            $perfil->permissions()->sync($dto->getPermissionIds());
        }

        return $perfil->load('permissions');
    }

    public function find(Profile $perfil): Profile
    {
        return $perfil->load('permissions');
    }

    public function replace(Profile $perfil, StoreProfileDTO $dto): Profile
    {
        $perfil->update([
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
        ]);

        if ($dto->getPermissionIds() !== null) {
            $perfil->permissions()->sync($dto->getPermissionIds());
        }

        return $perfil->load('permissions');
    }

    public function destroy(Profile $perfil): ?bool
    {
        return $perfil->delete();
    }
}
