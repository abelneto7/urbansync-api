<?php

namespace App\Repositories;

use App\DTOs\StoreInterdicaoDTO;
use App\Models\Interdicao;
use App\Repositories\Contracts\InterdicaoRepositoryInterface;
use App\Filters\Contracts\GenericFilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InterdicaoRepository implements InterdicaoRepositoryInterface
{
    public function __construct(protected GenericFilterInterface $filter)
    {
    }

    public function getQuery(): Builder
    {
        return Interdicao::query();
    }

    public function getPaginado(array $filters, int $perPage): LengthAwarePaginator
    {
        $query = $this->getQuery();

        $query = $this->filter->applyFilters($query, $filters);

        return $query->with('user')
            ->latest()
            ->paginate($perPage);
    }

    public function store(StoreInterdicaoDTO $dto): Interdicao
    {
        return Interdicao::create([
            'user_id' => $dto->getUserId(),
            'titulo' => $dto->getTitulo(),
            'descricao' => $dto->getDescricao(),
            'latitude' => $dto->getLatitude(),
            'longitude' => $dto->getLongitude(),
            'tipo' => $dto->getTipo(),
            'data_inicio' => $dto->getDataInicio(),
            'data_fim' => $dto->getDataFim(),
        ]);
    }

    public function replace(Interdicao $interdicao, StoreInterdicaoDTO $dto): bool
    {
        return $interdicao->update([
            'user_id' => $dto->getUserId(),
            'titulo' => $dto->getTitulo(),
            'descricao' => $dto->getDescricao(),
            'latitude' => $dto->getLatitude(),
            'longitude' => $dto->getLongitude(),
            'tipo' => $dto->getTipo(),
            'data_inicio' => $dto->getDataInicio(),
            'data_fim' => $dto->getDataFim(),
        ]);
    }

    public function destroy(Interdicao $interdicao): ?bool
    {
        return $interdicao->delete();
    }
}
