<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HttpResponses;

    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $usuarios = $this->repository->getPaginado(
            filters: $request->all(),
            perPage: 10
        );
        
        return $this->success(
            UserResource::collection($usuarios)->response()->getData(true),
            'Lista de usuários recuperada com sucesso.'
        );
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $usuario = $this->repository->store($request->toDto());

        return $this->success(
            new UserResource($usuario),
            'Usuário criado com sucesso.',
            201
        );
    }

    public function show(User $usuario): JsonResponse
    {
        return $this->success(new UserResource($this->repository->find($usuario)));
    }

    public function update(StoreUserRequest $request, User $usuario): JsonResponse
    {
        $usuario = $this->repository->replace($usuario, $request->toDto());

        return $this->success(
            new UserResource($usuario),
            'Usuário atualizado com sucesso.'
        );
    }

    public function destroy(User $usuario): JsonResponse
    {
        $this->repository->destroy($usuario);

        return $this->success(
            null,
            'Usuário deletado com sucesso.'
        );
    }
}
