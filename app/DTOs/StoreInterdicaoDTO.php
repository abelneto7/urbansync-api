<?php

namespace App\DTOs;

use Illuminate\Support\Carbon;

class StoreInterdicaoDTO
{
    private ?string $descricao = null;
    private ?Carbon $dataFim = null;

    public function __construct(
        private readonly int    $userId,
        private readonly string $titulo,
        private readonly float  $latitude,
        private readonly float  $longitude,
        private readonly int    $tipo,
        private readonly Carbon $dataInicio
    )
    {
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

    public function getDataInicio(): Carbon
    {
        return $this->dataInicio;
    }

    public function getDataFim(): ?Carbon
    {
        return $this->dataFim;
    }

    public function setDataFim(?Carbon $dataFim): void
    {
        $this->dataFim = $dataFim;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
    }
}
