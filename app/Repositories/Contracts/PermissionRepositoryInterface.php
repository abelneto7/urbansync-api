<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface PermissionRepositoryInterface
{
    public function getAllGroupedByModule(): Collection;
}
