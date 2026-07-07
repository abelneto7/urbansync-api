<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use Illuminate\Support\Collection;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getAllGroupedByModule(): Collection
    {
        return Permission::all(['id', 'name', 'module'])
            ->groupBy('module')
            ->map(fn (Collection $permissions) => $permissions->values());
    }
}
