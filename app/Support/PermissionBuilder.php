<?php

namespace App\Support;

class PermissionBuilder
{
    private const DEFAULT_ACTIONS = ['index', 'store', 'show', 'update', 'destroy'];

    private array $permissions = [];

    public function __construct(
        private readonly string $module,
        private readonly string $controller,
        array                   $only = self::DEFAULT_ACTIONS
    )
    {
        foreach ($only as $action) {
            $this->permissions[] = $this->buildEntry($action);
        }
    }

    public function addAction(string $action): static
    {
        $this->permissions[] = $this->buildEntry($action);

        return $this;
    }

    public function toArray(): array
    {
        return $this->permissions;
    }

    private function buildEntry(string $action): array
    {
        return [
            'name' => "{$this->controller}@{$action}",
            'module' => $this->module,
        ];
    }
}
