<?php

namespace App\Filters;

use App\Filters\Contracts\GenericFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class GenericFilter implements GenericFilterInterface
{
    public function applyFilters(Builder $query, array $filters): Builder
    {
        foreach ($filters as $key => $value) {
            if ($value === null || $value === '' || in_array($key, ['page', 'per_page'])) {
                continue;
            }

            if (str_ends_with($key, 'Like')) {
                $column = str_replace('Like', '', $key);
                $query->where($column, 'like', '%' . $value . '%');
            } else {
                $query->where($key, $value);
            }
        }

        return $query;
    }
}
