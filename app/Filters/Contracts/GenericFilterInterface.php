<?php

namespace App\Filters\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface GenericFilterInterface
{
    public function applyFilters(Builder $query, array $filters): Builder;
}
