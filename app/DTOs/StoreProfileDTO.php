<?php

namespace App\DTOs;

class StoreProfileDTO
{
    private ?array $permissionIds = null;

    public function __construct(
        private string $name,
        private ?string $description
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPermissionIds(): ?array
    {
        return $this->permissionIds;
    }

    public function setPermissionIds(?array $permissionIds): void
    {
        $this->permissionIds = $permissionIds;
    }
}
