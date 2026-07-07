<?php

namespace App\DTOs;

class StoreUserDTO
{
    private ?array $profileIds = null;

    public function __construct(
        private string $name,
        private string $email,
        private ?string $password
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getProfileIds(): ?array
    {
        return $this->profileIds;
    }

    public function setProfileIds(?array $profileIds): void
    {
        $this->profileIds = $profileIds;
    }
}
