<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Interdicao;
use App\DTOs\StoreInterdicaoDTO;

interface InterdicaoRepositoryInterface
{
    public function getQuery(): Builder;
    public function getPaginado(array $filters, int $perPage): LengthAwarePaginator;
    public function store(StoreInterdicaoDTO $dto): Interdicao;
    public function replace(Interdicao $interdicao, StoreInterdicaoDTO $dto): bool;
    public function destroy(Interdicao $interdicao): ?bool;
}
