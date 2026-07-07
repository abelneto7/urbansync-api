<?php

namespace App\Repositories\Contracts;

use App\DTOs\StoreProfileDTO;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;

interface ProfileRepositoryInterface
{
    public function getAll(): Collection;
    public function store(StoreProfileDTO $dto): Profile;
    public function find(Profile $perfil): Profile;
    public function replace(Profile $perfil, StoreProfileDTO $dto): Profile;
    public function destroy(Profile $perfil): ?bool;
}
