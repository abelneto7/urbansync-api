<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\AuthServiceInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService implements AuthServiceInterface
{
    public function login(string $email, string $password): ?array
    {
        $token = auth('api')->attempt(['email' => $email, 'password' => $password]);

        if (!$token) {
            return null;
        }

        return $this->buildTokenPayload($token);
    }

    public function logout(): void
    {
        JWTAuth::invalidate(JWTAuth::getToken());
    }

    public function me(): User
    {
        return auth('api')->user();
    }

    public function refresh(): array
    {
        $token = JWTAuth::refresh(JWTAuth::getToken());

        return $this->buildTokenPayload($token);
    }

    private function buildTokenPayload(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ];
    }
}
