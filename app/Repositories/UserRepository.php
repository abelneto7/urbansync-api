<?php

namespace App\Repositories;

use App\DTOs\StoreUserDTO;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Filters\Contracts\GenericFilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private GenericFilterInterface $filter)
    {
    }

    public function getQuery(): Builder
    {
        return User::query();
    }

    public function getPaginado(array $filters, int $perPage): LengthAwarePaginator
    {
        $query = $this->getQuery();
        
        $query = $this->filter->applyFilters($query, $filters);
        
        return $query->latest()->paginate($perPage);
    }

    public function store(StoreUserDTO $dto): User
    {
        return User::create([
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ]);
    }

    public function replace(User $user, StoreUserDTO $dto): bool
    {
        return $user->update([
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ]);
    }

    public function destroy(User $user): ?bool
    {
        return $user->delete();
    }
}
