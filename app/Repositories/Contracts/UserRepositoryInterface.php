<?php

namespace App\Repositories\Contracts;

use App\DTOs\StoreUserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function getQuery(): Builder;
    public function getPaginado(array $filters, int $perPage): LengthAwarePaginator;
    public function find(User $user): User;
    public function store(StoreUserDTO $dto): User;
    public function replace(User $user, StoreUserDTO $dto): User;
    public function destroy(User $user): ?bool;
}
