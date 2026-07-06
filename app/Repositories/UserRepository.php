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
        return User::query()->with('profiles');
    }

    public function getPaginado(array $filters, int $perPage): LengthAwarePaginator
    {
        $query = $this->getQuery();

        $query = $this->filter->applyFilters($query, $filters);

        return $query->latest()->paginate($perPage);
    }

    public function find(User $user): User
    {
        return $user->load('profiles');
    }

    public function store(StoreUserDTO $dto): User
    {
        $user = User::create([
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
        ]);

        if ($dto->getProfileIds() !== null) {
            $user->profiles()->sync($dto->getProfileIds());
        }

        return $user->load('profiles');
    }

    public function replace(User $user, StoreUserDTO $dto): User
    {
        $data = [
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
        ];

        if ($dto->getPassword() !== null) {
            $data['password'] = $dto->getPassword();
        }

        $user->update($data);

        if ($dto->getProfileIds() !== null) {
            $user->profiles()->sync($dto->getProfileIds());
        }

        return $user->load('profiles');
    }

    public function destroy(User $user): ?bool
    {
        return $user->delete();
    }
}
