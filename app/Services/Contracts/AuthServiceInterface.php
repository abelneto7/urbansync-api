<?php

namespace App\Services\Contracts;

use App\Models\User;

interface AuthServiceInterface
{
    public function login(string $email, string $password): ?array;
    public function logout(): void;
    public function me(): User;
    public function refresh(): array;
}
