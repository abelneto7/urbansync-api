<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Services\Contracts\AuthServiceInterface;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use HttpResponses;

    public function __construct(private AuthServiceInterface $authService)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $tokenData = $this->authService->login(
            $request->input('email'),
            $request->input('password')
        );

        if (!$tokenData) {
            return $this->error(null, 'Credenciais inválidas.', 401);
        }

        return $this->success(
            array_merge($tokenData, ['usuario' => new UserResource(auth('api')->user()->load('profiles.permissions'))]),
            'Login realizado com sucesso.'
        );
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return $this->success(null, 'Logout realizado com sucesso.');
    }

    public function me(): JsonResponse
    {
        return $this->success(new UserResource($this->authService->me()->load('profiles.permissions')));
    }

    public function refresh(): JsonResponse
    {
        return $this->success(
            $this->authService->refresh(),
            'Token renovado com sucesso.'
        );
    }
}
