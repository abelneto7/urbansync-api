<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    use HttpResponses;

    public function __construct(private ProfileRepositoryInterface $repository)
    {
    }

    public function index(): JsonResponse
    {
        $perfis = $this->repository->getAll();

        return $this->success($perfis, 'Lista de perfis recuperada com sucesso.');
    }

    public function store(StoreProfileRequest $request): JsonResponse
    {
        $perfil = $this->repository->store($request->toDto());

        return $this->success($perfil, 'Perfil criado com sucesso.', 201);
    }

    public function show(Profile $perfil): JsonResponse
    {
        return $this->success($this->repository->find($perfil));
    }

    public function update(UpdateProfileRequest $request, Profile $perfil): JsonResponse
    {
        $perfil = $this->repository->replace($perfil, $request->toDto());

        return $this->success($perfil, 'Perfil atualizado com sucesso.');
    }

    public function destroy(Profile $perfil): JsonResponse
    {
        $this->repository->destroy($perfil);

        return $this->success(null, 'Perfil deletado com sucesso.');
    }
}
