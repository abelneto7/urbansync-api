<?php

namespace App\DTOs;

class StoreInterdicaoDTO
{
    private ?string $descricao = null;
    private ?bool $status = null;

    public function __construct(
        private int $userId,
        private string $titulo,
        private float $latitude,
        private float $longitude,
        private int $tipo
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getTipo(): int
    {
        return $this->tipo;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): void
    {
        $this->status = $status;
    }
}
