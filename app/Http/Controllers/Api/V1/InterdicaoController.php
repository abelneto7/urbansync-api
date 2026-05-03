<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Interdicao;
use App\Http\Resources\Api\V1\InterdicaoResource;
use App\Http\Requests\StoreInterdicaoRequest;
use App\Http\Requests\UpdateInterdicaoRequest;
use App\Repositories\Contracts\InterdicaoRepositoryInterface;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InterdicaoController extends Controller
{
    use HttpResponses;

    public function __construct(private InterdicaoRepositoryInterface $repository)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $interdicoes = $this->repository->getPaginado(
            filters: $request->all(),
            perPage: 10
        );
        
        return $this->success(
            InterdicaoResource::collection($interdicoes)->response()->getData(true),
            'Lista de interdições recuperada com sucesso.'
        );
    }

    public function store(StoreInterdicaoRequest $request): JsonResponse
    {
        $interdicao = $this->repository->store($request->toDto());

        return $this->success(
            new InterdicaoResource($interdicao),
            'Interdição criada com sucesso.',
            201
        );
    }

    public function show(Interdicao $interdicao): JsonResponse
    {
        return $this->success(new InterdicaoResource($interdicao));
    }

    public function update(StoreInterdicaoRequest $request, Interdicao $interdicao): JsonResponse
    {
        $this->repository->replace($interdicao, $request->toDto());

        return $this->success(
            new InterdicaoResource($interdicao->refresh()),
            'Interdição atualizada com sucesso.'
        );
    }

    public function destroy(Interdicao $interdicao): JsonResponse
    {
        $this->repository->destroy($interdicao);

        return $this->success(
            null,
            'Interdição deletada com sucesso.'
        );
    }
}
